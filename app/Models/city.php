<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $primaryKey = 'city_id';
    protected $table = 'city';
    
    public function country(){
        return $this->hasMany(country::class,'country_id','city_id');
    }
}
