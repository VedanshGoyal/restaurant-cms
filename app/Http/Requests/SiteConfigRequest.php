<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class SiteConfigRequest extends Request
{
    // @var array
    protected $rules = [
        'allowReg' => 'required|boolean',
    ];
}
