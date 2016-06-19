<?php

namespace Restaurant\Http\Requests;

class VerifyResetRequest extends Request
{
    // @var array
    protected $rules = [
        'verify_token' => 'required|alpha_num',
        'password' => 'required|password|confirmed',
    ];
}
