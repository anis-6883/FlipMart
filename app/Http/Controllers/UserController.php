<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\PDF;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if(!$request->isMethod('POST'))
            return view('frontend.auth.register');

        $attributes = $request->validate([
            'username' => ['required', 'unique:users,username', 'min:8', 'max:255'],
            'email' => ['required', 'unique:users,email', 'email', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8', 'max:255']
        ]);

        $random_token = "RANDOM_" .  date('YmdHis') . rand(100000, 999999). "_TOKEN";
        $attributes['password'] = bcrypt($attributes['password']); # -> Also Handle By Model
        $attributes['remember_token'] = $random_token;
        User::create($attributes);

        $data = [
            'username' => $request->username,
            'random_token' => $random_token
        ];
        $user['to'] = $request->email;

        Mail::send('frontend.auth.email-varification', $data, function ($message) use ($user) {
            $message->to($user['to']);
            $message->subject('Email Verification');
        });

        session()->flash('success', 'Check Your Email for Verification...');
        return redirect()->route('user.register');
    }

    public function emailVerify($token)
    {
        $user = User::where('remember_token', $token)->get();

        if(isset($user[0]))
        {
            User::find($user[0]->id)->update([
                    'status' => 'Active', 
                    'email_verified_at' => date('Y-m-d H:i:s')
                ]);
            session()->flash('success', 'Your Email is Verified Successfully. Log In Now...');
            return redirect()->route('user.login');
        }
        else{
            return redirect('/');
        }
    }

    public function forgetPassword(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $email = $request->post('forget_email');
            $isValid = User::where('email', $email)->get();

            if(isset($isValid[0]))
            {
                $random_token = "RANDOM_" .  date('YmdHis') . rand(100000, 999999). "_TOKEN";

                DB::table('password_resets')->insert([
                    'email' => $email,
                    'token' => $random_token,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $data = [
                    'username' => $isValid[0]->username,
                    'random_token' => $random_token
                ];
                $user['to'] = $request->post('forget_email');
        
                Mail::send('frontend.auth.token-varification', $data, function ($message) use ($user) {
                    $message->to($user['to']);
                    $message->subject('Password Reset Email Verification');
                });

                return redirect()->back()->with('success', 'Password Reset Link has been Sent...');
            }
            else
                return redirect()->back()->with('danger', 'Your Provided Credential Could Not Be Varified!');
        }
        return view('frontend.auth.forget-password');
    }

    public function resetPassword($token)
    {
        $isExist = DB::table('password_resets')->where('token', $token)->get();
        $arr['email'] = $isExist[0]->email;

        if(isset($isExist[0]))
            return view('frontend.auth.reset-password', compact('arr'));
        else
            return redirect('/');
    }

    public function resetConfirm(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'confirmed', 'min:8', 'max:255']
        ]);

        User::where('email', $attributes['email'])
            ->update([
                'password' => bcrypt($attributes['password'])
            ]);

        session()->flash('success', 'Reset your Password Successfully. Log In Now...');
        return redirect()->route('user.login');
    }

    public function changePassword(Request $request)
    {
        if(!$request->isMethod('POST'))
            return view('frontend.auth.update-password');
        else
        {
            $attributes = $request->validate([
                'curr_password' => ['required'],
                'password' => ['required', 'confirmed', 'min:8', 'max:255']
            ]);

            $userPassword = Auth::user()->password;

            if(Hash::check($attributes['curr_password'], $userPassword))
            {
                $user = User::find(Auth::id());
                $user->password = bcrypt($attributes['password']);
                $user->save();
                Auth::logout();
                session()->flash('success', 'Your Password Changed Successfully. Login Again...');
                return redirect()->route('user.login');
            }
            else
            {
                session()->flash('danger', 'Your Current Password Didn\'t Match! Try Again...');
                return redirect()->back();
            }   
        }
    }

    public function userProfile()
    {
        return view('frontend.auth.user-profile');
    }

    public function manageProfile(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $attributes = $request->validate([
                'mobile' => ['required', 'min:11', 'max:11'],
                'address' => ['required', 'max:255'],
                'dob' => ['required'],
                'gender' => ['required'],
            ]);

            User::find(Auth::id())->update($attributes);
            return redirect()->route('user.profile')->with('success', 'Profile Updated Successfully...');
        }
        $user = User::find(Auth::id());
        $arr['mobile'] = $user->mobile ?: "";
        $arr['address'] = $user->address ?: "";
        $arr['dob'] = $user->dob ?: "";
        $arr['gender'] = $user->gender ?: "";
        return view('frontend.auth.update-profile', compact('arr'));
    }

    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())->with('order_items', 'order_detail')->latest()->get();
        return view('frontend.list-order', compact('orders'));
    }

    public function userOrderDetails($order_id)
    {
        $order = Order::where([ 
            ['id', $order_id], 
            ['user_id', Auth::id()] 
            ])->with('order_items', 'order_detail')->first();
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->get();
        return view('frontend.show-order', compact('order', 'order_items'));
    }

    public function invoiceDownload($order_id)
    {
        $order = Order::where([ ['id', $order_id], ['user_id', Auth::id()] ])->with('order_items', 'order_detail')->first();
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->get();
        $pdf = PDF::loadView('frontend.order-invoice', compact('order', 'order_items'))
                ->setPaper('a4')
                ->setOptions([
                    'tempDir' => public_path(),
                    'chroot' => public_path()
                ]);
        return $pdf->download('INVOICE_'. uniqid() .'.pdf');
    }

}
