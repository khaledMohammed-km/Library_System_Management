<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Return the users index view
        return view('users.index');
    }

    public function userStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role = $request->role ?? 'User';
        $user->save();

        return redirect()->route('login')->with('success', 'User registered successfully!');
    }

    public function showRegistrationForm()
    {
        // Return the user registration view
        return view('users.create');
    }

    public function showEditForm()
    {
        // Return the user edit form view
        return view('users.edit');
    }
}