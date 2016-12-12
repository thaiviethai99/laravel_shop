<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'txtName' => 'required|unique:products,name',
            'txtPrice' => 'required',
            'txtIntro' => 'required',
            'txtContent' => 'required'
        ];
    }

    public function messages(){
        return [
        'txtName.required'=>'Ten khong duoc bo trong',
        'txtName.unique' => 'Ten khong duoc trung',
        'txtPrice.required'=>'Gia khong duoc bo trong',
        'txtIntro.required'=>'Intro khong duoc bo trong',
        'txtContent.required'=>'Content khong duoc bo trong',
        ];
    }
}
