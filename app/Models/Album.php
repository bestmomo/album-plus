<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\NameSaving;

class Album extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saving' => NameSaving::class,
    ];

    /**
     * Get the images.
     */
    public function images()
    {
        return $this->belongsToMany (Image::class);
    }

    /**
     * Get the user that owns the album.
     */
    public function user()
    {
        return $this->belongsTo (User::class);
    }
}
