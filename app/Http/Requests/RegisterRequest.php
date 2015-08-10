<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;
use Restaurant\Models\SiteConfig;

class RegisterRequest extends Request
{
    // @var array
    protected $rules = [
        'email' => 'required|email|max:250',
        'password' => 'required|basicText|between:6,64|confirmed',
    ];

    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authroize()
    {
        return SiteConfig::find(1)->allowReg;
    }
}
