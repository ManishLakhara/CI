<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryMedia extends Model
{
    use HasFactory;
    protected $primaryKey = 'story_media_id';

    public function story() {
        return $this->belongsTo(Story::class, 'story_id');
    }
}
