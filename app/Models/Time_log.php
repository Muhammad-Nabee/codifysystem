<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time_log extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='time_log';
    protected $fillable = [
        'id',
        'user_id',
        'p_id',
        't_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time'
        

    ];



}