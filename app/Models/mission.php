<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class Mission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'mission_type',
        'status',
        'theme_id',
        'country_id',
        'city_id',
        'start_date',
        'end_date',
        'organization_name',
        'organization_detail',
        'availability',
    ];


    protected $primaryKey = 'mission_id';
    protected $dates = ['deleted_at'];

    public function skill(): BelongsToMany {
        return $this->belongsToMany(Skill::class, 'mission_skills','mission_id','skill_id');
    }

    public function country(): HasOne {
        return $this->hasOne(Country::class, 'country_id','country_id');
    }
    public function city(): HasOne {
        return $this->hasOne(City::class, 'city_id','city_id');
    }
    public function missionTheme(): HasOne{
        return $this->hasOne(MissionTheme::class, 'mission_theme_id', 'theme_id');
    }

    public function missionApplication() {
        return $this->hasMany(MissionApplication::class,'mission_id','mission_id');
    }

    public function missionDocument() {
        return $this->hasMany(MissionDocument::class, 'mission_id');
    }

    public function missionMedia() {
        return $this->hasMany(MissionMedia::class, 'mission_id');
    }

    public function missionRating() {
        return $this->hasMany(MissionRating::class, 'mission_id','mission_id');
    }

    public function missionSkill(){
        return $this->hasMany(MissionSkill::class, 'mission_id','mission_id');
    }

    public function story() {
        return $this->hasMany(Story::class, 'mission_id');
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'mission_id');
    }

    public function favoriteMission() {
        return $this->belongsTo(FavoriteMission::class, 'mission_id','mission_id');
    }

    public function goalMission(): HasOne {
        return $this->hasOne(GoalMission::class, 'mission_id','mission_id');
    }

    public function timeMission(): HasOne {
        return $this->hasOne(TimeMission::class, 'mission_id','mission_id');
    }

    public function timeSheet() {
        return $this->hasMany(TimeSheet::class, 'mission_id');
    }

    public function userSkill() {
        return $this->hasOne(UserSkill::class, 'mission_id');
    }
}
