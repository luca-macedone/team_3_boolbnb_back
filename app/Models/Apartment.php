<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'rooms', 'beds', 'square_meters', 'bathrooms', 'image', 'visibility', 'latitude', 'longitude','full_address' ];


    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }
}
