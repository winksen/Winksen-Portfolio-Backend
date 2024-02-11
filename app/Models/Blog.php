<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Blog extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'imageUrl',
        'title',
        'author',
        'link',
        'readTime',
        'publishDate',
        'revisions',
        'likeCount',
        'commentCount',
        'isNew',
        'isHot',
        'isFeatured',
        'description',
    ];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
