<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $primaryKey = 'p_id';
    public $timestamps = false;
    protected $table='projects';
    protected $fillable = [
        'p_id',
        'p_title',
        'p_description',
        'p_client_id',
        'p_deadline',
        'p_created_at',
        'p_status'
        

    ];



}
