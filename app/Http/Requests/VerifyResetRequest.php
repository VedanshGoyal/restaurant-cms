<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class VerifyResetRequest extends Request
{
    // @var array
    protected $rules = [
        'token' => 'required|basicText',
        'password' => 'required|basicText|max:200|confirmed',
    ];
}
