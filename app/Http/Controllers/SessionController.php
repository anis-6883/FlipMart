<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'login_email' => 'required|email',
            'login_pass' => 'required'
        ]);

        $email = $request->login_email;
        $password = $request->login_pass;

        if(!auth()->attempt(['email' => $email, 'password'=> $password, 'status' => 'Active']))
        {
            session()->flash('error', 'Your provided credential could not be varified!');
            return back()->withInput()->withErrors(['login_email' => 'Your provided credential could not be varified!']);
        }
        
        if($request->has('remember_me')){
            setcookie('user_login_email', $email, time() + 60*60*24*365);
            setcookie('user_login_pass', $password, time() + 60*60*24*365);
        }else{
            setcookie('user_login_email', '', time() - 3600);
            setcookie('user_login_pass', '', time() - 3600);
        }
        // for prevent session fixation
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back...');
    }

    public function destroy()
    {
        auth()->logout();
        session()->flash('success', 'GoodBye! Logout Successfully.');
        return redirect()->route('user.login');
    }

    public function login(Request $request)
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
        return view('frontend.auth.login', compact('arr'));
    }

}
