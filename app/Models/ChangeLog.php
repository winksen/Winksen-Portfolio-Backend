<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Changelog extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'href',
        'version',
        'comment',
        'date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'date',
    ];
}
