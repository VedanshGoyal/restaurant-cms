<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class PhotoRequest extends Request
{
    // @var array
    protected $rules = [
        'image' => 'required|image|max:10000',
        'name' => 'basicText|between:2,200',
    ];
}
