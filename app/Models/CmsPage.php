<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmsPage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'cms_page_id';
    protected $fillable = [
        'title',
        'text',
        'slug',
        'status',

    ];
}
