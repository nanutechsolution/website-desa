@props(['label', 'name', 'value' => '', 'type' => 'text'])

<div class="flex flex-col gap-1">
    <label for="{{ $name }}" class="text-sm text-gray-700 dark:text-gray-300 font-medium">
        {{ $label }}
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
        class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
</div>
