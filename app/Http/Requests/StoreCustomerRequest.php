<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['required', 'unique:customers'],
            'type' => ['required', Rule::in(['I', 'i', 'B', 'b'])],
            'email' => ['required', 'unique:customers', 'email:rfc'],
            'address' => ['required'],
            'state' => ['required'],
            'postalCode' => ['required'],
            'phone' => ['required'],
            'status' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'postal_code' => $this->postalCode
        ]);
    }
}
