@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'glass-card rounded-lg p-4 border border-green-200 dark:border-green-700/50 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 shadow-lg fade-in']) }}>
        <div class="flex items-center gap-3">
            <!-- Success Icon -->
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-green-500 dark:bg-green-600 flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Status Message -->
            <div class="flex-1">
                <p class="font-semibold text-sm text-green-900 dark:text-green-100">
                    {{ $status }}
                </p>
                <p class="text-xs text-green-700 dark:text-green-300 mt-0.5">
                    Operasi berhasil dilakukan
                </p>
            </div>
            
            <!-- Success Animation Icon -->
            <div class="flex-shrink-0">
                <div class="relative">
                    <div class="absolute inset-0 bg-green-500 dark:bg-green-400 rounded-full animate-ping opacity-20"></div>
                    <i class="fa-solid fa-check-circle text-2xl text-green-600 dark:text-green-400 relative"></i>
                </div>
            </div>
        </div>
    </div>
@endif