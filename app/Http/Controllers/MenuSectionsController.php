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
    protected $reponse;

    // @var array - relations to query when fetching model data
    protected $with = ['items'];

    // @var array - white-listed input vcalues
    protected $whiteList = ['name', 'sortId', 'itemPrices'];

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
