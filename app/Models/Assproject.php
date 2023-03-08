<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignproject extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table='assignprojects';
    protected $fillable = [
        'assign_id',
        'emp_id',
        'project_id',
        'assign_date',
        'assign_p_deadline',
        'client_p_id'

    ];



}
