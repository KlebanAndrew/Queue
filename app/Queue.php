<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = array('start_time',
        'end_time',
        'date',
        'register_key',
        'real_queue_key',
        'user_name',
        'user_personal_key',
        'is_present',
        'is_real_queue',
        'is_admin_record'
    );
    public function setQueue($param){

    }
    public function delQueue($id){

    }
}
