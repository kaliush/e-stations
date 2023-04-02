@props(['options'])

<label class="block font-medium text-sm text-gray-700" for="{{ $attributes->get('id') }}">
    {{ $slot }}
</label>
<select {{ $attributes->merge(['class' => 'form-select mt-1 block w-full']) }}>
    @foreach($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
@error($attributes->get('name'))
<p class="text-sm text-red-600">{{ $message }}</p>
@enderror
