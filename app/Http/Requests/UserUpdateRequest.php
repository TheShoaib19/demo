<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required', 
            'age' => 'required|numeric',
            'password' => 'required',
            'phone' => 'required'
        ];
    }
    public function messages()
    {
        return[
            'first_name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'age.required' => 'Age is required.',
            'age.numeric' => 'Age must be a number.',
            'password.required' => 'Password is required.',
            'phone.required' => 'Phone is required.'
        ];
    }
}
