<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_skill_id';

    public function user() {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function skill() {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
