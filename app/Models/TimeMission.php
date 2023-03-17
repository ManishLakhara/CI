<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeMission extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'total_seats',
        'registration_deadline',
    ];
}
