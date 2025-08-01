<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    @if ($label ?? false)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    {{ $slot }}

    @if ($error ?? false)
        <p class="text-sm text-red-600 mt-1">
            {{ $error }}
        </p>
    @endif
</div>
