<?php

namespace Restaurant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

abstract class Request extends FormRequest
{
    // @var array - allowed request method types
    protected $allowedMethods = ['get', 'put', 'post', 'delete'];

    // @var array - default rule set
    protected $rules = [];

    /**
     * Return the array of rules to validate against
     *
     * @return array
     */
    public function rules()
    {
        $method = Str::lower($this->method());

        if ($this->isMethodAllowed($method) && $this->hasAltRules($method)) {
            return $this->getAltRules($method);
        }

        return $this->rules;
    }

    /**
     * Check if request type string is valid
     *
     * @param string $method
     * @return bool
     */
    protected function isMethodAllowed($method)
    {
        return in_array($method, $this->allowedMethods);
    }

    /**
     * Check if class has alternate rules given a key
     *
     * @param string $key
     * @return bool
     */
    protected function hasAltRules($key)
    {
        return isset($this->altRules) && is_array($this->altRules)
            && array_key_exists($key, $this->altRules);
    }

    /**
     * Return an array of alternate rules merged with the defaults
     *
     * @param string $key
     * @return array
     */
    protected function getAltRules($key)
    {
        return array_merge($this->rules, $this->altRules[$key]);
    }
}
