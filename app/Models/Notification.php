<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='notifications';
    protected $primaryKey='notifications_id';
    protected $fillable = [
        'notifications_id',
        'user_id',
        'status',
        'message'
        

    ];



}
