<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


class View extends Model
{
    use HasFactory;

    protected $fillable = ['date','ip','apartment_id'];
    /**
     * The views that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function views():BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
