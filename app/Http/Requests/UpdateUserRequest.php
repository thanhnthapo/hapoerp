<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->user,
            'address'   => 'required',
            'phone'   => 'required|unique:users,phone,'.$this->user,
            'password'   => 'required|min:6'
        ];
    }
    public function messages(){
        return[
            'name.required' => 'Trường không đươc bỏ trống',
            'name.max' => 'Không được nhập quá 255 ký tự',
            'email.required' => 'Trường không đươc bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'dob.required' => 'Trường không đươc bỏ trống',
            'address.required' => 'Trường không đươc bỏ trống',
            'phone.required' => 'Trường không đươc bỏ trống',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Trường không đươc bỏ trống',
            'password.min' => 'Mật khẩu chứa ít nhất 6 ký tự'
        ];
    }
}
