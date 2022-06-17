<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Response;
use Validator;

class CatalogApiRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_slug' => ['nullable'],
            'search_query' => ['nullable'],
            'sort_mode' => ['nullable', Rule::in(['price_asc', 'price_desc'])],
            'filters' => ['nullable', 'array'],
            'filters.*' => ['required', 'array'],
        ];
    }
}