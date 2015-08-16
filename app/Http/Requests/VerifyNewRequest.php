<?php

namespace Restaurant\Http\Requests;

class VerifyNewRequest extends Request
{
    // @var array
    protected $rules = [
        'token' => 'required|alpha_num',
        'email' => 'required|email|max:500',
        'password' => 'required|password',
    ];
}
