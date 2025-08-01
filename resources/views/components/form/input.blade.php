{{-- resources/views/components/form/input.blade.php --}}
@props(['disabled' => false])

<input
    {{ $attributes->merge([
        'class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white 
                    focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
    ]) }}
    @disabled($disabled) />
