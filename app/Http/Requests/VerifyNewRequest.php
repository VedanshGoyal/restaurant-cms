<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class VerifyNewRequest extends Request
{
    // @var array
    protected $rules = [
        'token' => 'required|basicText',
        'email' => 'required|email|max:500',
        'password' => 'required|basicText|max:64',
    ];
}
