<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $currentUserId = Auth::id();

        // Fetch users, excluding the current user and ordering by role
        $users = User::with('userDetail')->where('id', '!=', $currentUserId)
                     ->orderBy('role')
                     ->paginate(6);
        $page = $users->currentPage();
        return view('users.index', compact('users', 'page'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:15',
        ]);

        // Check if email already exists
        $existingEmail = User::where('email', $request->email)->exists();
        if ($existingEmail) {
            return redirect()->route('users.create')->with('error', 'Email already exists!');
        }

        // Create the user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();

        // Create user details
        $userDetail = new UserDetail();
        $userDetail->user_id = $user->id;
        $userDetail->phone_number = $request->phone_number;
        $userDetail->save();

        return redirect()->route('users.create')->with('success', 'User created successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'phone_number' => 'nullable|string|max:15',
            'role' => 'required|string|in:admin,parent',
        ]);

        // Update the user
        $user->name = $request->name;
        // $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        // Update user details
        $userDetail = $user->userDetail;
        if ($userDetail) {
            $userDetail->phone_number = $request->phone_number;
            $userDetail->save();
        } else {
            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->phone_number = $request->phone_number;
            $userDetail->save();
        }

        return redirect()->route('users.edit', $user)->with('success', 'User updated successfully.');
    }

}
