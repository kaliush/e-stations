@props(['href'])

<a href="{{ $href }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
    {{ $slot }}
</a>
