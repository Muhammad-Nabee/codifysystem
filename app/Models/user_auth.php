<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_auth extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $primaryKey = 'p_id';
    protected $table='projects';
     protected $fillable = [
        'p_id',
        'p_title',
        'p_description',
        'p_deadline',
        'p_budjet',
        
        
    ];
}
