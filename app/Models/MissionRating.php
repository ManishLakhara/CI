<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionRating extends Model
{
    use HasFactory;
    protected $primaryKey = 'mission_skill_id';

    public function mission() {
        return $this->belongToMany(Mission::class, 'mission_id');
    }

    public function user() {
        return $this->belongToMany(User::class, 'user_id');
    }
}
