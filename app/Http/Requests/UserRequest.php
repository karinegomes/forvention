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
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'confirmed',
            'password_confirmation' => 'same:password'
        ];

        if(!$this->has('edit')) {
            $rules['password'] = $rules['password'] . '|required';
            $rules['password_confirmation'] = 'required';
        }

        return $rules;

    }
}
