@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'mt-2 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <div class="flex items-start gap-2 p-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 fade-in">
                <!-- Error Icon -->
                <div class="flex-shrink-0 mt-0.5">
                    <div class="w-5 h-5 rounded-full bg-red-100 dark:bg-red-900/50 flex items-center justify-center">
                        <i class="fa-solid fa-circle-exclamation text-xs text-red-600 dark:text-red-400"></i>
                    </div>
                </div>
                
                <!-- Error Message -->
                <div class="flex-1">
                    <p class="text-sm font-medium text-red-700 dark:text-red-300 leading-relaxed">
                        {{ $message }}
                    </p>
                </div>
                
                <!-- Warning Icon Animation -->
                <div class="flex-shrink-0">
                    <div class="relative">
                        <div class="absolute inset-0 bg-red-500 dark:bg-red-400 rounded-full animate-ping opacity-20"></div>
                        <i class="fa-solid fa-xmark-circle text-base text-red-500 dark:text-red-400 relative"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif