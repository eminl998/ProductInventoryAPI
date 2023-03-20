<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
            ]);

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            if (isset($validatedData['password'])) {
                $user->password = bcrypt($validatedData['password']);
            }
            $user->save();

            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'User deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}