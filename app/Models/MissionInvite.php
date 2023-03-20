<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionInvite extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'mission_invite_id';
    protected $fillable = [
        'mission_id',
        'from_user_id',
        'to_user_id',
    ];
}
