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
    class="fixed top-4 right-4 z-50 p-4 rounded-md shadow-lg text-white"
    :class="{
        'bg-green-500': type === 'success',
        'bg-red-500': type === 'error',
        'bg-yellow-500': type === 'warning',
        'bg-blue-500': type === 'info',
    }">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <template x-if="type === 'success'">
                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </template>
            <template x-if="type === 'error'">
                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </template>
            <template x-if="type === 'warning'">
                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.487 0L14.813 8.5c.765 1.36-.217 3-1.743 3H6.93c-1.526 0-2.508-1.64-1.743-3L8.257 3.099zM10 13a1 1 0 100 2 1 1 0 000-2zm0-4a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </template>
            <template x-if="type === 'info'">
                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </template>
        </div>
        <div class="ml-3 text-sm font-medium" x-text="message"></div>
        <button @click="show = false" class="ml-auto -mx-1.5 -my-1.5 bg-transparent text-white rounded-lg focus:ring-2 focus:ring-white p-1.5 inline-flex items-center justify-center h-8 w-8">
            <span class="sr-only">Dismiss</span>
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
