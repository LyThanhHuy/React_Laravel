<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

// use Illuminate\Database\Eloquent\Collection;

class CategoryService extends BaseService
{
    /**
     * Lấy danh sách tất cả danh mục
     */
    public function getAll($perPage = 10)
    {
        return Category::orderByDesc('created_at')->paginate($perPage);
    }

    /**
     * Tạo mới danh mục trong transaction
     */
    public function create(array $data): Category
    {
        DB::beginTransaction();

        try {
            // $slug = Str::slug($data['slug']);

            // Check trùng name
            // if (Category::where('name', $data['name'])->exists()) {
            //     throw ValidationException::withMessages([
            //         'name' => 'The category name already exists. Please choose another one.',
            //     ]);
            // }

            // Check trùng slug
            // if (Category::where('slug', $slug)->exists()) {
            //     throw ValidationException::withMessages([
            //         'slug' => 'The slug already exists. Please choose another one.',
            //     ]);
            // }

            $category = Category::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['slug']),
            ]);

            DB::commit();
            return $category;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Category $category, array $data): Category
    {
        DB::beginTransaction();

        try {
            $slug = Str::slug($data['slug']);

            // Kiểm tra trùng name (ngoại trừ chính mình)
            // if (Category::where('name', $data['name'])->where('id', '<>', $category->id)->exists()) {
            //     throw ValidationException::withMessages([
            //         'name' => 'The category name already exists. Please choose another one.',
            //     ]);
            // }

            // Kiểm tra trùng slug (ngoại trừ chính mình)
            // if (Category::where('slug', $slug)->where('id', '<>', $category->id)->exists()) {
            //     throw ValidationException::withMessages([
            //         'slug' => 'The slug already exists. Please choose another one.',
            //     ]);
            // }

            // Cập nhật
            $category->update([
                'name' => $data['name'],
                'slug' => $slug,
            ]);

            DB::commit();
            return $category;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Xóa danh mục
     */
    public function delete(Category $category): bool
    {
        // DB::beginTransaction();
        try {
            return $category->delete();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Tìm danh mục theo ID
     */
    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * Tìm danh mục theo slug
     */
    public function findBySlug(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
    }

    /**
     * Kiểm tra trùng tên danh mục
     */
    public function isDuplicateName(string $name, ?int $excludeId = null): bool
    {
        $query = Category::where('name', $name);
        if ($excludeId) {
            $query->where('id', '<>', $excludeId);
        }
        return $query->exists();
    }
}
