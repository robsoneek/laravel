<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('admin.users.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:45|unique:users,username',
            'password' => 'required|string|min:4',
            'is_admin' => 'required|boolean',
        ]);

        User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'is_admin' => $data['is_admin'],
        ]);

        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.create');
    }
}
