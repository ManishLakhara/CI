<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionRating extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'mission_rating_id';
    protected $fillable = [
        'mission_id',
        'user_id',
        'rating',
    ];

    public function mission() {
        return $this->belongToMany(Mission::class, 'mission_id');
    }

    public function user() {
        return $this->belongToMany(User::class, 'user_id');
    }
}
