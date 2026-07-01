<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public $timestamps = false;
    public function msg()
    {
        //Friendのmsg_idとMsgのidを紐づけ
    	return $this->belongsTo(Msg::class,'msg_id');
    }
}
