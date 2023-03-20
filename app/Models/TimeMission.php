<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeMission extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'time_mission_id';
    protected $dates = ['deleted_at'];

    protected $fillable=[
        'mission_id',
        'total_seats',
        'registration_deadline',
    ];
}
