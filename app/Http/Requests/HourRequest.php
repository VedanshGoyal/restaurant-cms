<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class HourRequest extends Request
{
    // @var array
    protected $rules = [
        'day' => 'required|between:2,10|alpha',
        'open' => 'required|between:2,10|basicText',
        'close' => 'required|between:2,10|basicText',
        'isClosed' => 'required|boolean',
    ];
}
