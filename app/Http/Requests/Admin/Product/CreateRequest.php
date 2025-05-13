<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:products,slug',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'user_id'     => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'The product name is required.',
            'name.max'             => 'The product name must not exceed 255 characters.',
            'slug.unique'          => 'The slug has already been taken. Please choose another one.',
            'slug.max'             => 'The slug must not exceed 255 characters.',
            'price.required'       => 'The product price is required.',
            'price.numeric'        => 'The price must be a number.',
            'price.min'            => 'The price must be at least 0.',
            'stock.required'       => 'The stock quantity is required.',
            'stock.integer'        => 'Stock must be an integer.',
            'stock.min'            => 'Stock must be at least 0.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists'   => 'The selected category does not exist.',
            'user_id.required'     => 'Please select a user.',
            'user_id.exists'       => 'The selected user does not exist.'
        ];
    }
}
