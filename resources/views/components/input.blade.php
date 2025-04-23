<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->

    @props([
        'type' => 'text',
        'name',
        'label' => null,
        'value' => '',
        'placeholder' => '',
    ])

    <div class="mb-4">
        @if ($label)
            <label for="{{ $name }}" class="block mb-1 font-medium text-sm text-gray-700">
                {{ $label }}
            </label>
        @endif

        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
            {{ $attributes }}
            {{-- {{ $attributes->merge(['class' => 'border border-gray-300 rounded-md shadow-sm w-full p-2']) }} --}}
        >

        @error($name)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
