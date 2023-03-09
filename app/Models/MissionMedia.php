<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionMedia extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'mission_id',
        'media_name',
        'media_type',
        'media_path',
        'default',
    ];
    protected $primaryKey = 'mission_media_id';





    public function mission() {
        return $this->belongsTo(Mission::class,'mission_id');
    }

}
