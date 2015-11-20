<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\InfoRequest;
use Restaurant\Repositories\InfoRepo;
use Illuminate\Http\JsonResponse;

class InfoController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\InfoRepo
    protected $repository;

    // @var Restaurant\Http\InfoRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $response;

    // @var array - white-listed input values
    protected $whiteList = ['name', 'street', 'city', 'state', 'zip', 'phoneOne', 'phoneTwo'];

    /**
     * Initialize new instance
     *
     * @param Restaurant\Repositories\InfoRepo $repository
     * @param Restaurant\Http\Requests\InfoRequest $request
     * @param Illuminate\Http\JsonResponse $response
     */
    public function __construct(
        InfoRepo $repository,
        InfoRequest $request,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
    }
}
