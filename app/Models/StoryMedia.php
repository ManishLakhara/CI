<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoryMedia extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'story_media_id';

    protected $fillable = [
        'story_id',
        'type',
        'path',
    ];

    public function story() {
        return $this->belongsTo(Story::class, 'story_id');
    }
}
