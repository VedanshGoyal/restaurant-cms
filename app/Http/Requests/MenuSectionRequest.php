<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class MenuSectionRequest extends Request
{
    // @var array
    protected $rules = [
        'sortId' => 'required|integer|beteween:1,1000',
        'itemPrices' => 'required|integer|between:1,2',
        'name' => 'required|basicText|between:3,150',
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
