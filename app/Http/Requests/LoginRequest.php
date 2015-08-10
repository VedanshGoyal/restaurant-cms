<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class LoginRequest extends Request
{
    // @var array
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|max:150',
    ];
}
