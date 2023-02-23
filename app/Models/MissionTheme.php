<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionTheme extends Model
{
    use HasFactory;
    protected $primaryKey = 'mission_theme_id';

    protected $fillable = [
        'title',
        'status',
    ];
    public function mission() {
        $this->hasMany(Mission::class, 'mission_id');
    }
}
