<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionDocument extends Model
{
    use HasFactory;
    protected $primaryKey = 'mission_document_id';

    public function mission() {
        return $this->belongTo(Mission::class, 'mission_id');
    }

    protected $fillable = [
        'document_path',
        'document_name',
        'document_type',
         'mission_id',

    ];
}
