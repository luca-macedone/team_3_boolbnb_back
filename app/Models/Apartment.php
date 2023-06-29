<?php

namespace App\Models;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'rooms', 'beds', 'square_meters', 'bathrooms', 'image', 'visibility', 'latitude', 'longitude', 'full_address', 'user_id'];

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sponsorships(): BelongsToMany
    {
        return $this->belongsToMany(Sponsorship::class)->withPivot('starting_date', 'ending_date');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
