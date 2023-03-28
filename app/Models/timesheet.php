<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeSheet extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'timesheet_id';
    use SoftDeletes;

    protected $fillable=[
        'user_id',
        'mission_id',
        'time',
        'action',
        'date_volunteered',
        'notes',
        'status',
     ];
    public function mission() {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
