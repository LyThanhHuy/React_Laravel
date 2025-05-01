<?php

namespace App\Http\Requests\Admin\Category;

use App\Models\Category;
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
        $id = $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($id),
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $id = $this->route('id'); // ID đang chỉnh sửa
            $slug = \Str::slug($this->input('slug'));
            $name = trim($this->input('name'));

            // Kiểm tra trùng slug
            $slugExists = Category::where('slug', $slug)
                ->where('id', '<>', $id)
                ->exists();

            if ($slugExists) {
                $validator->errors()->add('slug', 'The slug has already been taken.');
            }

            // Kiểm tra trùng name
            $nameExists = Category::where('name', $name)
                ->where('id', '<>', $id)
                ->exists();

            if ($nameExists) {
                $validator->errors()->add('name', 'The category name has already been taken.');
            }
        });
    }

    public function messages()
    {
        return [
            'name.required' => 'The category name is required.',
            'name.max' => 'The category name must not exceed 255 characters.',
            // 'name.unique' => 'The category name has already been taken.',
            'slug.required' => 'The slug is required.',
            'slug.max' => 'The slug must not exceed 255 characters.',
            // 'slug.unique' => 'The slug has already been taken.',
        ];
    }
}
