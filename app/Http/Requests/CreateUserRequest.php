<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;


class CreateUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'avatar' => 'required|mimes:jpg,png,jpeg',
            'dob' => 'required|date',
            'address'   => 'required',
            'phone'   => 'required|numeric|unique:users',
            'password'   => 'required|min:6'
        ];
    }
}
