<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $userPage = config('app.user_paginate');
        $users = User::paginate($userPage);
        return view('backend.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = new User();
        $request['password'] = Hash::make($request->password);
        $filename = $request->file('avatar')->getClientOriginalName();
        $user->avatar = time() . "_" . $filename;
        $request->file('avatar')->move('uploads', $filename);
        $user = User::create([
            'name' => $request->name,
            'avatar' => $filename,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => $request->password,
        ]);
        $user->save();
        return redirect()->route('user.index')->with('success', 'User create successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $filename = time() . "_" . $request->file('avatar')->getClientOriginalName();
        $request->avatar = $filename;
        $request->file('avatar')->move('uploads', $filename);
        $user->update([
            'name' => $request->name,
            'avatar' => $filename,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => $request->password,
        ]);
        $user->save();
        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');;
    }
}
