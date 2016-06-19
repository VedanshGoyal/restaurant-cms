<?php

namespace Restaurant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

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
        return in_array(strtolower($this->method()), $this->validateMethods) ? $this->rules : [];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return new JsonResponse([
            'meta' => [
                'ok' => false,
                'message' => 'Input provided was not valid',
                'errors' => $errors,
            ],
            'data' => [],
        ], 422);
    }

    /**
     * Get the proper response for a unauthorized request
     *
     * @return JsonResponse
     */
    public function forbiddenResponse()
    {
        return new JsonResponse([
            'meta' => [
                'ok' => false,
                'message' => 'Requested acccess not allowed',
            ],
            'data' => [],
        ], 403);
    }
}
