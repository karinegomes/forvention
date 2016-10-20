<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Verify if the user has permission to do so

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $rules = [
            'name' => 'required|max:255',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip_code' => 'required',
            'phone1' => 'required',
            'phone2' => '',
            'fax' => '',
            'email' => 'required|email'
        ];

        if($this->has('edit')) {
            $rules['logo'] = 'image';
        }
        else {
            $rules['logo'] = 'required|image';
        }

        return $rules;

    }

}
