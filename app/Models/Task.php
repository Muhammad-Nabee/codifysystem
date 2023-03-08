<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $primaryKey = 'task_id';
    public $timestamps = false;
    protected $table='tasks';
    protected $fillable = [
        'task_id',
        'project_id',
        'title',
        'start_date',
        'end_date',
        'empolyee_id',
        

    ];



}
