<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary_deduction extends Model
{
    /*protected $casts = [
    'quantity' => 'array',
];*/
    use HasFactory;
    public $timestamps = false;
    protected $table='salary_deductions';
    protected $primaryKey='id';
    protected $fillable = [
        'product',
        'price',
        'pay_id',
        
    ];



}
