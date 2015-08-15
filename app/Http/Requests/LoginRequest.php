<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class LoginRequest extends Request
{
    // @var array
    protected $rules = [
        'email' => 'required|email|max:500',
        'password' => 'required|max:150',
    ];
}
