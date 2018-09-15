<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ImageRated extends Notification
{
    /**
     * Image property.
     *
     * @var string
     */
    protected $image;

    /**
     * Rate.
     *
     * @var integer
     */
    protected $rate;

    /**
     * User.
     *
     * @var integer
     */
    protected $user_id;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Image  $image
     * @param  integer
     * @param  integer
     * @return void
     */
    public function __construct($image, $rate, $user_id)
    {
        $this->image = $image;
        $this->rate = $rate;
        $this->user_id = $user_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via()
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray()
    {
        return [
            'image' => $this->image->name,
            'image_id' => (integer)$this->image->id,
            'rate' => (integer)$this->rate,
            'user' => (integer)$this->user_id
        ];
    }
}
