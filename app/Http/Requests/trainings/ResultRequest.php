<?php

namespace App\Http\Requests\trainings;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
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
            'training_id' => 'required',
            'activitie_id' => 'required',
            'weight' => 'numeric|min:0',
            'repeats' => 'required|integer|min:0|max:127',
        ];
    }
}
