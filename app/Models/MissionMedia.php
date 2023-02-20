<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionMedia extends Model
{
    use HasFactory;
    protected $primaryKey = 'mission_media_id';

    public function mission() {
        return $this->belongsTo(Mission::class,'mission_id');
    }
}
