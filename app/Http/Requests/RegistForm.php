<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|between:5,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:5',
        ];
    }

    /**
     * выполняется до валидации если в форму нужно добавить какие-то поля
     * @return void
     */
    public function prepareForValidation()
    {

    }
}
