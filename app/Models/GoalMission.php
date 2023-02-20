<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalMission extends Model
{
    use HasFactory;
    protected $primaryKey = 'goal_mission_id';

    public function mission() {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
}
