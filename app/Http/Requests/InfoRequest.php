<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class InfoRequest extends Request
{
    // @var array
    protected $rules = [
        'name' => 'required|between:2,200|basicText',
        'street' => 'required|between:5,300|basicText',
        'city' => 'required|between:2,100|basicText',
        'state' => 'required|between:2,100|basicText',
        'phoneOne' => 'required|betweewn:7,50|basicText',
        'phoneTwo' => 'betweewn:7,50|basicText',
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
