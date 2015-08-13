<?php

namespace Restaurant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

abstract class Request extends FormRequest
{
    // @var array - default rule set
    protected $rules = [];

    // @var array - methods that require input validation
    protected $validateMethods = ['post', 'put'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Return the array of rules to validate against
     *
     * @return array
     */
    public function rules()
    {
        $method = Str::lower($this->method());

        if ($this->shouldValidate($method)) {
            return ($this->hasAltRules($method)) ? $this->getAltRuels($method) : $this->rules;
        }

        return [];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }

    /**
     * Check if method is one that does not require validation
     *
     * @param string $method
     * @return bool
     */
    protected function shouldValidate($method)
    {
        return in_array($method, $this->validateMethods);
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
