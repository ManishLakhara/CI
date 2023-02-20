<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $primaryKey = 'skill_id';

    public function missionSkill() {
        return $this->belongsToMany(MissionSkill::class, 'skill_id');
    }

    public function userSkill() {
        return $this->hasMany(UserSkill::class, 'skill_id');
    }
}
