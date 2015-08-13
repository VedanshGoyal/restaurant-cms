<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Repositories\UsersRepo;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    use RESTTrait;
    
    /**
     * Initialize a new controller instance
     *
     * @param UsersRepo $repository
     * @param JsonReponse $response
     */
    public function __construct(
        UsersRepo $repository,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->response = $response;
    }
}
