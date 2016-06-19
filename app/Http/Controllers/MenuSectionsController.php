<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\MenuSectionRequest;
use Restaurant\Repositories\MenuSectionRepo;
use Illuminate\Http\JsonResponse;

class MenuSectionsController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\MenuSectionRepo
    protected $repository;

    // @var Restaurant\Http\MenuSectionRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $response;

    // @var array - relations to query when fetching model data
    protected $with = ['items'];

    // @var array - white-listed input values
    protected $whiteList = ['name', 'sortId', 'sizes', 'infoTitle', 'info'];

    /**
     * @param Restaurant\Repositories\MenuSectionRepo $repository
     * @param Restaurant\Http\Requests\MenuSectionRequest $request
     * @param Illuminate\Http\JsonResponse $response
     */
    public function __construct(
        MenuSectionRepo $repository,
        MenuSectionRequest $request,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
    }
}
