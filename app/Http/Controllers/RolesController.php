<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Repositories\RoleRepo;
use Illuminate\Http\JsonResponse;

class RolesController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositories\RolesRepo
    protected $repository;
    
    // @var Illuminate\Http\JsonResponse;
    protected $reponse;

    public function __construct(
        RoleRepo $repository,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->response = $response;
    }
}
