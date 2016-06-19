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
    protected $response;

    // @var array - white-listed input values
    protected $whiteList = ['day', 'open', 'close', 'is_closed'];

    /**
     * Initialize new instance
     *
     * @param Restaurant\Repositories\HourRepo $repository
     * @param Restaurant\Http\Requests\HourRequest $request
     * @param Illuminate\Http\JsonResponse $response
     */
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
