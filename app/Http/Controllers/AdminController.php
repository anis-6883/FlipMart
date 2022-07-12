<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Admin_Type;
use App\Models\Order;
use App\Models\User;
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

    // Admin List Page
    public function list()
    {
        $admins = Admin::with('admin_type')->latest()->get();
        return view('backend.list-admin', compact('admins'));
    }

    // Create An Admin
    public function create(Request $req)
    {
        if(!$req->isMethod('POST'))
        {
            $admin_types = Admin_Type::orderBy('admin_typename')->get();
            return view('backend.add-admin', compact('admin_types'));
        }
        else
        {
            $req->validate([
                'admin_fullname' => 'required|min:8|max:255',
                'admin_username' => 'required|email|unique:admins,admin_username|max:255',
                'password' => 'required|confirmed|min:8|max:255',
                'admin_type_id' => 'required',
                'admin_status' => 'required'
            ]);

            $admin = new Admin;
            $admin->admin_fullname = $req->admin_fullname;
            $admin->admin_username = $req->admin_username;
            $admin->admin_password = bcrypt($req->password);
            $admin->admin_type_id = $req->admin_type_id;
            $admin->admin_status = $req->admin_status;
            $admin->save();

            session()->flash('success', 'Admin is Created Successfully!');
            return redirect()->route('admin.list');
        }
    }

    // Update An Admin
    public function update(Request $req, $id)
    {
        if(!$req->isMethod('PUT'))
        {
            $admin_types = Admin_Type::orderBy('admin_typename')->get();
            $admin = Admin::findOrFail($id);
            return view('backend.edit-admin', compact('admin', 'admin_types'));
        }

        $req->validate([
            'admin_fullname' => 'required|min:8|max:255',
            'admin_username' => 'required|email|max:255',
            'admin_type_id' => 'required',
            'admin_status' => 'required'
        ]);

        $admin = Admin::findOrFail($id);
        $admin->admin_fullname = $req->admin_fullname;
        $admin->admin_username = $req->admin_username;
        $admin->admin_type_id = $req->admin_type_id;
        $admin->admin_status = $req->admin_status;
        $admin->save();

        session()->flash('success', 'Admin is Updated Successfully!');
        return redirect()->route('admin.list');
    }

    // Delete An Admin
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        session()->flash('success', 'Admin is Deleted Successfully!');
        return redirect()->back();
    }

    // Customer List
    public function customerList()
    {
        $customers = User::latest()->get();
        return view('backend.list-customer', compact('customers'));
    }

    // Create Customer
    public function createCustomer(Request $req)
    {
        if(!$req->isMethod('POST'))
            return view('backend.add-customer');
        else
        {
            $req->validate([
                'username' => 'required|min:8|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|confirmed|min:8|max:255',
                'status' => 'required',
            ]);

            $user = new User;
            $user->username = $req->username;
            $user->email = $req->email;
            $user->password = bcrypt($req->password);
            $user->address = $req->address ?: NULL;
            $user->mobile = $req->mobile ?: NULL;
            $user->dob = $req->dob ?: NULL;
            $user->gender = $req->gender ?: NULL;
            $user->status = $req->status;
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = "RANDOM_". uniqid() . rand(100000, 999999) . "_TOKEN";
            $user->save();

            session()->flash('success', 'Customer is Created Successfully!');
            return redirect()->route('customer.list');
        }
    }

    // Update Customer
    public function updateCustomer(Request $req, $id)
    {
        if(!$req->isMethod('PUT'))
        {
            $customer = User::findOrFail($id);
            return view('backend.edit-customer', compact('customer'));
        }
        else
        {
            $req->validate([
                'username' => 'required|min:8|max:255',
                'email' => 'required|email|max:255',
                'status' => 'required',
            ]);

            $user = User::findOrFail($id);
            $user->username = $req->username;
            $user->email = $req->email;
            $user->address = $req->address ?: NULL;
            $user->mobile = $req->mobile ?: NULL;
            $user->dob = $req->dob ?: NULL;
            $user->gender = $req->gender ?: NULL;
            $user->status = $req->status;
            $user->save();

            session()->flash('success', 'Customer is Updated Successfully!');
            return redirect()->route('customer.list');
        }
    }

    // Delete A Customer
    public function destroyCustomer($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();
        session()->flash('success', 'Customer is Deleted Successfully!');
        return redirect()->back();
    }
}
