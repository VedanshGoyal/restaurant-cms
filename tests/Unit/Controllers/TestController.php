<?php

namespace Tests\Unit\Controllers;

use Restaurant\Http\Controllers\RESTTrait;

class TestController
{
    use RESTTrait;

    protected $whiteList = ['white' => 'list'];

    protected $with = ['values'];

    public function __construct($repository, $request, $response)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->response = $response;
    }
}
