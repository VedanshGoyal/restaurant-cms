<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class ResetPasswordRequest extends Request
{
    // @var array
    protected $rules = [
        'email' => 'required|email|max:500',
    ];
}
