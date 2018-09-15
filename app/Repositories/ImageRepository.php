<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageRepository
{
    /**
     * Store image.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function store($request)
    {
        // Save image
        $path = basename ($request->image->store('images'));

        // Save thumb
        $image = InterventionImage::make ($request->image)->widen (500)->encode ();
        Storage::put ('thumbs/' . $path, $image);

        // Save in base
        $image = new Image;
        $image->description = $request->description;
        $image->category_id = $request->category_id;
        $image->adult = isset($request->adult);
        $image->name = $path;
        $request->user()->images()->save($image);
    }

    /**
     * Paginate and rate.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateAndRate($query)
    {
        $images = $query->paginate (config ('app.pagination'));

        return $this->setRating ($images);
    }

    /**
     * Get all images.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllImages()
    {
        return $this->paginateAndRate (Image::latestWithUser());
    }

    /**
     * Get images for category.
     *
     * @param  string $slug
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getImagesForCategory($slug)
    {
        $query = Image::latestWithUser ()->whereHas ('category', function ($query) use ($slug) {
            $query->whereSlug ($slug);
        });

        return $this->paginateAndRate ($query);
    }

    /**
     * Set rating values for images.
     *
     * @param  \Illuminate\Pagination\LengthAwarePaginator
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function setRating($images)
    {
        $images->transform(function ($image) {
            $this->setImageRate ($image);
            return $image;
        });

        return $images;
    }

    /**
     * Set image rate.
     *
     * @param  \Illuminate\Support\Collection
     * @return void
     */
    public function setImageRate($image)
    {
        $number = $image->users->count();

        $image->rate = $number ? $image->users->pluck ('pivot.rating')->sum () / $number : 0;
    }

    /**
     * Get images for album.
     *
     * @param  string $slug
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getImagesForAlbum($slug)
    {
        $query = Image::latestWithUser ()->whereHas ('albums', function ($query) use ($slug) {
            $query->whereSlug ($slug);
        });

        return $this->paginateAndRate ($query);
    }

    /**
     * Get images for user.
     *
     * @param  integer $id
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getImagesForUser($id)
    {
        $query = Image::latestWithUser ()->whereHas ('user', function ($query) use ($id) {
            $query->whereId ($id);
        });

        return $this->paginateAndRate ($query);
    }

    /**
     * Destroy orphans images.
     *
     * @return void
     */
    public function destroyOrphans()
    {
        $orphans = $this->getOrphans ();

        foreach ($orphans as $orphan) {
            Storage::delete ([
                'images/' . $orphan,
                'thumbs/' . $orphan,
            ]);
        }
    }

    /**
     * Get all orphans images.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getOrphans()
    {
        return collect (Storage::files ('images'))->transform(function ($item) {
            return basename($item);
        })->diff (Image::select ('name')->pluck ('name'));
    }

    /**
     * Check is user is image owner.
     *
     * @param  \App\Models\User
     * @param  \App\Models\Image
     * @return boolean
     */
    public function isOwner($user, $image)
    {
        return $image->user()->where('users.id', $user->id)->exists();
    }

    /**
     * Rate image.
     *
     * @param  \App\Models\User
     * @param  \App\Models\Image
     * @param  integer
     * @return boolean
     */
    public function rateImage($user, $image, $value)
    {
        $rate = $image->users()->where('users.id', $user->id)->pluck('rating')->first();

        if($rate) {
            if($rate !== $value) {
                $image->users ()->updateExistingPivot ($user->id, ['rating' => $value]);
            }
        } else {
            $image->users ()->attach ($user->id, ['rating' => $value]);
        }

        return $rate;
    }

    /**
     * Check if image is not in album.
     *
     * @param  \App\Models\Image
     * @param  \App\Models\Album
     * @return boolean
     */
    public function isNotInAlbum($image, $album)
    {
        return $image->albums()->where('albums.id', $album->id)->doesntExist();
    }
}