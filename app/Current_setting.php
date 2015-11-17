<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Current_setting extends Model
{
    protected $fillable = array('day_date',
        'period_start_time',
        'period_end_time',
        'workers_number',
        'period_time',
    );
}
