<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use softDeletes, Configrable, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'source',
        'category',
        'url',
        'published_at',
    ];

}
