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

    public function store()
    {
        if (!$this->request->hasFile('image') || !$this->request->file('image')->isValid()) {
            return $this->response->create([
                'error' => 'Photo upload failed, please ensure a reliable connection and try again',
            ], 400);
        }

        if (!$this->filesystemService->add($this->request->file('image'))) {
            return $this->response->create(['error' => 'Photo upload failed, please try again'], 500);
        }

        return $this->response->create(['ok' => true]);
    }

    public function destroy($id)
    {
        if (!$this->filesystemService->remove($id)) {
            return $this->response->create(['error' => 'Failed to remove photo'], 500);
        }

        return $this->response->create(['ok' => true]);
    }
}
