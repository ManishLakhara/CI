<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavoriteMission extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'favorite_mission_id';
    protected $fillable = [
        'mission_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mission() {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
}
