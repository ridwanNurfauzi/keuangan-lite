@props(['msg', 'color'])

@php
    switch ($color) {
        case 'blue':
            $mainClasses = 'flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-100';
            $btnClasses =
                'ms-auto -mx-1.5 -my-1.5 bg-blue-100 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8';
            break;

        case 'red':
            $mainClasses = 'flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-400 bg-red-200';
            $btnClasses =
                'ms-auto -mx-1.5 -my-1.5 bg-red-200 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8';
            break;

        case 'green':
            $mainClasses = 'flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-400 bg-green-200';
            $btnClasses =
                'ms-auto -mx-1.5 -my-1.5 bg-green-200 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8';
            break;

        default:
            $mainClasses = 'flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-100';
            $btnClasses =
                'ms-auto -mx-1.5 -my-1.5 bg-blue-100 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8';
            break;
    }
@endphp

<div id="alert-border-1" class="{{ $mainClasses }}"
    role="alert">
    <div class="ms-3 text-sm font-medium">
        {{ $msg }}
    </div>
    <button type="button"
        class="{{ $btnClasses }}"
        data-dismiss-target="#alert-border-1" aria-label="Close">
        <span class="sr-only">Dismiss</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>
