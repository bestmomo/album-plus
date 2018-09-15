<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * Get the category that owns the image.
     */
    public function category()
    {
        return $this->belongsTo (Category::class);
    }

    /**
     * Get the album that owns the image.
     */
    public function albums()
    {
        return $this->belongsToMany (Album::class);
    }

    /**
     * Get the user that owns the image.
     */
    public function user()
    {
        return $this->belongsTo (User::class);
    }

    /**
     * Get the users that rate the image.
     */
    public function users()
    {
        return $this->belongsToMany (User::class)->withPivot('rating');
    }

    /**
     * Scope a query eager load users and order query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatestWithUser($query)
    {
        $user = auth()->user();

        if($user && $user->adult) {
            return $query->with ('users', 'user')->latest ();
        }

        return $query->with ('users', 'user')->whereAdult(false)->latest ();
    }
}
