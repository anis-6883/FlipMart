<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'username' => ['required', 'unique:users,username', 'min:8', 'max:255'],
            'email' => ['required', 'unique:users,email', 'email', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8', 'max:255']
        ]);

        $random_token = "RANDOM_" .  date('YmdHis') . rand(100000, 999999). "_TOKEN";
        # $attributes['password'] = bcrypt($attributes['password']); -> handle in model
        $attributes['remember_token'] = $random_token;
        User::create($attributes);

        $data = [
            'username' => $request->post('username'),
            'random_token' => $random_token
        ];
        $user['to'] = $request->post('email');

        Mail::send('auth.email_varification', $data, function ($message) use ($user) {
            $message->to($user['to']);
            $message->subject('Email Verification');
        });

        // auth()->login($user);
        // session()->flash('success', 'Please! Check Your Email for Verification...');
        return redirect()
            ->route('user.create')
            ->with('success', 'Check Your Email for Verification...');
    }

    public function show($id)
    {
        //
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
