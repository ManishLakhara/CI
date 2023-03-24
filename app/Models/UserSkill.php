<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSkill extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'user_skill_id';


    protected $fillable = [
        'user_id',
        'skill_id'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
