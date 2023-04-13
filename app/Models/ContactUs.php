<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'contact_us_id';

    protected $fillable = [
     'user_id',
     'subject',
     'message',
    ];

    public function user() {
        return $this->belongTo(User::class, 'user_id');
    }
}
