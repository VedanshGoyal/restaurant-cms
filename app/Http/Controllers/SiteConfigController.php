<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Repositories\SiteConfigRepo;
use Restaurant\Http\Requests\SiteCongiRequest;
use Illuminate\Http\JsonResponse;

class SiteConfigController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\SiteConfigRepo
    protected $repository;

    // @var Restaurant\Http\SiteConfigRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $reponse;

    // @var array - white-listed input values
    protected $whiteList = ['allowReg'];

    public function __construct(
        SiteConfigRepo $repository,
        SiteConfigRequest $request,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
    }
}
