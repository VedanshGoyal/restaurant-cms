<?php

namespace Restaurant\Http\Requests;

class MenuItemRequest extends Request
{
    // @var rules
    protected $rules = [
        'sortId' => 'required|integer',
        'priceOne' => 'required|numeric',
        'priceTwo' => 'numeric',
        'name' => 'required|between:2,200|basicText',
        'description' => 'basicText|between:3,500',
    ];
}
