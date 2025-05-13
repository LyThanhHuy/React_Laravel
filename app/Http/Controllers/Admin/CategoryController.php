<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        // Chặn nếu chưa đăng nhập admin
        $this->middleware('auth:admin');
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAll();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo mới danh mục
     */
    public function create(): View
    {
        return view('admin.category.create');
    }

    public function store(CreateRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.categories')
            ->with('success', 'Category created successfully.');
    }

    public function edit(int $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateRequest $request, int $id)
    {
        $category = Category::findOrFail($id);

        $this->service->update($category, $request->validated());

        return redirect()->route('admin.categories')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(int $id) {
        $category = Category::findOrFail($id);
        $deleted = $this->service->delete($category);

        if (! $deleted) {
            return back()->with('error', 'Failed to delete category.');
        }

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }
}
