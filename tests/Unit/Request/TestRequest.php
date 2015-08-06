<?php

namespace Tests\Unit\Requests;

use Restaurant\Http\Requests\Request;

class TestRequest extends Request
{
    protected $rules = [
        'test' => 'rules',
    ];

    protected $altRules = [
        'get' => ['get' => 'rules'],
        'put' => ['put' => 'rules'],
        'post' => ['post' => 'rules'],
        'delete' => ['delete' => 'rules'],
    ];
}
