<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionTheme extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $primaryKey = 'mission_theme_id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'title',
        'status',
    ];
    public function mission() {
        $this->hasMany(Mission::class, 'mission_id');
    }
}
