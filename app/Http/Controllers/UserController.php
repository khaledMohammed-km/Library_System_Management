<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function testAddUser(Request $request)
    {
        $data = request()->all();
        $name = request()->name;
        $email = request()->email;
        $password = request()->password;
        $role = request()->role;
        $database = $factory->createDatabase();
        $usersRef = $database->getReference('users');
        $newUser = [
            'name' => $name,
            'email' => $email,
            'password' => $password, 
            'role' => $role ?? 'User',
        ];
        $usersRef->push($newUser);
        return redirect()->route('photos.manage_users')->with('success', 'User added successfully!');
    }
    public function showRegistrationForm()
    {
        return view('users.registration');
    }
    public function showEditForm()
    {
        return view('users.edit');
    }
}