<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->post('email');
        $password = $request->post('password');

        if($request->has('remember_me')){
            setcookie('user_login_email', $email, time() + 60*60*24*365);
            setcookie('user_login_pass', $password, time() + 60*60*24*365);
        }else{
            setcookie('user_login_email', '', time() - 3600);
            setcookie('user_login_pass', '', time() - 3600);
        }

        if(!auth()->attempt(['email' => $email, 'password'=> $password, 'status' => 'Active']))
        {
            return back()->withInput()->withErrors(['email' => 'Your provided credential could not be varified']);
        }
        // for prevent session fixation
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back...');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->route('user.login')->with('success', 'GoodBye! Logout Successfully.');
    }

    public function login()
    {
        if(isset($_COOKIE['user_login_email']) && isset($_COOKIE['user_login_pass']))
        {
            $arr['user_login_email'] = $_COOKIE['user_login_email'];
            $arr['user_login_pass'] = $_COOKIE['user_login_pass'];
            $arr['is_remember'] = "checked";
        }
        else{
            $arr['user_login_email'] = '';
            $arr['user_login_pass'] = '';
            $arr['is_remember'] = '';
        }
        return view('auth.login', compact('arr'));
    }

    public function email_verify($token)
    {
        $user = User::where('remember_token', $token)->get();

        if(isset($user[0]))
        {
            User::find($user[0]->id)
                ->update(['status' => 'Active', 'email_verified_at' => date('Y-m-d H:i:s')]);
            session()->flash('success', 'Your Email is Verified Successfully. Log In Now...');
            return redirect()->route('user.login');
        }
        else{
            return redirect('/');
        }
    }
}
