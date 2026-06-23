<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    // 保存を許可するカラム / Allow mass assignment for these columns
    protected $fillable = [
        'name',
        'type',
        'category',
        'grade_year',
        'department',
        'course_type', 
        'conditions',  
        'description', 
        'image_path',
        'user_id',
    ];

    // 配列データを自動的にJSONに変換してデータベースに保存する設定
    // Cast the conditions JSON column back to an Array automatically
    protected $casts = [
        'conditions' => 'array',
    ];
}