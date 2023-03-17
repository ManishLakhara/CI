<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalMission extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'goal_mission_id';
    protected $fillable=[
        'goal_objective_text',
        'goal_value',
        'mission_id',
    ];

    public function mission() {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
}
