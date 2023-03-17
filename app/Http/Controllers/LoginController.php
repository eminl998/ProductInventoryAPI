<?php

// LoginController.php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // TODO: implement the login functionality
    }

    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function store(StoreUserRequest $request)
    {
        # code...
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
    //     $validatedData = $request

    //     $user = User::findOrFail($id);
    //     $user->update($validatedData);

    //     return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}