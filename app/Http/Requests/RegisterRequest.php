<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // $userId = $this->route('id');
        return [
            'name' => 'required|max:255|regex:/^[\pL\s]+$/u',
            'email' => 'nullable|email',
            'phone' => 'required|max:20|regex:/^0\d+$/|unique:users,phone',
            'password' => 'required|min:8|',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống',
            'name.max' => 'Tên nhập quá dài',
            'name.regex' => 'Tên phải là chữ cái',
            'email.email' => 'Email sai định dạng',
            'phone.required' => 'Không được để trống',
            'phone.max' => 'SĐT quá dài',
            'phone.regex' => 'SĐT sai định dạng',
            'phone.unique' => 'SĐT đã tồn tại',
            'password.required' => 'Không được để trống',
            'password.min' => 'Mật khẩu phải chứa ít nhất 9 kí tự',
            'address.required' => 'Không được để trống'
        ];
    }
}
