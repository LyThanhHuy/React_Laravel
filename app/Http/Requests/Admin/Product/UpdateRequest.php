<?php

namespace App\Http\Requests\Admin\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $id = optional($this->route('product'))->id;
        return [
            'name'        => 'required|string|max:255',
            'slug'        => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($id),],
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'user_id'     => 'required|exists:users,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $id = optional($this->route('product'))->id; // ID đang chỉnh sửa
            $slug = \Str::slug($this->input('slug'));

            // Kiểm tra trùng slug
            $slugExists = Product::where('slug', $slug)
                ->where('id', '<>', $id)
                ->exists();

            if ($slugExists) {
                $validator->errors()->add('slug', 'The slug has already been taken.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'The product name is required.',
            'price.required'       => 'The product price is required.',
            'stock.required'       => 'The stock quantity is required.',
            'category_id.required' => 'The category is required.',
            'user_id.required'     => 'Please assign a user to the product.',
            'user_id.exists'       => 'Selected user does not exist.',
        ];
    }
}
