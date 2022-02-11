<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    // Admin Login
    public function auth(Request $req)
    {
        $email = $req->post('admin_email');
        $password = $req->post('admin_password');
        $result = Admin::where(
            ['admin_username' => $email, 
            'admin_password' => sha1($password)])
            ->get();

        if(isset($result[0]->id))
        {
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

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
