<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\PhotoRequest;
use Restaurant\Repositories\PhotoRepo;
use Restaurant\Services\FilesystemService;
use Illuminate\Http\JsonResponse;

class PhotosController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\PhotoRepo
    protected $repository;

    // @var Restaurant\Http\PhotoRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $response;

    // @var Restaurant\Services\FilesystemService
    protected $filesystemService;

    /**
     * Initialize new instance
     *
     * @param Restaurant\Repositories\PhotoRepo $repository
     * @param Restaurant\Http\Requests\PhotoRequest $request
     * @param Illuminate\Http\JsonResponse $response
     * @param Restaurant\Services\FilesystemService $filesystemService
     */
    public function __construct(
        PhotoRepo $repository,
        PhotoRequest $request,
        JsonResponse $response,
        FilesystemService $filesystemService
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
        $this->filesystemService = $filesystemService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (!$this->request->hasFile('image') || !$this->request->file('image')->isValid()) {
            return $this->response->create([
                'error' => 'Photo upload failed, please ensure a reliable connection and try again',
            ], 400);
        }

        if ($this->filesystemService->add($this->request->file('image'))) {
            return $this->response->create(['ok' => true]);
        }

        return $this->response->create(['error' => 'Photo upload failed, please try again'], 500);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->filesystemService->remove($id)) {
            return $this->response->create(['ok' => true]);
        }

        return $this->response->create(['error' => 'Failed to remove photo'], 500);
    }
}
