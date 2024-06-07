@props(['active', 'href'])

<li>
    <a href="{{ $href }}"
        class="{{ $active ? 'flex items-center p-2 text-gray-900 rounded-lg bg-gray-200 hover:bg-gray-200 group' : 'flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group' }}">
        {{ $slot }}
    </a>
</li>
    