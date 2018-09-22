<?php

namespace App\Models;

use App\Events\UserCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'settings', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];


    /**
     * Get the images.
     */
    public function images()
    {
        return $this->hasMany (Image::class);
    }

    /**
     * Get the albums.
     */
    public function albums()
    {
        return $this->hasMany (Album::class);
    }

    /**
     * Get the images rated by the user.
     */
    public function imagesRated()
    {
        return $this->belongsToMany (Image::class);
    }

    /**
     * Get the adult status.
     *
     * @return boolean
     */
    public function getAdultAttribute()
    {
        return $this->settings->adult;
    }

    /**
     * Get the pagination value status.
     *
     * @return integer
     */
    public function getPaginationAttribute()
    {
        return $this->settings->pagination;
    }

    /**
     * Get the settings.
     *
     * @param Json $value
     * @return integer
     */
    public function getSettingsAttribute($value)
    {
        return json_decode ($value);
    }

    /**
     * User is admin.
     *
     * @return integer
     */
    public function getAdminAttribute()
    {
        return $this->role === 'admin';
    }

    /**
     * Set the adult attribute.
     *
     * @param  bool  $value
     * @return void
     */
    public function setAdultAttribute($value)
    {
        $this->attributes['settings'] = json_encode ([
            'adult' => $value,
            'pagination' => $this->settings->pagination
        ]);
    }
}
