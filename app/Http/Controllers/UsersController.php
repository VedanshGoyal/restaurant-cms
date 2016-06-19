<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Repositories\UserRepo;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    use RESTTrait;

    // @var Restaurant\Repositoriess\UserRepo
    protected $repository;

    // @var Illuminate\Http\JsonResponse
    protected $response;
    
    /**
     * Initialize a new controller instance
     *
     * @param Restaurant\Repositories\UserRepo $repository
     * @param Illuminate\Http\JsonReponse $response
     */
    public function __construct(
        UserRepo $repository,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->response = $response;
    }
}
