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
    protected $reponse;

    // @var array - white-listed input vcalues
    protected $whiteList = ['title', 'content'];

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
