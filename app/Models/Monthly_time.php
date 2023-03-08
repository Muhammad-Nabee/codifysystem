<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthly_time extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table='monthly_times';
    protected $fillable = [
        'id',
        'monthly_time',
        'user_id',
        'add_date'
        

    ];



}
