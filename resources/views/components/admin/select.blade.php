@props(['name', 'label', 'options' => [], 'selected' => null, 'required' => false, 'id' => null])

<div class="form-group">
    <label for="{{ $id ?? $name }}">{{ $label }}</label>

    <select name="{{ $name }}" id="{{ $id ?? $name }}"
        {{ $attributes->class(['form-control', 'invalid' => $errors->has($name)]) }}
        @if ($required) required @endif>
        <option value="">-- Select --</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ old($name, $selected) == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>

    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
