<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    /*protected $casts = [
    'quantity' => 'array',
];*/
    use HasFactory;
    public $timestamps = false;
    protected $table='salarys';
    protected $primaryKey='pay_id';
    protected $fillable = [
        'pay_id',
        'user_id',
        'total_time',
        'salary',
        'deduct',
        'date'
    ];



}
