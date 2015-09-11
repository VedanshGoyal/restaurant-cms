<?php

namespace Restaurant\Repositories;

use Restaurant\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CRUDRepo
{
    // @var Model
    protected $model;

    // @var array - relations to eager load
    protected $with = [];

    /**
     * Initialize a new instance
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a collection of models
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function readAll()
    {
        return $this->model->with($this->with)->orderBy('id', 'desc')->get();
    }

    /**
     * Get a single model by model id
     *
     * @param integer $modelId
     * @return Illuminate\Database\Eloquent\Model
     */
    public function readSingle($modelId)
    {
        return $this->model->where('id', $modelId)->with($this->with)->first();
    }

    /**
     * Create a new model record from array of input
     *
     * @param array $input
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $input = [])
    {
        return $this->attempt(function () use ($input) {
            return $this->model->create($input);
        });
    }
    /**
     * Update existing model record given model id and
     * array of input
     *
     * @param integer $modelId
     * @param array $input
     * @return Illuminate\Database\Eloquent\Model
     */
    public function update($modelId, array $input = [])
    {
        return $this->attempt(function () use ($modelId, $input) {
            return $this->model->find($modelId)->update($input);
        });
    }

    /**
     * Delete model record by model id
     *
     * @param integer $modelId
     * @return true
     */
    public function delete($modelId)
    {
        return $this->attempt(function () use ($modelId) {
            return $this->model->find($modelId)->delete();
        });
    }

    /**
     * Run the query inside a transaction
     *
     * @param callable $callback
     * @return mixed - model/collection
     */
    protected function attempt(callable $callback)
    {
        return DB::transaction(function () use ($callback) {
            return $callback();
        });
    }
}
