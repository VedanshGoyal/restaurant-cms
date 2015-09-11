<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Controllers\Controller;

trait RESTTrait
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $collection = $this->repository->readAll();

        if (!$collection) {
            return $this->response->create([
                'error' => 'Could not find requested resources.',
            ], 404);
        }

        return $this->response->create($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = $this->request->only($this->whiteList);
        $model = $this->repository->create($input);

        if (!$model) {
            return $this->response->create([
                'error' => 'Failed to create new resource.',
            ], 400);
        }

        return $this->response->create($model);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $model = $this->repository->readSingle($id);

        if (!$model) {
            return $this->response->create([
                'error' => 'Failed to find requested resource.',
            ], 404);
        }

        return $this->response->create($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {
        $input = $this->request->only($this->whiteList);
        $model = $this->repository->update($id, $input);

        if (!$model) {
            return $this->response->create([
                'error' => 'Failed to update resource.',
            ], 400);
        }

        return $this->response->create($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->repository->delete($id);

        if (!$isDeleted) {
            return $this->response->create([
                'error' => 'Failed to delete resource.',
            ], 400);
        }

        return $this->response->create(['ok' => $isDeleted]);
    }
}
