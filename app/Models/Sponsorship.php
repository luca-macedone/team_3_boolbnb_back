<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsorship extends Model
{
    protected $fillable = ['name', 'duration', 'price', 'description'];

    public function apartments(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class);
    }
}
