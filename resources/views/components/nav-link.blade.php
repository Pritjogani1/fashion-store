@props(['active' => false])
<a class="{{ $active ? 'bg-white text-black': 'text-gray-300 hover:bg-white hover:text-black' }} rounded-md px-3 py-2 text-sm font-medium"
aria-current="{{ $active ? 'page': 'false' }}"
{{ $attributes }}
>{{ $slot }}</a> 