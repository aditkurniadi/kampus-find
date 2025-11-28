<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Laporan Kehilangan</h2>
            </div>

            <div
                class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl overflow-hidden">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                    <thead class="bg-zinc-50 dark:bg-zinc-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Pelapor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($items as $item)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $item->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                                class="h-10 w-10 rounded-lg object-cover bg-gray-100">
                                        @else
                                            <div
                                                class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center text-gray-500 text-xs">
                                                No Pic</div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $item->item_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $item->category->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $item->location }}</td>
                                <td class="px-6 py-4">
                                    <select wire:change="updateStatus({{ $item->id }}, $event.target.value)"
                                        class="text-xs rounded-lg border-gray-300 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                                        <option value="dicari" {{ $item->status == 'dicari' ? 'selected' : '' }}>Dicari
                                        </option>
                                        <option value="ditemukan" {{ $item->status == 'ditemukan' ? 'selected' : '' }}>
                                            Ditemukan</option>
                                        <option value="dibatalkan"
                                            {{ $item->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    {{-- TOMBOL CHAT --}}
                                    <a href="{{ route('chat.room', $item->id) }}"
                                        class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        Hubungi
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-500 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="mx-auto mb-2 h-10 w-10 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    Belum ada laporan kehilangan!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">{{ $items->links() }}</div>
            </div>
        </div>
    </div>
</div>
