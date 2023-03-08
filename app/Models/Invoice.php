<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /*protected $casts = [
    'quantity' => 'array',
];*/
    use HasFactory;
    public $timestamps = false;
    protected $table='invoices';
    protected $primaryKey='invoice_id';
    protected $fillable = [
        'invoice_id',
        'project_id',
        'client_id',
        'quantity'
    ];



}
