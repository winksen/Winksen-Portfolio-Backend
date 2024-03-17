<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Image extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gallery_id',
        'imageUrl',
        'title',
        'alt',
        'gallery',
        'date',
        'location',
        'dimensions',
        'imageType',
        'fileName',
        'camera',
        'lens',
        'cameraType',
        'focalLength',
        'shutterSpeed',
        'aperture',
        'iso',
        'software',
        'rating',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
