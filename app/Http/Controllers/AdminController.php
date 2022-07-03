<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Admin Login Page
    public function index()
    {
        if(session()->has('flipmart_admin_login')){
            return redirect()->route('admin.dashboard');
        }
        return view('backend.login');
    }

    // Admin Login
    public function auth(Request $req)
    {
        $req->validate([
            'admin_email' => 'required',
            'admin_password' => 'required',
        ]);

        $email = $req->admin_email;
        $password = $req->admin_password;

        $admin = Admin::with('admin_type')->where('admin_username', $email)->first();

        if(!empty($admin))
        {
            if(Hash::check($password, $admin->admin_password))
            {
                session()->put('flipmart_admin_login', [
                    'admin_id' => $admin->id,
                    'admin_fullname' => $admin->admin_fullname,
                    'admin_username' => $admin->admin_username,
                    'admin_typename' => $admin->admin_type->admin_typename,
                    'admin_status' => $admin->admin_status,
                    'admin_login_time' => date('Y-m-d H:i:s')
                ]);
                session()->flash('success', 'Admin Login Successfully!');
                return redirect()->route('admin.dashboard');
            }
            session()->flash('error', 'Your Provided Credential Could Not Be Varified!');
            return redirect()->route('admin.index');
        }

        session()->flash('error', 'Your Provided Credential Could Not Be Varified!');
        return redirect()->route('admin.index');
    }

    // Admin Logout
    public function logout()
    {
        if(session()->has('flipmart_admin_login')){

            session()->forget('flipmart_admin_login');
            session()->flash('logout', 'Admin LogOut Succesfully!');
            return redirect()->route('admin.index');
        }
    }

    // Admin Dashboard Page
    public function dashboard()
    {
        $total_order = Order::count();
        return view('backend.dashboard', compact('total_order'));
    }

}
