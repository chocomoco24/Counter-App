<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Support\Facades\Auth;

class CounterController extends Controller
{
    // Student dashboard: list all their counters
    public function index()
    {
        $counters = Counter::where('user_id', Auth::id())->latest()->get();
        return view('student.dashboard', compact('counters'));
    }

    // Create a new counter for this student
    public function store()
    {
        Counter::create([
            'user_id' => Auth::id(),
            'value'   => 0,
        ]);
        return redirect('/student/dashboard')->with('success', 'Counter created!');
    }

    // Increment
    public function increment($id)
    {
        $counter = Counter::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $counter->increment('value');
        return redirect('/student/dashboard');
    }

    // Decrement
    public function decrement($id)
    {
        $counter = Counter::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $counter->decrement('value');
        return redirect('/student/dashboard');
    }

    // Reset
    public function reset($id)
    {
        $counter = Counter::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $counter->update(['value' => 0]);
        return redirect('/student/dashboard');
    }

    // Delete
    public function destroy($id)
    {
        Counter::where('id', $id)->where('user_id', Auth::id())->firstOrFail()->delete();
        return redirect('/student/dashboard')->with('success', 'Counter deleted.');
    }
}