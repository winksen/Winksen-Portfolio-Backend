<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Identity extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'logo',
        'logoMark',
        'logoSecondary1',
        'logoMarkSecondary1',
        'logoSecondary2',
        'logoMarkSecondary2',
        'logoSecondary3',
        'logoMarkSecondary3',
        'logoSecondary4',
        'logoMarkSecondary4',
        'logoBW',
        'logoMarkBW',
        'typography',
        'typographyImage',
        'mockup1',
        'mockup2',
        'mockup3',
        'mockup4',
        'mockup5',
        'mockup6',
        'mockup7',
        'title',
        'date',
        'description',
        'isNew',
        'isHot',
        'isFeatured',
        'tag1',
        'tag2',
        'tag3',
        'tag4',
        'tag5',
        'tag6',
        'tag7',
        'tag8',
        'tag9',
        'tag10',
    ];
}
