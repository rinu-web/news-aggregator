<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'categories', 'sources'];

    protected $casts = [
        'categories' => 'array', // Automatically converts JSON to an array
        'sources' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

