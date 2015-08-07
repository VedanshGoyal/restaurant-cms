<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\PhotosRequest;
use Restaurant\Repositories\PhotosRepo;
use Illuminate\Http\JsonResponse;

class PhotosController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\PhotosRepo
    protected $repository;

    // @var Restaurant\Http\PhotosRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $reponse;

    // @var array - white-listed input values
    protected $whiteList = ['image', 'path'];

    public function __construct(
        PhotosRepo $repository,
        PhotosRequest $request,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
    }
}
