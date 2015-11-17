<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\PhotoRequest;
use Restaurant\Repositories\PhotoRepo;
use Restaurant\Services\UploadService;
use Illuminate\Http\JsonResponse;

class PhotosController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\PhotoRepo
    protected $repository;

    // @var Restaurant\Http\PhotoRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $reponse;

    // @var Restaurant\Services\UploadService
    protected $uploadService;

    public function __construct(
        PhotoRepo $repository,
        PhotoRequest $request,
        JsonResponse $response,
        UploadService $uploadService
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
        $this->uploadService = $uploadService;
    }

    public function upload()
    {
    }

    public function destroy()
    {
    }
}
