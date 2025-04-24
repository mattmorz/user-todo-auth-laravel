<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
 
    public function edit()
    {
        return view('profile.edit', ['user'=>Auth::user()]);
    }

    public function update(Request $r)
    {
        $user = Auth::user();
        $r->validate([
            'name'     => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->name = $r->name;
        if ($r->filled('password')) {
            $user->password = Hash::make($r->password);
        }
        $user->save();

        return back()->with('status','Profile updated');
    }
}
