<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show Admin Dashboard

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $employees = User::where('role', 'employee')->get();

        return view('admin.adminDashboard', compact('employees'));
    }

    // Show Register Employee Form
    public function showRegisterForm()
    {
        return view('admin.registerEmployee');
    }

    // Register New Employee
    public function registerEmployee(Request $request)
    {
    //   dd($request->all());
            $request->validate([
                'username' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|alpha_num|min:6',
                'confirm_password' => 'required|same:password',
            ]);

        $username = trim($request->username);
        $password = trim($request->password);
        $confirmPassword = trim($request->confirmPassword);


        // Check if username already exists
        $user = User::where('username', $username)->first();

        if ($user) {
            return back()->with('error', 'Username already exists.');
        }
        // Create employee
        User::create([
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'employee',
        ]);
        return back()->with('success', 'Employee registered successfully.');
    }
    
    public function deleteEmployee($id)
    {
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('admin.dashboard')
                ->with('error', 'Employee not found.');
    }

    $user->delete();

    return redirect()->route('admin.dashboard')
            ->with('success', 'Employee deleted successfully.');
}
}