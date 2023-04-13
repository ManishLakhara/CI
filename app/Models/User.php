<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'country_id',
        'city_id',
        'employee_id',
        'department',
        'status',
        'profile_text',
        'avatar',
        'title',
        'why_i_volunteer',
        'linked_in_url',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function missionApplication()
    {
        return $this->hasMany(MissionApplication::class, 'user_id');
    }

    public function missionRating()
    {
        return $this->hasMany(MissionRating::class, 'user_id');
    }

    public function story()
    {
        return $this->hasMany(Story::class, 'user_id');
    }

    public function comment()
    {
        return $this->hasMany(comment::class, 'user_id');
    }

    public function favoriteMission()
    {
        return $this->hasMany(FavoriteMission::class, 'user_id');
    }

    public function timeSheet()
    {
        return $this->hasMany(TimeSheet::class, 'user_id');
    }
    
}
