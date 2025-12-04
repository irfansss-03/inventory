<div>
    <div class="glass-card rounded-xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700 hover-lift">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-image text-blue-600 dark:text-blue-400"></i>
                                Foto
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-tag text-green-600 dark:text-green-400"></i>
                                Nama
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-purple-600 dark:text-purple-400"></i>
                                Kategori
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-boxes-stacked text-orange-600 dark:text-orange-400"></i>
                                Stok
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-coins text-yellow-600 dark:text-yellow-400"></i>
                                Harga
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <i class="fa-solid fa-cog"></i>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($barangs as $barang)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-all duration-200">
                            <!-- Foto -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($barang->foto)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $barang->foto) }}" 
                                             alt="{{ $barang->nama }}" 
                                             class="w-16 h-16 object-cover rounded-lg shadow-md border-2 border-gray-200 dark:border-gray-600 group-hover:scale-110 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black/40 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <i class="fa-solid fa-search-plus text-white text-xl"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center shadow-md">
                                        <i class="fa-solid fa-image text-gray-400 dark:text-gray-500 text-2xl"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Nama -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                    {{ $barang->nama }}
                                </div>
                            </td>

                            <!-- Kategori -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300 border border-purple-200 dark:border-purple-700">
                                    {{ $barang->kategori }}
                                </span>
                            </td>

                            <!-- Stok -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                        {{ $barang->stok }}
                                    </span>
                                    @if ($barang->stok < 5)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/70 dark:text-red-200 border border-red-200 dark:border-red-700 animate-pulse">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            Kritis!
                                        </span>
                                    @elseif ($barang->stok >= 5 && $barang->stok <= 10)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 dark:bg-yellow-900/70 dark:text-yellow-200 border border-yellow-200 dark:border-yellow-700">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            Menipis
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/70 dark:text-green-200 border border-green-200 dark:border-green-700">
                                            <i class="fa-solid fa-circle-check"></i>
                                            Aman
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Harga -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Rp</span>
                                    {{ number_format($barang->harga, 0, ',', '.') }}
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('barang.edit', $barang) }}" 
                                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white text-xs font-semibold rounded-lg transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                        <i class="fa-solid fa-edit"></i>
                                        Edit
                                    </a>
                                    @if (auth()->user()->isAdmin())
                                        <form action="{{ route('barang.destroy', $barang) }}" 
                                              method="POST" 
                                              class="inline-block" 
                                              onsubmit="return confirm('⚠️ Anda yakin ingin menghapus barang ini?');">
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
                                        <i class="fa-solid fa-inbox text-3xl text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">
                                        Tidak ada data barang
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Tidak ada barang yang cocok dengan pencarian Anda
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($barangs->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                {{ $barangs->links() }}
            </div>
        @endif
    </div>
</div>