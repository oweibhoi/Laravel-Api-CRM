<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateCustomerRequest extends FormRequest
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
        if($this->method() === 'PUT')
        {
            return [
                'name' => ['required'],
                'type' => ['required', Rule::in(['I', 'i', 'B', 'b'])],
                'email' => ['required'],
                'address' => ['required'],
                'state' => ['required'],
                'postalCode' => ['required'],
                'phone' => ['required'],
            ];
        }
        else
        {
            return [
                'name' => ['sometimes', 'required', 'unique:customers'],
                'type' => ['sometimes', 'required', Rule::in(['I', 'i', 'B', 'b'])],
                'email' => ['sometimes', 'required', 'unique:customers'],
                'address' => ['sometimes', 'required'],
                'state' => ['sometimes', 'required'],
                'postalCode' => ['sometimes', 'required'],
                'phone' => ['sometimes', 'required'],
            ];
        }
        
    }

    protected function prepareForValidation()
    {
        if($this->postalCode)
        {
            $this->merge([
                'postal_code' => $this->postalCode
            ]);
        }
    }
}
