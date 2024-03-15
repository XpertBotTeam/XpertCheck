<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile($userId)
    {
        $user = User::findOrFail($userId);

        return view('user.profile', [
            'user' => $user,
        ]);
    }
}
