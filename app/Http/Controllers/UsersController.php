<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Repositories\UserRepo;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    use RESTTrait;
    
    /**
     * Initialize a new controller instance
     *
     * @param UserRepo $repository
     * @param JsonReponse $response
     */
    public function __construct(
        UserRepo $repository,
        JsonResponse $response
    ) {
        $this->repository = $repository;
        $this->response = $response;
    }
}
