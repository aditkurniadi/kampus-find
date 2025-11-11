<div>
    <x-slot:title>
        Moderasi Laporan - {{ config('app.name') }}
    </x-slot:title>

    {{-- BAR ATAS (HANYA SEARCH) --}}
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

        <div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" id="table-search"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari nama barang, pelapor...">
            </div>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No.</th>
                    <th scope="col" class="px-6 py-3">Foto</th>
                    <th scope="col" class="px-6 py-3">Info Barang</th>
                    <th scope="col" class="px-6 py-3">Pelapor</th>
                    <th scope="col" class="px-6 py-3">Lokasi & Tgl Temuan</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $index => $report)
                    <tr wire:key="report-{{ $report->id }}"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                            {{ $reports->firstItem() + $index }}
                        </td>

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{ asset('storage/' . $report->image) }}"
                                class="w-20 h-20 rounded-lg object-cover" alt="{{ $report->name }}">
                        </th>

                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $report->name }}</div>
                            <div class="text-gray-500 dark:text-gray-400">
                                {{ $report->category->name ?? 'Tanpa Kategori' }}</div>
                            <div class="text-xs text-gray-400 mt-1 truncate max-w-xs"
                                title="{{ $report->description }}">
                                {{ Str::limit($report->description, 50) }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                            {{ $report->user->name ?? 'User Dihapus' }}
                        </td>

                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                            <div>{{ $report->location_found }}</div>
                            <div class="text-gray-500 dark:text-gray-400">
                                {{ $report->found_date?->isoFormat('D MMMM YYYY') ?? 'Tgl. Kosong' }}
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">

                                <button wire:click="approveReport({{ $report->id }})"
                                    wire:confirm="Anda yakin ingin MENYETUJUI laporan '{{ $report->name }}' dan menampilkannya?"
                                    type="button"
                                    class="p-1 rounded-full text-green-600 hover:text-green-900 dark:text-green-500 dark:hover:text-green-700 hover:bg-green-100 dark:hover:bg-green-800/50"
                                    title="Setujui (Approve)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <button wire:click="openRejectConfirm({{ $report->id }})" type="button"
                                    class="p-1 rounded-full text-yellow-600 hover:text-yellow-900 dark:text-yellow-500 dark:hover:text-yellow-700 hover:bg-yellow-100 dark:hover:bg-yellow-800/50"
                                    title="Tolak (Reject)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <button wire:click="openDeleteConfirm({{ $report->id }})" type="button"
                                    class="p-1 rounded-full text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-700 hover:bg-red-100 dark:hover:bg-red-800/50"
                                    title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 align-middle">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-10 align-middle mx-1 inline">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <br>
                            Tidak ada laporan pending untuk dimoderasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINASI --}}
        @if ($reports->hasPages())
            <div class="mt-4 px-6 py-3 bg-white dark:bg-gray-800">
                {{ $reports->links() }}
            </div>
        @endif
    </div>

    {{-- ================================= --}}
    {{-- | MODAL REJECT (TOLAK) LAPORAN  | --}}
    {{-- ================================= --}}
    @if ($showModalReject)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
            <div class="relative w-full max-w-lg p-4">
                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">

                    <form wire:submit.prevent="rejectReport">
                        <div
                            class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Tolak Laporan: {{ $name }}
                            </h3>
                            <button wire:click="closeModal" type="button"
                                class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="p-4 md:p-5">
                            <label for="rejectionReason"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                Alasan Penolakan (Wajib)
                            </label>
                            <textarea wire:model="rejectionReason" id="rejectionReason" rows="4"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-gray-200 @error('rejectionReason') border-red-500 @enderror"
                                placeholder="Contoh: Foto barang tidak jelas, deskripsi tidak lengkap... (min 10 karakter)"></textarea>
                            @error('rejectionReason')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-6 flex justify-end space-x-2 p-4 border-t dark:border-gray-600">
                            <button wire:click="closeModal" type="button"
                                class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                                Batal
                            </button>
                            <button type="submit"
                                class="rounded-lg bg-yellow-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-900">
                                <span wire:loading.remove wire:target='rejectReport'>
                                    Ya, Tolak Laporan
                                </span>
                                <span wire:loading wire:target='rejectReport'>
                                    Menolak...
                                </span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif


    {{-- ================================= --}}
    {{-- | MODAL DELETE (HAPUS) LAPORAN  | --}}
    {{-- | (Menggunakan style found-items) | --}}
    {{-- ================================= --}}
    @if ($showModalDelete)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
            <div class="relative w-full max-w-md p-4">
                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">
                    <div
                        class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Konfirmasi Hapus Laporan
                        </h3>
                        <button wire:click="closeModal" type="button"
                            class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 md:p-5">
                        <p class="text-gray-700 dark:text-gray-300">
                            Anda yakin ingin menghapus laporan barang: <strong>{{ $name }}</strong>?
                            Tindakan ini tidak dapat dibatalkan.
                        </p>
                        <div class="mt-6 flex justify-end space-x-2">
                            <button wire:click="closeModal" type="button"
                                class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                                Batal
                            </button>

                            {{-- INI KUNCI: Memanggil deleteFound() --}}
                            <button wire:click="deleteFound" type="button"
                                class="rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                <span wire:loading.remove wire:target='deleteFound'>
                                    Ya, Hapus
                                </span>
                                <span wire:loading wire:target='deleteFound'>
                                    Menghapus...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
