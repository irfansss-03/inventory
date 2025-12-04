@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 glass-card'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open" class="cursor-pointer">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
            class="absolute z-50 mt-3 {{ $width }} {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="glass-card rounded-xl shadow-2xl ring-1 ring-gray-200/50 dark:ring-gray-700/50 border border-gray-200 dark:border-gray-700 overflow-hidden backdrop-blur-xl {{ $contentClasses }}">
            <!-- Dropdown Header Decoration -->
            <div class="h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
            
            <!-- Content -->
            <div class="py-1">
                {{ $content }}
            </div>
            
            <!-- Dropdown Footer Decoration -->
            <div class="h-px bg-gradient-to-r from-transparent via-gray-300 dark:via-gray-600 to-transparent"></div>
        </div>
    </div>
</div>