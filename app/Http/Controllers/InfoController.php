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
    protected $reponse;

    // @var array - white-listed input values
    protected $whiteList = ['name', 'street', 'city', 'state', 'zip', 'phoneOne', 'phoneTwo'];

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
