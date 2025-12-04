<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Karyawan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">Whoops! Ada yang salah.</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data">
                        @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <!-- Jabatan -->
                    <div class="mt-4">
                        <x-input-label for="jabatan" :value="__('Jabatan')" />
                        <x-text-input id="jabatan" class="block mt-1 w-full" type="text" name="jabatan" :value="old('jabatan')" required />
                        <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mt-4">
                        <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                        <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" />
                        <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="mt-4">
                        <x-input-label for="tanggal_masuk" :value="__('Tanggal Masuk')" />
                        <x-text-input id="tanggal_masuk" class="block mt-1 w-full" type="date" name="tanggal_masuk" :value="old('tanggal_masuk')" />
                        <x-input-error :messages="$errors->get('tanggal_masuk')" class="mt-2" />
                    </div>

                    <!-- Foto -->
                    <div class="mt-4">
                        <x-input-label for="foto" :value="__('Foto')" />
                        <input id="foto" class="block mt-1 w-full" type="file" name="foto">
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('karyawan.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                Batal
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
