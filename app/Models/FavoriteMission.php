<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavoriteMission extends Model
{
    use HasFactory;
    protected $primaryKey = 'favorite_mission_id';
    protected $fillable = [
        'mission_id',
        'user_id',
    ];

    public function user() {
        return $this->hasOne(User::class, 'user_id');
    }

    public function mission() {
        return $this->hasOne(Mission::class, 'mission_id');
    }
}
