<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Response;

class CatalogFormRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search_query' => ['nullable'],
            'sort_mode' => ['nullable', Rule::in(['price_asc', 'price_desc'])],
            'filters' => ['nullable', 'array'],
            'filters.*' => ['required', 'array'],
        ];
    }

}