<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\MenuItemRequest;
use Restaurant\Repositories\MenuItemRepo;
use Illuminate\Http\JsonResponse;

class MenuItemsController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\MenuItemRepo
    protected $repository;

    // @var Restaurant\Http\MenuItemRequest
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $reponse;

    // @var array - white-listed input values
    protected $whiteList = ['name', 'sortId', 'section_id', 'items', 'description', 'priceOne', 'priceTwo'];

    public function __construct(
        MenuItemRepo $repository,
        MenuItemRequest $request,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
    }
}
