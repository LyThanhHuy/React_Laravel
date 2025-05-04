@csrf

{{-- Tên sản phẩm --}}
<x-admin.input name="name" label="Product Name" :value="$product->name ?? ''" />

{{-- Giá sản phẩm --}}
<x-admin.input name="price" type="number" label="Price" :value="$product->price ?? ''" />

{{-- Tồn kho --}}
<x-admin.input name="stock" type="number" label="Stock" :value="$product->stock ?? ''" />

{{-- Sản phầm thuộc user role seller nào --}}
<x-admin.select
    name="user_id"
    label="User"
    :options="$users"
    :selected="$product->user_id ?? null"
/>

{{-- Danh mục sản phẩm (Select Component) --}}
<x-admin.select 
    name="category_id"
    label="Category"
    :options="$categories->pluck('name', 'id')"
    :selected="$product->category_id ?? null"
/>

<button type="submit" class="btn btn-primary">
    {{ isset($product) ? 'Update' : 'Create' }}
</button>
