<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = "id";
    public function friend()
    {
        return $this->hasOne(Friend::class);
    }
}
