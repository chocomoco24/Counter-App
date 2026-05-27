<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Counter;
class CounterController extends Controller
{
    // Show the counter page
    public function index()
    {
        // Get the first counter row, or create one with value 0
        $counter = Counter::firstOrCreate(['id' => 1], ['value' => 0]);
        return view('counter', ['counter' => $counter]);
    }

    // Increment
    public function increment()
    {
        $counter = Counter::find(1);
        $counter->value += 1;
        $counter->save();
        return redirect('/');
    }

    // Decrement
    public function decrement()
    {
        $counter = Counter::find(1);
        $counter->value -= 1;
        $counter->save();
        return redirect('/');
    }

    // Reset
    public function reset()
    {
        $counter = Counter::find(1);
        $counter->value = 0;
        $counter->save();
        return redirect('/');
    }
}
