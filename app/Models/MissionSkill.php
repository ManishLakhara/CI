<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionSkill extends Model
{
    use HasFactory;
    protected $primaryKey = 'mission_skill_id';

    public function mission() {
        return $this->hasMany(Mission::class, 'mission_id');
    }

    public function skill(){
        return $this->hasOne(Skill::class, 'skill_id');
    }
}
