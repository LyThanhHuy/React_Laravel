{{-- resources/views/admin/categories/form.blade.php --}}

@csrf

<x-admin.input
    name="name"
    label="Category Name"
    :value="$category->name ?? ''"
    {{-- required --}}
/>

<x-admin.input
    name="slug"
    label="Slug (URL)"
    :value="$category->slug ?? ''"
/>

<button type="submit" class="btn btn-primary">
    {{ isset($category) ? 'Update' : 'Create' }}
</button>