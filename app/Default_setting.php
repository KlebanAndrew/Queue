<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Default_setting extends Model
{
    protected $fillable = array('start_time',
        'end_time',
        'period_time',
        'day_id',
        'workers_number'
    );
}
