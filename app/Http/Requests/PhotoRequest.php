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

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }
}
