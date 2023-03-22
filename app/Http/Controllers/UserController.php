<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(compact('users'));
    }

    public function show(User $user)
    {
        return response()->json(compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json(compact('user'));
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }
}