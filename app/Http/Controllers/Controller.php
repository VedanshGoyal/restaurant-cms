<?php

namespace Restaurant\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs;

    // @var Restaurant\Http\Requests\Request
    protected $request;

    // @var Illuminate\Http\JsonResponse;
    protected $reponse;

    // @var array - relations to query when fetching model data
    protected $with = [];

    // @var array - white-listed input values
    protected $whiteList = [];
}
