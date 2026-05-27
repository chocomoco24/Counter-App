<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Admin dashboard: see all counters
    public function dashboard()
    {
        $counters = Counter::with('user')->latest()->get();
        return view('admin.dashboard', compact('counters'));
    }

    // Show create student form
    public function createStudentForm()
    {
        return view('admin.create-student');
    }

    // Store new student
    public function createStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        return redirect('/admin/students/create')
            ->with('created_email', $request->email)
            ->with('created_password', $request->password);
    }

    // View all students
    public function students()
    {
        $students = User::where('role', 'student')->latest()->get();
        return view('admin.students', compact('students'));
    }
}