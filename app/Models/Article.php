<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Article",
 *     type="object",
 *     title="Article",
 *     description="Article model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Breaking News"),
 *     @OA\Property(property="content", type="string", example="Article content here..."),
 *     @OA\Property(property="author", type="string", example="John Doe"),
 *     @OA\Property(property="source", type="string", example="The Guardian"),
 *     @OA\Property(property="category", type="string", example="Technology"),
 *     @OA\Property(property="url", type="string", format="url", example="https://example.com"),
 *     @OA\Property(property="published_at", type="string", format="date-time", example="2025-03-14T12:00:00Z")
 * )
 */

class Article extends Model
{
    use SoftDeletes, HasFactory;

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
