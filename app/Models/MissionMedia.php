<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'mission_id',
        'mission_name',
        'mission_type',
        'mission_path',
        'default',
    ];
    protected $primaryKey = 'mission_media_id';




    protected $fillable = [
        'mission_id',
        'media_name',
        'media_type',
        'media_path',
        'default'
    ];

    public function mission() {
        return $this->belongsTo(Mission::class,'mission_id');
    }

}
