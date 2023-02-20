<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $primaryKey = 'city_id';

    public function Country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function User() {
        return $this->hasMany(User::class, 'city_id');
    }
}
