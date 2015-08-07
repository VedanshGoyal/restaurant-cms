<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Controllers\Controller;

trait RESTTrait
{
    // @var Restaurant\Repositories\Repository
    protected $repository;

    // @var Restaurant\Http\Request
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $reponse;

    // @var array - relations to query when fetching model data
    protected $with;

    // @var array - white-listed input vcalues
    protected $whiteList;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $collection = $this->repository->readAll($this->with);

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

        return $this->response->create($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $model = $this->repository->readSingle($id);

        return $this->response->create($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = $this->request->only($this->whiteList);
        $model = $this->repository->update($id, $input);

        return $this->response->create($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->repository->delete($id);

        return $this->response->create(['ok' => $isDeleted]);
    }
}
