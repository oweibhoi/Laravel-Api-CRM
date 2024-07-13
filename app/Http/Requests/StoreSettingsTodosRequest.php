<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSettingsTodosRequest extends FormRequest
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
        if(in_array($this->method(), ["PUT", "PATCH"])) {
            return [
                'name' => ['required'],
                'type' => ['required', Rule::in(['P', 'p', 'C', 'c'])],
            ];
        } else {
            return [
                'name' => ['required', 'unique:settings_todos'],
                'type' => ['required', Rule::in(['P', 'p', 'C', 'c'])],
            ];
        }
    }
}
