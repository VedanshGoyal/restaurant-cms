<?php

namespace Restaurant\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Restaurant\Exceptions\RepositoryException;

trait CRUDTrait
{
    // @var Model
    private $model;

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
     * @param array $with - relations to eager load
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function readAll(array $with = [])
    {
        $collection = $this->model->with($with)->orderBy('id', 'desc')->get();

        if (!$this->isValidCollection($collection)) {
            $logData = [
                'repository_model' => print_r($this->model, true),
                'query_collection' => print_r($model, true),
                'query_with' => print_r($with, true),
            ];

            throw new RepositoryException('Failed to fetch collection.', $logData);
        }

        return $collection;
    }

    /**
     * Get a single model by model id
     *
     * @param integer $modelId
     * @param array $with - relations to eager load
     * @return Illuminate\Database\Eloquent\Model
     */
    public function readSingle($modelId, array $with = [])
    {
        $model = $this->model->where('id', $modelId)->with($with)->first();

        if (!$this->isValidModel($model)) {
            $logData = [
                'repository_model' => print_r($this->model, true),
                'query_model' => print_r($model, true),
                'query_with' => print_r($with, true),
            ];

            throw new RepositoryException('Failed to fetch model.', $logData);
        }

        return $model;
    }

    /**
     * Create a new model record from array of input
     *
     * @param array $input
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create($input)
    {
        $model = $this->model->create($input);

        if (!$this->isValidModel($model)) {
            $logData = [
                'repository_model' => print_r($this->model, true),
                'query_model' => print_r($model, true),
                'query_input' => print_r($input, true),
            ];

            throw new RepositoryException('Failed to create new model.', $logData);
        }

        return $model;
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
        $model = $this->model->find($modelId);

        if (!$this->isValidModel($model) || !$model->update($input)) {
            $logData = [
                'repository_model' => print_r($this->model, true),
                'query_model' => print_r($model, true),
                'query_id' => sprintf('%d', $modelId),
                'query_input' => print_r($input, true),
            ];

            throw new RepositoryException('Failed to update model.', $logData);
        }

        return $model;
    }

    /**
     * Delete model record by model id
     *
     * @param integer $modelId
     * @return true
     */
    public function delete($modelId)
    {
        $model = $this->model->find($modelId);

        if (!$this->isValidModel($model) || !$model->delete()) {
            $logData = [
                'repository_model' => print_r($this->model, true),
                'query_model' => print_r($model, true),
                'query_id' => sprintf('%d', $modelId),
            ];

            throw new RepositoryException('Failed to delete model', $logData);
        }

        return true;
    }

    /**
     * Check if a model is valid
     *
     * @param model
     * @return bool
     */
    protected function isValidModel($model)
    {
        return (bool) $model && $model instanceof Model;
    }

    /**
     * Check if collection is valid
     *
     * @param collection
     * @return bool
     */
    protected function isValidCollection($collection)
    {
        return (bool) $collection && $collection instanceof Collection;
    }
}
