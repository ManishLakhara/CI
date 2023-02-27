<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'skill_id';

    protected $fillable = [
        'skill_name',
        'status',
    ];
    public function missionSkill() {
        return $this->belongsToMany(MissionSkill::class, 'skill_id');
    }

    public function userSkill() {
        return $this->hasMany(UserSkill::class, 'skill_id');
    }
}
