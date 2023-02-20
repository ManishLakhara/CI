<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function missionApplication(){
        return $this->hasMany(MissionApplication::class, 'user_id');
    }

    public function missionRating() {
        return $this->hasMany(MissionRating::class, 'user_id');
    }

    public function story() {
        return $this->hasMany(Story::class, 'user_id');
    }

    public function comment() {
        return $this->hasMany(comment::class, 'user_id');
    }

    public function favoriteMission() {
        return $this->hasMany(FavoriteMission::class, 'user_id');
    }

    public function timeSheet() {
        return $this->hasMany(TimeSheet::class, 'user_id');
    }
}