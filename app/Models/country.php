<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;

    protected $primaryKey = 'country_id';

    protected $table = 'country';
    
    public function city(){
        return $this->belongsTo(city::class,'country_id');
    }
}
