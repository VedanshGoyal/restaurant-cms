<?php

namespace Tests\Unit\Requests;

use Restaurant\Http\Requests\Request;

class TestRequest extends Request
{
    protected $rules = ['test' => 'rules'];
}
