<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Tambah Karyawan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden shadow-sm sm:rounded-lg fade-in">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4 glass-card glow-red p-4 rounded-lg bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 border border-red-200 dark:border-red-700/50">
                            <div class="font-medium text-red-600 dark:text-red-400 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Whoops! Ada yang salah.
                            </div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Nama -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="nama" :value="__('Nama')" class="text-gray-900 dark:text-gray-100 font-semibold flex items-center">
                                <i class="fas fa-user mr-2 text-blue-600 dark:text-blue-400"></i>
                                Nama Lengkap
                            </x-input-label>
                            <x-text-input id="nama" class="block mt-1 w-full glass-card border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" type="text" name="nama" :value="old('nama')" required autofocus placeholder="Masukkan nama lengkap" />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <!-- Jabatan -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="jabatan" :value="__('Jabatan')" class="text-gray-900 dark:text-gray-100 font-semibold flex items-center">
                                <i class="fas fa-briefcase mr-2 text-purple-600 dark:text-purple-400"></i>
                                Jabatan
                            </x-input-label>
                            <x-text-input id="jabatan" class="block mt-1 w-full glass-card border-gray-300 dark:border-gray-600 focus:border-purple-500 focus:ring-purple-500 transition-all duration-300" type="text" name="jabatan" :value="old('jabatan')" required placeholder="Contoh: Manager, Staff, Supervisor" />
                            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" class="text-gray-900 dark:text-gray-100 font-semibold flex items-center">
                                <i class="fas fa-birthday-cake mr-2 text-pink-600 dark:text-pink-400"></i>
                                Tanggal Lahir
                            </x-input-label>
                            <x-text-input id="tanggal_lahir" class="block mt-1 w-full glass-card border-gray-300 dark:border-gray-600 focus:border-pink-500 focus:ring-pink-500 transition-all duration-300" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" />
                            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                        </div>

                        <!-- Tanggal Masuk -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="tanggal_masuk" :value="__('Tanggal Masuk')" class="text-gray-900 dark:text-gray-100 font-semibold flex items-center">
                                <i class="fas fa-calendar-check mr-2 text-green-600 dark:text-green-400"></i>
                                Tanggal Masuk
                            </x-input-label>
                            <x-text-input id="tanggal_masuk" class="block mt-1 w-full glass-card border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring-green-500 transition-all duration-300" type="date" name="tanggal_masuk" :value="old('tanggal_masuk')" />
                            <x-input-error :messages="$errors->get('tanggal_masuk')" class="mt-2" />
                        </div>

                        <!-- Foto -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="foto" :value="__('Foto')" class="text-gray-900 dark:text-gray-100 font-semibold flex items-center mb-2">
                                <i class="fas fa-camera mr-2 text-indigo-600 dark:text-indigo-400"></i>
                                Foto Karyawan
                            </x-input-label>
                            <div class="mt-1 flex items-center justify-center w-full">
                                <label for="foto" class="flex flex-col items-center justify-center w-full h-32 glass-card border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-300 hover-lift">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 dark:text-gray-500 mb-3"></i>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG atau JPEG (MAX. 2MB)</p>
                                    </div>
                                    <input id="foto" name="foto" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('karyawan.index') }}" class="inline-flex items-center px-4 py-2 glass-card border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 hover-lift">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Batal') }}
                            </a>

                            <x-primary-button class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-700 hover:to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 hover-lift glow-purple shadow-lg">
                                <i class="fas fa-user-plus mr-2"></i>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>