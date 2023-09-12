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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255', 
            'age' => 'required|numeric',
            'password' => 'nullable|min:4|max:255',
            'confirm_password' => 'nullable|min:4|max:255|same:password',
            'phone' => 'required|max:11'
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
