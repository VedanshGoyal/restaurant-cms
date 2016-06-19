<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class MenuSectionRequest extends Request
{
    // @var array
    protected $rules = [
        'sort_id' => 'required|integer|between:1,1000',
        'sizes' => 'required|integer|between:0,3',
        'name' => 'required|basicText|between:3,150',
        'info_title' => 'basicText|between:3,200',
        'info' => 'basicText|between:5,2000',
    ];
}
