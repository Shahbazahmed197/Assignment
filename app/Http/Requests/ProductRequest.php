<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $rules= [
            'name' => 'required|string',
            'description' => 'required|string',
             'images' => 'required|array|min:1', // At least one image is required
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
            'categories' => 'required|array|min:1', // At least one category is required
            'categories.*' => Rule::exists('categories', 'id'), // Validate each category
        ];
        if($this->product_id){
            $rules= [
                'name' => 'required|string',
                'description' => 'required|string',
                'images' => 'required|array|min:1',
                'categories' => 'required|array|min:1', // At least one category is required
                'categories.*' => Rule::exists('categories', 'id'), // Validate each category
            ];
        }

        return $rules;
    }
}
