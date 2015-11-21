<?php

namespace Restaurant\Http\Controllers;

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
                'meta' => ['message' => 'Failed to find requested content'],
            ], 404);
        }

        return $this->response->create(['data' => $collection]);
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
                'meta' => ['message' => 'Failed to create new content'],
            ], 404);
        }

        return $this->response->create(['data' => $model]);
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
                'meta' => ['message' => 'Failed to find requested content'],
            ], 404);
        }

        return $this->response->create(['data' => $model]);
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
                'meta' => ['message' => 'Failed to update content'],
            ], 500);
        }

        return $this->response->create([
            'meta' => ['message' => 'Content successfully updated'],
            'data' => $model,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!$this->repository->delete($id)) {
            return $this->response->create([
                'meta' => ['message' => 'Failed to remove content'],
            ], 500);
        }

        return $this->response->create([
            'meta' => ['message' => 'Content removed successfully'],
        ]);
    }
}
