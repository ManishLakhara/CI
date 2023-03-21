<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalMission extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'goal_mission_id';
    protected $dates = ['deleted_at'];

    protected $fillable=[
        'mission_id',
        'goal_objective_text',
        'goal_value',
        'registration_deadline',
    ];

    public function missions(): BelongsTo {
        return $this->belongsTo(Mission::class,'mission_id','mission_id');
    }
}
