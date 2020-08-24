<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userUpdateRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required | regex:/^.+@.+$/i',
            'role_id'=>'required',
            'type'=>'required',
        ];
    }
    public function messages(){
        return[
            'email.required'=>'please provide your email address'
        ];
    }
}
