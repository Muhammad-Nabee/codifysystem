<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='products';
    protected $primaryKey='product_id';
    protected $fillable = [
        'product_id',
        'item',
        'quantity',
        'price',
        'invoices_id'
        

    ];



}
