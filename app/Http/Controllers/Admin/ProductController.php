<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = $this->service->getAllWithCategory();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::where('role', 'seller')->pluck('name', 'id');
        return view('admin.products.create', compact('categories', 'users'));
    }

    public function store(CreateRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function edit(Product $product)
    {
        // dd($product);
        $categories = Category::all();
        $users = \App\Models\User::where('role', 'seller')->pluck('name', 'id');

        return view('admin.products.edit', compact('product', 'categories', 'users'));
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $updated = $this->service->update($product, $request->validated());

        if (! $updated) {
            return back()->with('error', 'Failed to update product.');
        }

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $deleted = $this->service->delete($product);

        if (! $deleted) {
            return back()->with('error', 'Failed to delete product.');
        }

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}
