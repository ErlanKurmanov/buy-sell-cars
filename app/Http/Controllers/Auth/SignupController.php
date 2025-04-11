<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.signup');
    }
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);


        // Create the user
        $user = User::create($validator);

        // Log the user in (optional)
//        auth()->login($user);

        // Redirect to a dashboard or home page
        return redirect()->route('login')->with('success', 'Registration successful!');

    }

}
