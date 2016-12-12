<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'txtUserName' => 'required|max:255|unique:users,username',
            'txtEmail' => 'required|email|max:255|unique:users,email',
            'txtPass' => 'required|min:6|confirmed',
        ];
    }

    public function messages(){
        return [
        'txtUserName.required'=>'UserName khong duoc bo trong',
        'txtUserName.unique' => 'UserName khong duoc trung',
        'txtEmail.required' => 'Email khong duoc bo trong',
        'txtEmail.email' => 'Email khong dung dinh dang',
        'txtEmail.unique' => 'Email khong duoc trung',
        'txtPass.required' => 'Password khong duoc trong',
        'txtPass.confirmed' => 'Password khong giong nhau',
        ];
    }
}
