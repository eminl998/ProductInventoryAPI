<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        return response()->json(UserResource::collection($users));
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