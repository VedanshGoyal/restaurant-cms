<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\HourRequest;
use Restaurant\Repositories\HourRepo;
use Illuminate\Http\JsonResponse;

class HoursController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\HourRepo
    protected $repository;

    // @var Restaurant\Http\HoursRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $reponse;

    // @var array - white-listed input values
    protected $whiteList = ['day', 'open', 'closed', 'isClosed'];

    public function __construct(
        HourRepo $repository,
        HourRequest $request,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
    }
}
