<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Schedule extends Model
{
    protected $table = 'schedule';

    protected $guarded = ['id'];

    protected $dates = ['tangggal'];
}
