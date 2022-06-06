<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        if($req->session()->has('ECOM_login_time')){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Admin Login
    public function auth(Request $req)
    {
        $email = $req->post('admin_email');
        $password = $req->post('admin_password');
        $result = Admin::where(['admin_username' => $email, 'admin_password' => sha1($password)])->get();

        if(isset($result[0]->id)){
            
            $req->session()->put('ECOM_login_time', date("Y-m-d H:i:s"));
            $req->session()->put('ECOM_admin_id', $result[0]->id);
            $req->session()->put('ECOM_admin_name', $result[0]->admin_fullname);
            $req->session()->put('ECOM_admin_email', $result[0]->admin_username);
            $req->session()->put('ECOM_admin_type', $result[0]->admin_type);
            return redirect()->route('admin.dashboard');
        }
        else{
            $req->session()->flash('error', 'Please, Enter Valid Email and Password!');
            return redirect()->route('admin.index');
        }
    }

    public function logout(Request $req)
    {
        if($req->session()->has('ECOM_login_time')){

            $req->session()->flush();
            $req->session()->flash('logout', 'You are Successfully Logged Out!');
            return redirect()->route('admin.index');
        }
    }

    public function dashboard()
    {
        $total_order = Order::count();
        return view('admin.dashboard', compact('total_order'));
    }

}
