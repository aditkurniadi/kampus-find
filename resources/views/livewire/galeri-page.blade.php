<div>
    <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-16 lg:max-w-7xl lg:px-8">

        <div class="mb-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center sm:text-left">
                Galeri Barang Temuan
            </h2>
            <p class="mt-1 text-base text-gray-600 dark:text-gray-300 text-center sm:text-left">
                Lihat semua barang yang telah ditemukan oleh pengguna.
            </p>
        </div>

        <div class="mb-8">
            <div class="flex flex-col md:flex-row gap-4">

                <div class="flex-grow">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text" id="search"
                            class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cari nama, lokasi, atau kategori...">
                    </div>
                </div>

                <div class="w-full md:w-auto">
                    <label for="date_filter" class="sr-only">Filter Tanggal</label>
                    <select wire:model.live="date_filter" id="date_filter"
                        class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="all">Semua Waktu</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">7 Hari Terakhir</option>
                        <option value="month">30 Hari Terakhir</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:grid-cols-6 lg:gap-x-8">

            @forelse ($data as $item)
                <div wire:click="openDetailModal({{ $item->id }})"
                    class="group relative flex cursor-pointer flex-col overflow-hidden rounded-lg border border-gray-200 bg-gray-50 shadow-sm transition-all duration-200 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">

                    <div class="aspect-square w-full overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                            class="h-full w-full object-cover object-center transition-opacity duration-200 group-hover:opacity-80" />
                    </div>

                    <div class="flex flex-1 flex-col p-4">

                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $item->name }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                                {{ $item->description }}
                            </p>
                        </div>

                        <div class="mt-4 flex flex-col space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <svg class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.274 1.765 11.842 11.842 0 00.757.433.62.62 0 00.28.14l.019.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="truncate" title="{{ $item->location_found ?? 'Lokasi' }}">
                                    {{ $item->location_found ?? 'Lokasi tidak diketahui' }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="truncate" title="{{ $item->user->name ?? 'Nama' }}">
                                    {{ $item->user->name ?? 'Nama tidak dikethaui' }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <svg class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.75 3a.75.75 0 01.75.75v.25h7V3.75a.75.75 0 011.5 0V4a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2v-.25A.75.75 0 015.75 3zM6.5 7.5c0-.414.336-.75.75-.75h5a.75.75 0 010 1.5h-5a.75.75 0 01-.75-.75zM6 10.75a.75.75 0 01.75-.75h5a.75.75 0 010 1.5h-5a.75.75 0 01-.75-.75zM6.5 14c0-.414.336-.75.75-.75h2a.75.75 0 010 1.5h-2a.75.75 0 01-.75-.75z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>
                                    {{ $item->date_found ? $item->date_found->isoFormat('D MMMM YYYY') : 'Tanggal tidak diketahui' }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 sm:col-span-2 lg:col-span-6 text-center text-gray-500 py-10">
                    <p>Tidak ada data barang temuan yang cocok dengan filter Anda.</p>
                </div>
            @endforelse

        </div>

        <div class="mt-8">
            {{ $data->links() }}
        </div>

    </div>

    @if ($showDetailModal && $selectedItem)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50"
            x-data x-transition>
            <div class="relative w-full max-w-lg p-4 max-h-[90vh] my-6">
                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-800 overflow-y-auto">

                    <div
                        class="sticky top-0 flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5 bg-white dark:bg-gray-800 z-10">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Detail Barang Temuan
                        </h3>
                        <button wire:click="closeModal" type="button"
                            class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <div class="p-4 md:p-5">
                        <div class="aspect-video w-full overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ asset('storage/' . $selectedItem->image) }}" alt="{{ $selectedItem->name }}"
                                class="h-full w-full object-cover object-center" />
                        </div>

                        <h3 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $selectedItem->name }}</h3>
                        <p class="mt-2 text-base text-gray-700 dark:text-gray-300">
                            {{ $selectedItem->description }}
                        </p>

                        <div class="mt-4 space-y-2 border-t border-gray-200 pt-4 dark:border-gray-600">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Ditemukan Oleh:</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-white">{{ $selectedItem->user->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Tanggal Ditemukan:</span>
                                <span class="font-medium text-gray-900 dark:text-white">
                                    {{ $selectedItem->date_found ? $selectedItem->date_found->isoFormat('D MMMM YYYY') : 'N/A' }}
                                </span>
                            </div>
                        </div>

                        <div
                            class="mt-6 rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-700/50 dark:bg-blue-900/20">
                            <h4 class="text-lg font-semibold text-blue-900 dark:text-blue-200">
                                Cara Mengambil Barang
                            </h4>
                            <p class="mt-2 text-sm text-blue-800 dark:text-blue-300">
                                Barang ini ditemukan di sekitar area:
                                <br>
                                <strong class="text-base">{{ $selectedItem->location_found }}</strong>
                            </p>
                            <p class="mt-3 text-sm text-blue-800 dark:text-blue-300">
                                Untuk melakukan klaim, silakan <span class="font-bold">datang langsung</span> ke Pos
                                Keamanan di
                                area tersebut dan tunjukkan bukti kepemilikan Anda (seperti KTM, Password, atau
                                ciri-ciri spesifik).
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif

</div>
