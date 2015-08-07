<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\HoursRequest;
use Restaurant\Repositories\HoursRepo;
use Illuminate\Http\JsonResponse;

class HoursController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\HoursRepo
    protected $repository;

    // @var Restaurant\Http\HoursRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $reponse;

    // @var array - white-listed input vcalues
    protected $whiteList = ['day', 'open', 'closed', 'isClosed'];

    public function __construct(
        HoursRepo $repository,
        HoursRequest $request,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
    }
}
