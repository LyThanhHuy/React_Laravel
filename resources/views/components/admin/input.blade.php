{{-- resources/views/components/admin/input.blade.php --}}

@props(['name', 'label', 'type' => 'text', 'value' => '', 'id' => null])

<div class="form-group">
    <label for="{{ $id ?? $name }}">{{ $label }}</label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
    >

    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>