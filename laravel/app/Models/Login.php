<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{

    public $timestamps = false;
    
    // 一括保存を許可するカラムを配列で指定します
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
