<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Content extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'blog_id',
        'type',
        'content',
        'listTitle',
        'tableTitle',
        'tableDescription',
        'imageUrl',
        'imageAlt',
        'imageDescription',
        'imageCredits',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
