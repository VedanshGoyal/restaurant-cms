<?php

namespace Restaurant\Http\Requests;

class VerifyNewRequest extends Request
{
    // @var array
    protected $rules = [
        'token' => 'required|basicText',
        'email' => 'required|email|max:500',
        'password' => 'required|basicText|max:64',
    ];
}
