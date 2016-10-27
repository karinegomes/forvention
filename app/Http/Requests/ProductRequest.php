<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {

        $rules = [
            'sku' => 'required|max:255|numeric|unique:products,sku',
            'title' => 'required|max:255',
            'description' => 'required',
            'tags' => 'required'
        ];

        if($this->has('edit')) {
            $rules['image'] = 'image';
            $rules['sku'] = $rules['sku'] . ',' . $this['product_id'];
        }
        else
            $rules['image'] = 'required|image';

        return $rules;

    }

    public function attributes() {

        return [
            'sku' => 'SKU'
        ];

    }

    public function messages() {

        return [
            'tags.required' => 'At least one tag must be provided.',
            'image.required' => 'The image is required.',
            'image.image' => 'The image is invalid.'
        ];

    }
}
