<?php

namespace App\Repositories;

abstract class BaseRepository
{
    /**
     * Model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Store a new model.
     *
     * @param  array  $inputs
     * @return \Illuminate\Database\Eloquent\Model
     */
	public function store(array $inputs)
	{
		return $this->model->create($inputs);
	}

    /**
     * Get model by slug.
     *
     * @param  string
     * @return \Illuminate\Database\Eloquent\Model $model
     */
    public function getBySlug($slug)
    {
        return $this->model->whereSlug($slug)->firstOrFail();
    }

    /**
     * Get model by user.
     *
     * @param  integer
     * @return \Illuminate\Database\Eloquent\Model $model
     */
    public function getByUser($id)
    {
        return $this->model->whereUserId($id)->get();
    }

    /**
     * Get all.
     *
     * @param  string
     */
    public function getAll()
    {
        return $this->model->all();
    }
}