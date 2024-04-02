<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $access_token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                "status" => true,
                "message" => "User authenticated successfully",
                "token" => $access_token
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Invalid username or password"
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $access_token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            "status" => true,
            "message" => "User registered successfully",
            "token" => $access_token
        ], 201);
    }
    public function index ()//get all users
    {
        $users=User::all();
        return response()->json([
            'status'=>true,
            'data'=>$users,
            'message'=>'List of users'
        ]);
    }

    // public function store(UserRequest $request )
    // {
    //     $user = User::all($request->all());
    //     return response()->json([
    //         "status" => true,
    //         "data" => $user,
    //         "message"=>"User created successfully"
    //     ]);
    // I dont need it since Im at users table and I have register}

    public function show($id)
    {//show the users
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "User not found"
            ], 404);
        }

        return response()->json([
            "status" => true,
            "data" => $user
        ]);
    }

    public function update(UserRequest $request, $id)
    {//update users
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "User not found"
            ], 404);
        }

        $user->update($request->all());

        return response()->json([
            "status" => true,
            "message" => "User updated successfully",
            "data" => $user
        ]);
    }

    public function destroy($id)
    {//delete users
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                "status" => false,
                "data"=>null,
                "message" => "User not found"
            ], 404);
        }

        $user->delete();

        return response()->json([
            "status" => true,
            "data"=>null,
            "message" => "User deleted successfully"
        ]);
    }
}
