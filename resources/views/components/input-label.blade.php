@props(['value'])

<label {{ $attributes->merge(['class' => 'flex items-center gap-2 font-bold text-sm text-gray-800 dark:text-gray-200 mb-1.5 tracking-wide']) }}>
    <!-- Optional Icon (if you want to add icon support) -->
    @if($attributes->has('icon'))
        <span class="flex-shrink-0 w-5 h-5 rounded-md bg-gradient-to-br from-blue-500 to-purple-500 dark:from-blue-600 dark:to-purple-600 flex items-center justify-center shadow-sm">
            <i class="{{ $attributes->get('icon') }} text-white text-xs"></i>
        </span>
    @endif
    
    <!-- Label Text -->
    <span class="flex-1">
        {{ $value ?? $slot }}
    </span>
    
    <!-- Required Indicator -->
    @if($attributes->has('required'))
        <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-500 dark:bg-red-400 animate-pulse" title="Required field"></span>
    @endif
</label>