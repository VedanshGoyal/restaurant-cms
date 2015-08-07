<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class HourRequest extends Request
{
    // @var array
    protected $rules = [
        'day' => 'required|between:2,10|alpha',
        'open' => 'required|size:8|basicText',
        'close' => 'required|size:8|basicText',
        'isClosed' => 'required|boolean',
    ];
}
