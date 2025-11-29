<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Laporan Kehilangan</h2>
            </div>

            <div
                class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl overflow-hidden">

                {{-- DESKTOP: Table (md+) --}}
                <div class="hidden md:block">
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
                                            <option value="dicari" {{ $item->status == 'dicari' ? 'selected' : '' }}>
                                                Dicari
                                            </option>
                                            <option value="ditemukan"
                                                {{ $item->status == 'ditemukan' ? 'selected' : '' }}>
                                                Ditemukan</option>
                                            <option value="dibatalkan"
                                                {{ $item->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                                            </option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('chat.room', $item->id) }}"
                                            class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg transition">
                                            Hubungi
                                        </a>

                                        <button wire:click="confirmDelete({{ $item->id }})"
                                            class="inline-flex items-center gap-2 px-3 py-2 ml-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-gray-500 dark:text-gray-400">
                                        Belum ada laporan kehilangan!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- MOBILE: Card list (smaller devices) --}}
                <div class="md:hidden divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse ($items as $item)
                        <div class="p-3">
                            <div
                                class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden shadow-sm">
                                <div class="flex gap-3 p-3">
                                    {{-- Gambar --}}
                                    <div class="flex-shrink-0">
                                        @if ($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                                class="h-16 w-16 rounded-lg object-cover bg-gray-100">
                                        @else
                                            <div
                                                class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center text-gray-500 text-xs">
                                                No Pic</div>
                                        @endif
                                    </div>

                                    {{-- Konten --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="min-w-0">
                                                <div
                                                    class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                                    {{ $item->item_name }}</div>
                                                <div class="text-xs text-gray-500 truncate mt-0.5">
                                                    {{ $item->category->name }} • {{ $item->location }}
                                                </div>
                                                <div class="text-[11px] text-gray-500 mt-1 truncate">
                                                    Pelapor: {{ $item->user->name }}
                                                </div>
                                            </div>

                                            {{-- Status small badge --}}
                                            <div class="text-right flex-shrink-0">
                                                <span
                                                    class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $item->status == 'ditemukan' ? 'bg-green-50 text-green-700 dark:bg-green-900/30' : ($item->status == 'dicari' ? 'bg-yellow-50 text-yellow-700 dark:bg-yellow-900/30' : 'bg-gray-100 text-gray-700 dark:bg-zinc-800') }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Aksi: tombol responsif --}}
                                        <div class="mt-3 grid grid-cols-2 gap-2 px-0 px-3 pb-3">
                                            <a href="{{ route('chat.room', $item->id) }}"
                                                class="inline-flex items-center justify-center w-full px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg">
                                                Chat
                                            </a>

                                            <button wire:click="confirmDelete({{ $item->id }})"
                                                class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg">
                                                Hapus
                                            </button>

                                            {{-- Status select full width di baris kedua --}}
                                            <div class="col-span-2 mt-0">
                                                <label class="sr-only">Status</label>
                                                <select
                                                    wire:change="updateStatus({{ $item->id }}, $event.target.value)"
                                                    class="mt-1 w-full text-xs rounded-lg border-gray-300 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white px-3 py-2">
                                                    <option value="dicari"
                                                        {{ $item->status == 'dicari' ? 'selected' : '' }}>Dicari
                                                    </option>
                                                    <option value="ditemukan"
                                                        {{ $item->status == 'ditemukan' ? 'selected' : '' }}>Ditemukan
                                                    </option>
                                                    <option value="dibatalkan"
                                                        {{ $item->status == 'dibatalkan' ? 'selected' : '' }}>
                                                        Dibatalkan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                            Belum ada laporan kehilangan!
                        </div>
                    @endforelse
                </div>

                {{-- Modal Konfirmasi Hapus --}}
                <div x-data="{ open: @entangle('showDeleteModal') }" x-cloak>
                    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/50 z-40"></div>

                    <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
                        <div @keydown.escape="open = false; $wire.set('showDeleteModal', false)" x-trap.noscroll="open"
                            class="w-full max-w-lg bg-white dark:bg-zinc-900 rounded-lg shadow-xl border border-gray-200 dark:border-zinc-700 overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Hapus Laporan</h3>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                    Yakin ingin menghapus laporan ini beserta semua chat dan foto terkait? Tindakan ini
                                    tidak dapat dikembalikan.
                                </p>

                                {{-- Optional: tampilkan nama item --}}
                                @if ($deleteId)
                                    @php $delItem = \App\Models\LostItem::find($deleteId); @endphp
                                    @if ($delItem)
                                        <div class="mt-4 p-3 bg-gray-50 dark:bg-zinc-800 rounded">
                                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                                {{ $delItem->item_name }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $delItem->location }}</div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="flex justify-end gap-3 p-4 border-t border-gray-100 dark:border-zinc-800">
                                <button type="button" @click="open = false; $wire.set('showDeleteModal', false)"
                                    class="px-4 py-2 rounded-md bg-gray-100 hover:bg-gray-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-sm font-medium">
                                    Batal
                                </button>

                                <button type="button" wire:click="deleteItem" wire:loading.attr="disabled"
                                    class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white text-sm font-bold">
                                    Hapus Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4">{{ $items->links() }}</div>
            </div>
        </div>
    </div>
</div>
