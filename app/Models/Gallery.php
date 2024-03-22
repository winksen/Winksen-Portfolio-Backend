<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Gallery extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'imageUrl',
        'title',
        'date',
        'location',
        'coordinates',
        'link',
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
        'tag11',
        'tag12',
        'tag13',
        'tag14',
        'tag15',
        'tag16',
        'tag17',
        'tag18',
        'tag19',
        'tag20',
        'tag21',
    ];

    protected $dates = ['date'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}