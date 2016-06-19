<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\AboutRequest;
use Restaurant\Repositories\AboutRepo;
use Illuminate\Http\JsonResponse;

class AboutController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\AboutRepo
    protected $repository;

    // @var Restaurant\Http\AboutRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $response;

    // @var array - white-listed input values
    protected $whiteList = ['title', 'content'];

    /**
     * Initialize new instance
     *
     * @param Restaurant\Repositories\AboutRepo $repository
     * @param Restaurant\Http\Requests\AboutRequest
     * @param Illuminate\Http\JsonResponse $response
     */
    public function __construct(
        AboutRepo $repository,
        AboutRequest $request,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
    }
}
