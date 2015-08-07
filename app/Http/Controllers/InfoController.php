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

    // @var array - white-listed input vcalues
    protected $whiteList = ['title', 'content'];

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
