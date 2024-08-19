<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact_id'
    ];



    // Relationships
    function user()
    {
        return $this->belongsTo(User::class);
    }

    function contact()
    {
        return $this->belongsTo(User::class, 'contact_id');
    }

    function message()
    {
        return $this->hasMany(Message::class, 'chat_id');
    }
    //----------

    // Scope
    function scopeCurrentUserChats($query)
    {
        return $query->where('user_id', Auth::user()->id)
            ->orWhere('contact_id', Auth::user()->id);

    }

    function scopeSearch($query, $search_contact_query)
    {
        return $query->whereHas('contact', function ($query) use ($search_contact_query) {
            $query->where('name', 'LIKE', "%$search_contact_query%")
                ->orWhere('email', 'LIKE', "%$search_contact_query%");
        });
    }

    function scopeWhoIsTheContactedUser()
    {

    }

    function scopeIsTherePreviousChat($query, $user_id)
    {
        // making there is no existing chat between the two users
        if ($user_id) {
            return $query
                ->where('user_id', Auth::user()->id)->where('contact_id', $user_id)
                ->orWhere(function ($query) use ($user_id) {
                    $query->where('contact_id', Auth::user()->id)
                        ->where('user_id', $user_id);
                })->exists();
        }
    }
    //-------
}