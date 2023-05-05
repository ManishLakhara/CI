<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    use HasFactory;
    protected $primaryKey = 'country_id';

    protected $fillable = [
        'name', 'ISO'
    ];

    public function city() {
        return $this->hasMany(City::class, 'country_id');
    }

    public function User() {
        return $this->hasMany(User::class, 'country_id');
    }

    public function cities() {
        return $this->hasMany(City::class, 'country_id');
    }

    public function Users() {
        return $this->hasMany(User::class, 'country_id');
    }

    public function mission(): BelongsToMany{
        return $this->belongsToMany(Mission::class,'country_id');
    }
}
