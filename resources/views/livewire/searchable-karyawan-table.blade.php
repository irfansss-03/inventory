<div>
    <div class="glass-card rounded-xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700 hover-lift">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-user-circle text-blue-600 dark:text-blue-400"></i>
                                Foto
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-id-badge text-green-600 dark:text-green-400"></i>
                                Nama
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-briefcase text-purple-600 dark:text-purple-400"></i>
                                Jabatan
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-cake-candles text-orange-600 dark:text-orange-400"></i>
                                Umur
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-calendar-check text-teal-600 dark:text-teal-400"></i>
                                Tgl Masuk
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <i class="fa-solid fa-cog"></i>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($karyawans as $karyawan)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-all duration-200">
                            <!-- Foto -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($karyawan->foto)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $karyawan->foto) }}" 
                                             alt="{{ $karyawan->nama }}" 
                                             class="w-16 h-16 object-cover rounded-full shadow-md border-3 border-white dark:border-gray-600 group-hover:scale-110 transition-transform duration-300 ring-2 ring-blue-500/50">
                                        <div class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <i class="fa-solid fa-search-plus text-white text-xl"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-blue-500 dark:to-blue-700 flex items-center justify-center shadow-md ring-2 ring-blue-500/50">
                                        <i class="fa-solid fa-user text-white text-2xl"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Nama -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                    {{ $karyawan->nama }}
                                </div>
                            </td>

                            <!-- Jabatan -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300 border border-purple-200 dark:border-purple-700">
                                    <i class="fa-solid fa-star text-yellow-500 text-xs"></i>
                                    {{ $karyawan->jabatan }}
                                </span>
                            </td>

                            <!-- Umur -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                    @if($karyawan->umur)
                                        <div class="inline-flex items-center gap-1">
                                            <span>{{ $karyawan->umur }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">tahun</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500 text-xs">-</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Tanggal Masuk -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                    @if($karyawan->tanggal_masuk)
                                        <div class="inline-flex items-center gap-2 px-2.5 py-1 bg-teal-50 dark:bg-teal-900/30 rounded-lg border border-teal-200 dark:border-teal-700">
                                            <i class="fa-solid fa-calendar text-teal-600 dark:text-teal-400 text-xs"></i>
                                            <span class="font-semibold text-xs text-teal-900 dark:text-teal-200">
                                                {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d M Y') }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500 text-xs">-</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('karyawan.edit', $karyawan) }}" 
                                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white text-xs font-semibold rounded-lg transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                        <i class="fa-solid fa-edit"></i>
                                        Edit
                                    </a>
                                    @if (auth()->user()->isAdmin())
                                        <form action="{{ route('karyawan.destroy', $karyawan) }}" 
                                              method="POST" 
                                              class="inline-block" 
                                              onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus karyawan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                                <i class="fa-solid fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
                                        <i class="fa-solid fa-users-slash text-3xl text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">
                                        Tidak ada data karyawan
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Tidak ada karyawan yang cocok dengan pencarian Anda
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($karyawans->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                {{ $karyawans->links() }}
            </div>
        @endif
    </div>
</div>