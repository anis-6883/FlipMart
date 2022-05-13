<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if($request->isMethod('POST'))
        {
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
                'username' => $request->post('username'),
                'random_token' => $random_token
            ];
            $user['to'] = $request->post('email');
    
            Mail::send('auth.email-varification', $data, function ($message) use ($user) {
                $message->to($user['to']);
                $message->subject('Email Verification');
            });
    
            return redirect()
                ->route('user.register')
                ->with('success', 'Check Your Email for Verification...');
        }
        
        return view('auth.register');
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
        
                Mail::send('auth.token-varification', $data, function ($message) use ($user) {
                    $message->to($user['to']);
                    $message->subject('Password Reset Email Verification');
                });

                return redirect()->back()->with('success', 'Password Reset Link has been Sent...');
            }
            else
                return redirect()->back()->with('danger', 'Your Provided Credential Could Not Be Varified!');
        }
        return view('auth.forget-password');
    }

    public function resetPassword($token)
    {
        $isExist = DB::table('password_resets')->where('token', $token)->get();
        $arr['email'] = $isExist[0]->email;

        if(isset($isExist[0]))
            return view('auth.reset-password', compact('arr'));
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
        if($request->isMethod('POST'))
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
                return redirect()->route('user.login')->with('success', 'Your Password Changed Successfully. Login Again...');
            }
            else
                return redirect()->back()->with('danger', 'Your Current Password Didn\'t Match! Try Again...');
        }
        return view('auth.update-password');
    }

    public function userProfile()
    {
        return view('auth.user-profile');
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
        return view('auth.update-profile', compact('arr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
