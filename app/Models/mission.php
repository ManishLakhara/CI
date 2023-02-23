<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;
    protected $primaryKey = 'mission_id';

    public function missionTheme() {
        return $this->belongTo(MissionTheme::class, 'mission_id');
    }

    public function missionApplication() {
        return $this->hasMany(MissionApplication::class,'mission_id');
    }

    public function missionDocument() {
        return $this->hasMany(MissionDocument::class, 'mission_id');
    }

    public function missionMedia() {
        return $this->hasMany(MissionMedia::class, 'mission_id');
    }

    public function missionRating() {
        return $this->hasMany(MissionMedia::class, 'mission_id');
    }

    public function missionSkill(){
        return $this->belongTo(MissionSkill::class, 'mission_id');
    }

    public function story() {
        return $this->hasMany(Story::class, 'mission_id');
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'mission_id');
    }

    public function favoriteMission() {
        return $this->hasMany(FavoriteMission::class, 'mission_id');
    }

    public function goalMission() {
        return $this->hasOne(GoalMission::class, 'mission_id');
    }

    public function timeSheet() {
        return $this->hasMany(TimeSheet::class, 'mission_id');
    }

    public function userSkill() {
        return $this->hasOne(UserSkill::class, 'mission_id');
    }
}