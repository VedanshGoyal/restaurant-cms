<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class MenuItemRequest extends Request
{
    // @var rules
    protected $rules = [
        'sortId' => 'required|integer|between:1,1000',
        'priceOne' => 'required|integer|between:1,100',
        'priceTwo' => 'integer|between:1,100',
        'name' => 'required|between:2,200|basicText',
        'tags' => 'required|tags',
        'description' => 'basicText|between:3,500',
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
