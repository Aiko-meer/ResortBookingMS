<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login form
    public function index()
    {
        return view('admin.login.login');
    }

    // Handle login
public function login(Request $request)
{
    // 1. Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Password is required.',
    ]);

    // 2. Attempt login
    if (Auth::attempt(
        ['email' => $request->email, 'password' => $request->password],
        $request->filled('remember')
    )) {
        // Regenerate session (security)
        $request->session()->regenerate();

        $user = Auth::user();

        // 🚫 Block locked accounts
        if ($user->status == 2) {
            Auth::logout();

            return back()->with('error', 'Your account is locked. Please contact the administrator.');
        }

        // ✅ Success message
        session()->flash('success', 'Welcome back, ' . $user->first_name . '!');
        session()->flash('user_name', Auth::user()->first_name);

        // 3. Role-based redirect
        if (in_array($user->user_type, ['super_admin', 'admin'])) {
            return redirect()->route('admin.home');
        }

        return redirect()->route('page.index');
    }

    // ❌ Login failed
    return back()
        ->with('error', 'Invalid email or password.')
        ->withInput($request->only('email'));
}
    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index')->with('success', 'Logged out successfully.');
    }
}
