<?php

// RegisterController.php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        // Create a new user
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Return a success response
        return response()->json([
            'message' => 'User registered successfully'
        ], 201);
    }
}