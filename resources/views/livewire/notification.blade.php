<div x-data="{ show: @entangle('show').live, message: @entangle('message').live, type: @entangle('type').live }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-x-full"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform translate-x-full"
    x-init="
        if (message) { show = true; setTimeout(() => show = false, 5000); }
        $watch('show', value => {
            if (value) {
                setTimeout(() => { show = false; }, 5000);
            }
        });
    "
    class="fixed top-4 right-4 z-50 glass-card rounded-xl shadow-2xl text-white min-w-[320px] max-w-md overflow-hidden"
    :class="{
        'bg-gradient-to-r from-green-500 to-green-600 border-2 border-green-400/50': type === 'success',
        'bg-gradient-to-r from-red-500 to-red-600 border-2 border-red-400/50': type === 'error',
        'bg-gradient-to-r from-yellow-500 to-yellow-600 border-2 border-yellow-400/50': type === 'warning',
        'bg-gradient-to-r from-blue-500 to-blue-600 border-2 border-blue-400/50': type === 'info',
    }"
    style="backdrop-filter: blur(20px);">
    
    <!-- Progress Bar -->
    <div class="absolute bottom-0 left-0 h-1 bg-white/30 transition-all duration-5000 ease-linear"
         x-show="show"
         x-transition:enter="transition-all duration-5000 ease-linear"
         x-transition:enter-start="w-full"
         x-transition:enter-end="w-0"
         style="width: 100%;">
    </div>
    
    <div class="p-4">
        <div class="flex items-start gap-3">
            <!-- Icon -->
            <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full bg-white/20 backdrop-blur-sm">
                <template x-if="type === 'success'">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </template>
                <template x-if="type === 'error'">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </template>
                <template x-if="type === 'warning'">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.487 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </template>
                <template x-if="type === 'info'">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </template>
            </div>
            
            <!-- Message Content -->
            <div class="flex-1 pt-0.5">
                <p class="text-sm font-semibold mb-1">
                    <span x-show="type === 'success'">Berhasil!</span>
                    <span x-show="type === 'error'">Error!</span>
                    <span x-show="type === 'warning'">Perhatian!</span>
                    <span x-show="type === 'info'">Informasi</span>
                </p>
                <p class="text-sm text-white/90 leading-relaxed" x-text="message"></p>
            </div>
            
            <!-- Close Button -->
            <button @click="show = false" 
                    class="flex-shrink-0 ml-2 -mr-1 -mt-1 p-1.5 rounded-lg hover:bg-white/20 focus:ring-2 focus:ring-white/50 transition-all">
                <span class="sr-only">Dismiss</span>
                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</div>