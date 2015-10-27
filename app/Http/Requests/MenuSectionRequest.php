<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class MenuSectionRequest extends Request
{
    // @var array
    protected $rules = [
        'sortId' => 'required|integer|between:1,1000',
        'sizes' => 'required|integer|between:0,3',
        'name' => 'required|basicText|between:3,150',
        'infoTitle' => 'basicText|between:3,200',
        'info' => 'basicText|between:5,2000',
    ];
}
