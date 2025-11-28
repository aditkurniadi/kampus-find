<div>
    <x-slot:title>
        Dashboard Mahasiswa - {{ config('app.name') }}
    </x-slot:title>

    <div class="flex h-full w-full flex-1 flex-col gap-6">

        {{-- ========================================== --}}
        {{-- SECTION 1: STATISTIK KONTRIBUSI SAYA       --}}
        {{-- ========================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            {{-- KARTU 1: TOTAL PENEMUAN SAYA --}}
            <div
                class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Kontribusi Saya</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $myTotalReports ?? 0 }}</p>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
                        {{-- Icon Archive Box --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3.75h3.75M12 11.25h-3.75m-6.75-3.75h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- KARTU 2: BELUM DIAMBIL (AVAILABLE) --}}
            <div
                class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum Diambil</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $myActiveReports ?? 0 }}</p>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-yellow-50 text-yellow-600 dark:bg-yellow-900/20 dark:text-yellow-400">
                        {{-- Icon Clock --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- KARTU 3: TELAH KEMBALI (SOLVED) --}}
            <div
                class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Telah Kembali</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $mySolvedReports ?? 0 }}</p>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-green-50 text-green-600 dark:bg-green-900/20 dark:text-green-400">
                        {{-- Icon Check Badge --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        {{-- ========================================== --}}
        {{-- SECTION 2: GRID UTAMA (KIRI: 2/3, KANAN: 1/3) --}}
        {{-- ========================================== --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- KOLOM KIRI (LEBAR): CTA & TABEL --}}
            <div class="flex flex-col gap-6 lg:col-span-2">

                {{-- Banner Ajakan (Call to Action) --}}
                <div class="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white shadow-md">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-xl font-bold">Menemukan Barang Tercecer?</h3>
                            <p class="text-blue-100 text-sm mt-1">Bantu temanmu menemukannya dengan mengunggah foto dan
                                info barang di sini.</p>
                        </div>
                        <flux:button href="{{ route('reportMhs') }}"
                            class="bg-white text-blue-700 hover:bg-gray-50 border-none font-semibold shrink-0">
                            Lapor Penemuan
                        </flux:button>
                    </div>
                </div>

                {{-- Tabel Riwayat Penemuan --}}
                {{-- TABEL 2: LAPORAN KEHILANGAN (FITUR CHAT ADA DI SINI) --}}
                <div
                    class="mt-6 overflow-hidden rounded-xl border border-red-200 bg-white shadow-sm dark:border-red-900/30 dark:bg-neutral-800">
                    <div
                        class="flex items-center justify-between border-b border-red-100 px-6 py-4 dark:border-red-900/30 bg-red-50 dark:bg-red-900/10">
                        <h3 class="text-lg font-bold text-red-900 dark:text-red-100">Barang Hilang Saya</h3>
                        <flux:button href="#" size="xs" variant="ghost" class="text-red-600">Lihat Semua
                        </flux:button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                            {{-- Header --}}
                            <thead class="bg-red-50/50 text-xs font-medium uppercase text-red-500 dark:bg-red-900/20">
                                <tr>
                                    <th class="px-6 py-3">Barang</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3 text-center">Diskusi Admin</th> {{-- TOMBOL CHAT --}}
                                </tr>
                            </thead>
                            {{-- Body --}}
                            <tbody class="divide-y divide-red-100 dark:divide-red-900/30">
                                @forelse($myLostReports ?? [] as $lost)
                                    <tr class="transition hover:bg-red-50/30 dark:hover:bg-red-900/10">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $lost->item_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700 dark:bg-red-900/50 dark:text-red-300">
                                                {{ ucfirst($lost->status) }}
                                            </span>
                                        </td>

                                        {{-- TOMBOL CHAT (Hanya di Tabel Ini) --}}
                                        {{-- Di dalam loop foreach($myLostReports as $lost) --}}

                                        <td class="px-6 py-4 text-center">

                                            @if ($lost->messages_exists || $lost->status == 'ditemukan')
                                                {{-- KONDISI 1: Admin sudah chat --}}
                                                <div class="relative inline-block">
                                                    <a href="{{ route('chat.room', $lost->id) }}"
                                                        class="inline-flex items-center justify-center p-2 rounded-lg text-indigo-600 bg-indigo-50 hover:bg-indigo-100 transition border border-indigo-200 shadow-sm"
                                                        title="Lanjutkan Diskusi">

                                                        {{-- Icon Chat --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                                                        </svg>
                                                        <span class="ml-2 text-xs font-bold">Balas</span>
                                                    </a>

                                                    {{-- Badge Merah (Unread) --}}
                                                    @if ($lost->unread_count > 0)
                                                        <span
                                                            class="absolute top-0 right-0 -mt-1 -mr-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white ring-2 ring-white">
                                                            {{ $lost->unread_count }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                {{-- KONDISI 2: Belum ada chat dari admin --}}
                                                <span
                                                    class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-gray-400 bg-gray-100 rounded-md cursor-help"
                                                    title="Tombol chat akan muncul setelah Admin menghubungi Anda">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-3">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    Menunggu Respon
                                                </span>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 italic">Tidak ada
                                            laporan kehilangan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN (SEMPIT): PENGUMUMAN --}}
            <div class="flex flex-col gap-6">

                {{-- Card Tambahan (Bisa diisi Hotline Keamanan) --}}
                <div
                    class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-2">Butuh Bantuan?</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Jika Anda mengalami kendala saat melaporkan
                        barang, hubungi pos keamanan.</p>
                    <flux:button variant="outline" size="sm" class="w-full">Hubungi Keamanan</flux:button>
                </div>

            </div>

        </div>
    </div>
</div>
