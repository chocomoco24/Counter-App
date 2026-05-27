<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = ['user_id', 'value', 'name'];

    // A counter belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}