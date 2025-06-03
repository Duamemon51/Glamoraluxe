<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // Validate the request data, including the new fields (phone, address, and avatar)
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'phone' => 'nullable|string|max:15',
        ]);

        // Handle image upload for avatar
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('avatars', 'public'); // Store avatar in the 'avatars' directory
        }
        $defaultRole = 'user';

        // Create the user with all the fields, including the avatar path if available
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role for public registration

            'phone' => $request->phone, // Save phone number (nullable)
            'address' => $request->address, // Save address (nullable)
            'avatar' => $avatarPath, // Save avatar path (nullable)
        ]);

        // Redirect to login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Redirect based on the role of the user
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');  // Admin is redirected to the admin dashboard
            } else {
                // Check if there is a redirect URL stored in the session
                $redirectUrl = session('redirect_url', '/home');  // Default to /home if no redirect URL is found
                return redirect()->to($redirectUrl);  // Redirect to the page they came from
            }
        }
    
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
