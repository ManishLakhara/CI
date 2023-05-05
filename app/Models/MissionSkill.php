<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionSkill extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'mission_skill_id';

    protected $fillable = [
        'skill_id',
        'mission_id'
    ];

    public function mission(){
        return $this->hasOne(Mission::class, 'mission_id','mission_id');
    }

    public function skill(){
        return $this->hasOne(Skill::class, 'skill_id','skill_id');
    }
}
