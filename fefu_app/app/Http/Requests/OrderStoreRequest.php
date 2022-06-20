<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_email' => ['required', 'email:rfc'],
            'customer_name' => ['required', 'min:3', 'max:255'],
            'delivery_type' => ['required', Rule::in(['courier', 'pickup'])],
            'payment_method' => ['required', Rule::in(['cash', 'card'])],
            'delivery_address.city' => ['required_if:delivery_type,courier'],
            'delivery_address.street' => ['required_if:delivery_type,courier'],
            'delivery_address.house' => ['required_if:delivery_type,courier'],
            'delivery_address.apartment' => ['integer', 'nullable'],
        ];
    }
}