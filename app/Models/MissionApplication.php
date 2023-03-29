<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionApplication extends Model
{
    use HasFactory;
    protected $primaryKey = 'mission_application_id';
    protected $fillable = [
        'user_id',
        'mission_id',
        'approval_status',
    ];

    public function mission() {
        return $this->hasMany(Mission::class, 'mission_id');
    }

    public function user() {
        return $this->belongTo(user::class, 'user_id');
    }
}
