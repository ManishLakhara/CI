<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'story_id';

    protected $fillable = [
        'mission_id',
        'user_id'	,
        'title',
        'description',
        'status',
        'published_at',
    ];

    public function mission() {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function storyMedia() {
        return $this->hasMany(StoryMedia::class, 'story_id');
    }
    public function storyView() {
        return $this->hasMany(StoryViews::class, 'story_id','story_id');
    }
}
