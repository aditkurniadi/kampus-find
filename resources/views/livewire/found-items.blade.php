<div>
    <x-slot:title>
        Barang Manager - {{ config('app.name') }}
    </x-slot:title>
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

        <!-- [DIUBAH] Grup untuk filter di sebelah kiri -->
        <div class="flex items-center space-x-4">

            <!-- Filter Tanggal (Sudah ada) -->
            <div>
                <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                    </svg>
                    {{ $this->filterLabel }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Menu Dropdown Tanggal -->
                <div id="dropdownRadio"
                    class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                    data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownRadioButton">

                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="dateFilter" id="filter-radio-all" type="radio" value="all"
                                    name="dateFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-radio-all"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">All
                                    time</label>
                            </div>
                        </li>
                        <!-- ... Opsi tanggal lainnya ... -->
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="dateFilter" id="filter-radio-day" type="radio" value="day"
                                    name="dateFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-radio-day"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                    day</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="dateFilter" id="filter-radio-week" type="radio" value="week"
                                    name="dateFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-radio-week"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                    7 days</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="dateFilter" id="filter-radio-month" type="radio"
                                    value="month" name="dateFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-radio-month"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                    30 days</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="dateFilter" id="filter-radio-last-month" type="radio"
                                    value="last_month" name="dateFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-radio-last-month"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                    month</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="dateFilter" id="filter-radio-year" type="radio" value="year"
                                    name="dateFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-radio-year"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                    year</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- [BARU] Filter Status -->
            <div>
                <button id="dropdownStatusButton" data-dropdown-toggle="dropdownStatus"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                    <!-- Ikon Filter -->
                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M18.81 1.902a1 1 0 0 0-1.414 0L10 9.293 2.604 1.9a1 1 0 0 0-1.414 1.414L8.586 10.707 1.19 18.098a1 1 0 1 0 1.414 1.414L10 12.121l7.396 7.391a1 1 0 0 0 1.414-1.414L11.414 10.707l7.396-7.391a1 1 0 0 0 0-1.414Z" />
                    </svg>
                    {{ $this->statusFilterLabel }} <!-- Memanggil computed property baru -->
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Menu Dropdown Status -->
                <div id="dropdownStatus"
                    class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                    data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownStatusButton">
                        <!-- Opsi All Status -->
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="statusFilter" id="filter-status-all" type="radio"
                                    value="all" name="statusFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-status-all"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">All
                                    Status</label>
                            </div>
                        </li>
                        <!-- Opsi Tersedia -->
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="statusFilter" id="filter-status-available" type="radio"
                                    value="available" name="statusFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-status-available"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Tersedia</svg>
                                </label>
                            </div>
                        </li>
                        <!-- Opsi Pending -->
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="statusFilter" id="filter-status-pending" type="radio"
                                    value="pending" name="statusFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-status-pending"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Pending</svg>
                                </label>
                            </div>
                        </li>
                        <!-- Opsi Rejected -->
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="statusFilter" id="filter-status-rejected" type="radio"
                                    value="rejected" name="statusFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-status-rejected"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Ditolak</svg>
                                </label>
                            </div>
                        </li>
                        <!-- Opsi Selesai -->
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live="statusFilter" id="filter-status-selesai" type="radio"
                                    value="selesai" name="statusFilter" class="w-4 h-4 text-blue-600 ...">
                                <label for="filter-status-selesai"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Selesai</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Grup untuk Search dan Tombol Add di sebelah kanan (Sudah ada) -->
        <div class="flex flex-col items-center justify-between space-y-4 md:flex-row md:space-y-0">
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
                    <input wire:model.live="search" type="text" id="table-search"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for items">
                </div>
            </div>
            <div>
                <button wire:click='openCreateModal' type="button"
                    class="inline-flex items-center rounded-lg bg-blue-700 px-4 py-2 ml-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="h-5 w-5 mr-1.5">
                        <path
                            d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                    </svg>
                    Tambah Data
                </button>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Foto</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Deskripsi</th>
                    <th scope="col" class="px-6 py-3">Lokasi DiTemukan</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Tanggal DiTemukan</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($foundItems as $item)
                    <tr wire:key="{{ $item->id }}">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{ asset('storage/' . $item->image) }}"
                                class="w-20 h-20 rounded-lg object-cover" alt="{{ $item->name }}">
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->location_found }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->status == 'available')
                                <span
                                    class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-white">
                                    Tersedia
                                </span>
                            @elseif ($item->status == 'selesai')
                                <span
                                    class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-white">
                                    Selesai
                                </span>
                            @elseif ($item->status == 'pending')
                                <span
                                    class="inline-flex items-center rounded-full bg-amber-500 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-white">
                                    Pending
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center rounded-full bg-red-300 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-white">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->date_found->isoFormat('D MMMM YYYY') }}
                        </td>
                        @if ($item->status != 'pending')
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">

                                    <!-- Tombol Edit -->
                                    <button wire:click="openEditModal({{ $item->id }})" type="button"
                                        class="p-1 rounded-full text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-700 hover:bg-blue-100 dark:hover:bg-blue-800/50"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>

                                    <!-- Tombol Delete -->
                                    <button wire:click="openDeleteConfirm({{ $item->id }})" type="button"
                                        class="p-1 rounded-full text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-700 hover:bg-red-100 dark:hover:bg-red-800/50"
                                        title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>

                                    <!-- [BARU] Tombol Toggle Status (Tanpa Dropdown) -->
                                    @if ($item->status == 'available')
                                        <button wire:click="openCompleteModal({{ $item->id }})" type="button"
                                            class="p-1 rounded-full text-green-600 hover:text-green-900 dark:text-green-500 dark:hover:text-green-700 hover:bg-green-100 dark:hover:bg-green-800/50"
                                            title="Tandai Selesai">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </button>
                                    @elseif ($item->status == 'selesai')
                                        <button wire:click="openInfoModal({{ $item->id }})" type="button"
                                            class="p-1 rounded-full text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 hover:bg-indigo-100 dark:hover:bg-indigo-900/50"
                                            title="Lihat Data Pengambil">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>
                                    @endif

                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-10 align-middle mx-1 inline">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <br>
                            Tidak ada data barang untuk ditampilkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4 px-6 py-3"> {{ $foundItems->links() }}
        </div>
    </div>

    @if ($showModal)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">

            <div class="relative w-full max-w-3xl p-4 max-h-[90vh] my-6">

                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700 overflow-y-auto">
                    <div
                        class="sticky top-0 flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5 bg-white dark:bg-gray-700 z-10">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Tambah Data Penemuan Barang
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

                        <form wire:submit.prevent='createData'>

                            <div class="grid grid-cols-1 gap-y-4 lg:grid-cols-2 lg:gap-x-6">

                                <div class="space-y-4">
                                    <div>
                                        <label for="name"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                        <input wire:model.defer="name" type="text" name="name" id="name"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="description"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                        <textarea wire:model.defer="description" name="description" id="description" rows="3"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                        @error('description')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="location_found"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Lokasi
                                            DiTemukan</label>
                                        <input wire:model.defer="location_found" type="text" name="location_found"
                                            id="location_found"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        @error('location_found')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="date_found"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                            DiTemukan</label>
                                        <input wire:model.defer="date_found" type="date" name="date_found"
                                            id="date_found"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        @error('date_found')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="category"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                        <select wire:model.defer="category_id" id="category" name="category"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label for="profile-pitcure"
                                            class="block text-sm/6 font-medium text-gray-900 dark:text-white">Foto</label>
                                        <div
                                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-6 dark:border-gray-300/25">
                                            <div class="text-center">
                                                <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon"
                                                    aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                                    <path
                                                        d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                        clip-rule="evenodd" fill-rule="evenodd" />
                                                </svg>
                                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                                    <label for="image"
                                                        class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500 dark:text-indigo-200">
                                                        <span>Upload a file</span>
                                                        <input wire:model='image' id="image" type="file"
                                                            name="image" class="sr-only"
                                                            accept="image/png, image/jpg, image/jpeg" />
                                                    </label>
                                                    <p class="pl-1 dark:text-zinc-50">or drag and drop</p>
                                                </div>
                                                <p class="text-xs/5 text-gray-600 dark:text-zinc-50">PNG, JPG 5MB</p>
                                            </div>
                                        </div>
                                        @error('image')
                                            <p class="mt-2 text-ss text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div wire:loading wire:target="image"
                                        class="flex items-center justify-center w-20 h-20 border border-gray-200 rounded-lg bg-gray-50 ">
                                        <div
                                            class="px-3 py-1 text-[10px] font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse">
                                            loading...</div>
                                    </div>

                                    @if ($image)
                                        <div>
                                            <p class="my-2 text-sm/6 font-medium dark:text-white">Preview</p>
                                            <img src="{{ $image->temporaryUrl() }}"
                                                class="w-20 h-20 rounded-2xl mt-2 block object-cover">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit"
                                    class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <span wire:loading.remove wire:target='createData'>
                                        Simpan Data
                                    </span>
                                    <span wire:loading wire:target='createData'>
                                        Menyimpan...
                                    </span>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($showModalEdit)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">

            <div class="relative w-full max-w-3xl p-4 max-h-[90vh] my-6">

                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700 overflow-y-auto">
                    <div
                        class="sticky top-0 flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5 bg-white dark:bg-gray-700 z-10">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit Data Penemuan Barang
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

                        <form wire:submit.prevent='updateData'>

                            <div class="grid grid-cols-1 gap-y-4 lg:grid-cols-2 lg:gap-x-6">

                                <div class="space-y-4">
                                    <div>
                                        <label for="name"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                        <input wire:model.defer="name" type="text" name="name" id="name"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="description"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                        <textarea wire:model.defer="description" name="description" id="description" rows="3"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                        @error('description')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="location_found"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Lokasi
                                            DiTemukan</label>
                                        <input wire:model.defer="location_found" type="text" name="location_found"
                                            id="location_found"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        @error('location_found')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="date_found"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                            DiTemukan</label>
                                        <input wire:model.defer="date_found" type="date" name="date_found"
                                            id="date_found"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        @error('date_found')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="category"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                        <select wire:model.defer="category_id" id="category" name="category"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label for="profile-pitcure"
                                            class="block text-sm/6 font-medium text-gray-900 dark:text-white">Foto</label>
                                        <div
                                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-6 dark:border-gray-300/25">
                                            <div class="text-center">
                                                <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon"
                                                    aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                                    <path
                                                        d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                        clip-rule="evenodd" fill-rule="evenodd" />
                                                </svg>
                                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                                    <label for="image_edit"
                                                        class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500 dark:text-indigo-200">
                                                        <span>Upload a file</span>
                                                        <input wire:model='image' id="image_edit" type="file"
                                                            name="image" class="sr-only"
                                                            accept="image/png, image/jpg, image/jpeg" />
                                                    </label>
                                                    <p class="pl-1 dark:text-zinc-50">or drag and drop</p>
                                                </div>
                                                <p class="text-xs/5 text-gray-600 dark:text-zinc-50">PNG, JPG 5MB</p>
                                            </div>
                                        </div>
                                        @error('image')
                                            <p class="mt-2 text-ss text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div wire:loading wire:target="image"
                                        class="flex items-center justify-center w-20 h-20 border border-gray-200 rounded-lg bg-gray-50 ">
                                        <div
                                            class="px-3 py-1 text-[10px] font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse">
                                            loading...</div>
                                    </div>

                                    <div>
                                        <p class="my-2 text-sm/6 font-medium dark:text-white">Preview</p>
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}"
                                                class="w-20 h-20 rounded-2xl mt-2 block object-cover">
                                        @elseif ($existingImage)
                                            <img src="{{ asset('storage/' . $existingImage) }}"
                                                class="w-20 h-20 rounded-2xl mt-2 block object-cover">
                                        @else
                                            <p class="text-sm text-gray-500 dark:text-gray-300">Tidak ada gambar.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit"
                                    class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <span wire:loading.remove wire:target='updateData'>
                                        Simpan Perubahan
                                    </span>
                                    <span wire:loading wire:target='updateData'>
                                        Menyimpan...
                                    </span>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if ($showModalDelete)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
            <div class="relative w-full max-w-md p-4">
                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">
                    <div
                        class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Konfirmasi Hapus Data Barang
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
                            Anda yakin ingin menghapus barang: <strong>{{ $name }}</strong>?
                            Tindakan ini tidak dapat dibatalkan.
                        </p>
                        <div class="mt-6 flex justify-end space-x-2">
                            <button wire:click="closeModal" type="button"
                                class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                                Batal
                            </button>
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

    {{-- Modal Konfirmasi Barang Diambil --}}
    @if ($showModalComplete)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
            <div class="relative w-full max-w-md p-4">
                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">

                    {{-- Header Modal --}}
                    <div
                        class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Data Pengambil Barang
                        </h3>
                        <button wire:click="closeModal" type="button"
                            class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>

                    {{-- Body Modal --}}
                    <div class="p-4 md:p-5">
                        <form wire:submit.prevent="markAsCompleted">
                            <div class="space-y-4">
                                <p class="text-sm text-gray-500 dark:text-gray-300">
                                    Silahkan lengkapi data mahasiswa/orang yang mengambil barang ini sebagai bukti
                                    arsip.
                                </p>

                                {{-- Input Nama Pengambil --}}
                                <div>
                                    <label for="taken_by_name"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Pengambil</label>
                                    <input wire:model.defer="taken_by_name" type="text" id="taken_by_name"
                                        required
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Contoh: Budi Santoso">
                                    @error('taken_by_name')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Input NPM --}}
                                <div>
                                    <label for="taken_by_npm"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">NPM /
                                        NIK</label>
                                    <input wire:model.defer="taken_by_npm" type="text" id="taken_by_npm" required
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Contoh: 210102030">
                                    @error('taken_by_npm')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Input Nomor HP --}}
                                <div>
                                    <label for="taken_by_phone"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nomor HP /
                                        WA</label>
                                    <input wire:model.defer="taken_by_phone" type="text" id="taken_by_phone"
                                        required
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Contoh: 08123456789">
                                    @error('taken_by_phone')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Footer Modal --}}
                            <div class="mt-6 flex justify-end space-x-2">
                                <button wire:click="closeModal" type="button"
                                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="rounded-lg bg-green-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600">
                                    <span wire:loading.remove wire:target="markAsCompleted">Selesai & Simpan</span>
                                    <span wire:loading wire:target="markAsCompleted">Menyimpan...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($showModalInfo)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
            <div class="relative w-full max-w-md p-4">
                <div class="relative rounded-lg bg-white shadow-xl dark:bg-gray-800">

                    <div
                        class="flex items-center justify-between border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            Detail Pengambil Barang
                        </h3>
                        <button wire:click="closeModal"
                            class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="mb-4 rounded-md bg-indigo-50 p-3 dark:bg-indigo-900/30">
                            <p class="text-xs text-indigo-600 dark:text-indigo-300 uppercase tracking-wide font-bold">
                                Barang Diambil</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $name }}</p>
                        </div>

                        <div class="grid grid-cols-1 gap-4">

                            <div class="shrink-0">
                                @if ($image)
                                    <img src="{{ asset('storage/' . $image) }}"
                                        class="h-16 w-16 rounded-lg object-cover border border-indigo-200 dark:border-indigo-700 shadow-sm"
                                        alt="Foto Barang">
                                @else
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-lg bg-indigo-100 text-indigo-400 dark:bg-indigo-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Nama
                                    Pengambil</label>
                                <p class="mt-1 text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $taken_by_name }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">NPM
                                        / NIK</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $taken_by_npm }}</p>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Nomor
                                        HP</label>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $taken_by_phone) }}"
                                        target="_blank"
                                        class="mt-1 inline-flex items-center gap-1 text-sm font-medium text-green-600 hover:underline dark:text-green-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $taken_by_phone }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-between border-t border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-700/50 rounded-b-lg">
                        <button wire:click="toggleStatus({{ $selectedItemId }})" type="button"
                            class="text-sm text-red-600 hover:text-red-800 hover:underline dark:text-red-400 dark:hover:text-red-300">
                            Batalkan Status Selesai (Undo)
                        </button>
                        <button wire:click="closeModal"
                            class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-300 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
                            Tutup
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
