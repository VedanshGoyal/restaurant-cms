<?php

namespace Restaurant\Http\Requests;

class MenuItemRequest extends Request
{
    // @var rules
    protected $rules = [
        'sort_id' => 'required|integer',
        'price_one' => 'required|numeric',
        'price_two' => 'numeric',
        'name' => 'required|between:2,200|basicText',
        'description' => 'basicText|between:3,500',
    ];
}
