<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    // Allow these columns to be saved to the database
    protected $fillable = [
        'name', 
        'user_id'
    ];
}