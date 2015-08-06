<?php

namespace Restaurant\Http\Requests;

use Restaurant\Http\Requests\Request;

class SiteConfigRequest extends Request
{
    // @var array
    protected $rules = [
        'allowReg' => 'required|boolean',
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
