<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumberValidate;
use Illuminate\Foundation\Http\FormRequest;

class AppealFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', new PhoneNumberValidate],
            'email' => ['nullable', 'email:rfc'],
            'message' => ['required', 'string', 'max:1000'],
        ];
    }
}
