<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {

        $rules = [
            'title' => 'required|max:255',
            'file_name' => 'required|max:100|unique:company_medias,id|regex:/^\S+$/',
            'description' => 'required|string'
        ];

        if($this->has('edit'))
            $rules['file'] = 'file';
        else
            $rules['file'] = 'required|file';

        return $rules;

    }

    public function messages() {

        return [
            'file.required' => 'The file is required.'
        ];

    }
}
