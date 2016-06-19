<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Repositories\SiteConfigRepo;
use Restaurant\Http\Requests\SiteConfigRequest;
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

    /**
     * Initialize new instance
     *
     * @param Restaurant\Repositories\SiteConfigRepo $repository
     * @param Restaurant\Http\Requests\SiteConfigRequest $request
     * @param Illuminate\Http\JsonRepsone $response
     */
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
