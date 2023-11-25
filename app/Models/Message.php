<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Message extends Model
{
    use HasFactory;

    protected $fillable = ['apartment_id', 'email', 'message', 'name', 'lastname', 'is_read'];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function mark_messages(Message $message)

    {
        if( $message->is_read !== 1)
        {
            $message->is_read = 1;
            $message->save();
            return true;
        }
        return false;
    }

    public static function getUnreadMessageCount() {
        $new_messages_count = Message::where('is_read', 0)->count();
        return $new_messages_count;
    }
}
