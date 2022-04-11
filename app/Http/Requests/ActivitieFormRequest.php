<?php

namespace App\Http\Requests;

use App\Models\Activitie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActivitieFormRequest extends FormRequest
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
            'name' => 'required|string|between:5,100',
            'description' => 'string|nullable',
            'body_part' => [Rule::in(array_column(Activitie::$body_parts, 'id')), 'nullable'],
        ];
    }
}
