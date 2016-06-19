<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class AboutRequest extends Request
{
    // @var array
    protected $rules = [
        'title' => 'required|between:5,200|basicText',
        'content' => 'required|between:10,1000|basicText',
    ];
}
