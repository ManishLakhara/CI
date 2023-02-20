<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $primaryKey = 'story_id';

    public function mission() {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function storyMedia() {
        return $this->hasMany(StoryMedia::class, 'story_id');
    }
}
