<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Notice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='notices';
    protected $primaryKey='notifi_id';
    protected $fillable = [
        'notifi_id',
        'notice',
        'created_at',
        'updated_at',
        'desiniation'
        

    ];



}
