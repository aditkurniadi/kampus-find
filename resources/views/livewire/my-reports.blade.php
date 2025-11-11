<div> <!-- Root Div -->

    <!-- PERTAMA: Toast Notification container -->
    <!-- (Ini penting agar notifikasi dispatch() Anda bisa muncul) -->
    <div x-data="{
        show: false,
        type: 'success',
        message: '',
        timer: null
    }"
        x-on:show-toast.window="
        clearTimeout(timer);
        type = event.detail.type || 'success';
        message = event.detail.message || 'Pesan Default';
        show = true;
        timer = setTimeout(() => show = false, 5000);
    "
        x-show="show" x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed right-5 top-5 z-50 w-full max-w-xs rounded-lg bg-white p-4 text-gray-500 shadow-lg dark:bg-gray-800 dark:text-gray-400"
        role="alert" style="display: none;">

        <div class="flex items-center">
            <!-- Ikon Success -->
            <div x-show="type === 'success'"
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-500 dark:bg-green-800 dark:text-green-200">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
            </div>
            <!-- Ikon Danger -->
            <div x-show="type === 'danger'"
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-500 dark:bg-red-800 dark:text-red-200">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
            </div>
            <!-- Ikon Warning -->
            <div x-show="type === 'warning' || type === 'info'"
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-orange-500 dark:bg-orange-700 dark:text-orange-200">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                </svg>
            </div>
            <!-- Pesan -->
            <div class="ms-3 text-sm font-normal" x-text="message"></div>
            <!-- Tombol Close -->
            <button @click="show = false" type="button"
                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </div>
    <!-- AKHIR DARI TOAST -->


    <!-- KEDUA: Kontrol (Search dan Tombol Add) -->
    <div class="flex flex-col items-center justify-between space-y-4 pb-4 md:flex-row md:space-y-0">

        <!-- Bagian 1: Search Bar -->
        <div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center ps-3 rtl:inset-r-0 rtl:right-0">
                    <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input wire:model.live="search" type="text" id="table-search"
                    class="block w-80 rounded-lg border border-gray-300 bg-gray-50 p-2 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                    placeholder="Cari berdasarkan nama, deskripsi...">
            </div>
        </div>

        <!-- Bagian 2: Tombol Tambah Laporan -->
        <div>
            <button wire:click='openCreateModal' type="button"
                class="ml-2 inline-flex items-center rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1.5 h-5 w-5">
                    <path
                        d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                </svg>
                Lapor Barang Temuan
            </button>
        </div>
    </div>


    <!-- KETIGA: Tabel Data Laporan Saya -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Foto</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Lokasi</th>
                    <th scope="col" class="px-6 py-3">Tgl. Ditemukan</th>
                    <th scope="col" class="px-6 py-3">Status</th> <!-- Kolom Baru -->
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Perhatikan: $myItems as $item -->
                @forelse ($myItems as $item)
                    <tr wire:key="{{ $item->id }}"
                        class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">

                        <!-- Foto -->
                        <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}"
                                    class="h-16 w-16 rounded-lg object-cover" alt="{{ $item->name }}">
                            @else
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-lg bg-gray-200 text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <!-- Nama -->
                        <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $item->name }}
                        </td>
                        <!-- Lokasi -->
                        <td class="px-6 py-4">{{ $item->location_found }}</td>
                        <!-- Tanggal -->
                        <td class="px-6 py-4">
                            @if ($item->date_found)
                                {{ $item->date_found->isoFormat('D MMMM YYYY') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <!-- Status (BARU) -->
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
                                <button wire:click="openRejectionDetails({{ $item->id }})" type="button"
                                    class="inline-flex cursor-pointer items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 hover:bg-red-200 dark:bg-red-900 dark:text-red-200 dark:hover:bg-red-700">

                                    <svg class="-ml-0.5 mr-1 h-2 w-2 text-red-500" fill="currentColor"
                                        viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Ditolak

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                        class="ml-1 h-3 w-3">
                                        <path fill-rule="evenodd"
                                            d="M8 1.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13ZM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm8-3a.75.75 0 0 1 .75.75v3c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-3A.75.75 0 0 1 8 5Zm0 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif
                        </td>
                        <!-- Action -->
                        <td class="px-6 py-4">
                            <!-- Tombol Edit & Delete HANYA MUNCUL JIKA STATUS 'pending' -->
                            @if ($item->status == 'pending')
                                <button wire:click="openEditModal({{ $item->id }})" type="button"
                                    class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                                    Edit
                                </button>
                                <button wire:click="openDeleteConfirm({{ $item->id }})" type="button"
                                    class="ml-2 font-medium text-red-600 hover:underline dark:text-red-500">
                                    Delete
                                </button>
                            @else
                                <span class="text-xs text-gray-400 dark:text-gray-500">Telah diverifikasi</span>
                            @endif
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
                            Anda belum melaporkan barang temuan apapun.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginasi -->
    <div class="mt-4">
        {{ $myItems->links() }}
    </div>


    <!-- ======================================================================== -->
    <!-- MODAL CREATE -->
    <!-- ======================================================================== -->
    @if ($showModal)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
            <div class="relative my-6 w-full max-w-md p-4 max-h-[90vh]">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="sticky top-0 z-10 flex items-center justify-between rounded-t border-b border-gray-200 bg-white p-4 dark:border-gray-600 dark:bg-gray-700 md:p-5">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Lapor Barang Temuan
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

                    <!-- Modal body -->
                    <div class="overflow-y-auto p-4 md:p-5">
                        <form wire:submit.prevent='createReport' class="space-y-4">
                            <!-- Name -->
                            <div>
                                <label for="name"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Barang</label>
                                <input wire:model.defer="name" type="text" id="name"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Description -->
                            <div>
                                <label for="description"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                <textarea wire:model.defer="description" id="description" rows="3"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Ciri-ciri, warna, merk, dll..."></textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Location Found -->
                            <div>
                                <label for="location_found"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Lokasi
                                    Ditemukan</label>
                                <input wire:model.defer="location_found" type="text" id="location_found"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Misal: Perpus Lt. 2, Kantin, dll." />
                                @error('location_found')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Date Found -->
                            <div>
                                <label for="date_found"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                    Ditemukan</label>
                                <input wire:model.defer="date_found" type="date" id="date_found"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                @error('date_found')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Category -->
                            <div>
                                <label for="category"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                <select wire:model.defer="category_id" id="category"
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
                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 dark:text-white">Foto</label>
                                <div
                                    class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-6 dark:border-gray-300/25">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                            <label for="image-create"
                                                class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 dark:text-indigo-200">
                                                <span>Upload a file</span>
                                                <input wire:model='image' id="image-create" type="file"
                                                    class="sr-only" accept="image/png, image/jpg, image/jpeg" />
                                            </label>
                                            <p class="pl-1 dark:text-zinc-50">or drag and drop</p>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600 dark:text-zinc-50">PNG, JPG up to 5MB
                                        </p>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Image Preview -->
                            <div wire:loading wire:target="image"
                                class="flex h-20 w-20 items-center justify-center rounded-lg border border-gray-200 bg-gray-50">
                                <div
                                    class="animate-pulse rounded-full bg-blue-200 px-3 py-1 text-[10px] font-medium leading-none text-center text-blue-800">
                                    loading...</div>
                            </div>
                            @if ($image)
                                <p class="my-2 text-sm/6 font-medium">Preview:</p>
                                <img src="{{ $image->temporaryUrl() }}"
                                    class="mt-2 block h-20 w-20 rounded-2xl object-cover">
                            @endif

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <span wire:loading.remove wire:target='createReport'>
                                    Kirim Laporan
                                </span>
                                <span wire:loading wire:target='createReport'>
                                    Mengirim...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- ======================================================================== -->
    <!-- MODAL EDIT -->
    <!-- ======================================================================== -->
    @if ($showModalEdit)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
            <div class="relative my-6 w-full max-w-md p-4 max-h-[90vh]">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="sticky top-0 z-10 flex items-center justify-between rounded-t border-b border-gray-200 bg-white p-4 dark:border-gray-600 dark:bg-gray-700 md:p-5">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit Laporan
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

                    <!-- Modal body -->
                    <div class="overflow-y-auto p-4 md:p-5">
                        <form wire:submit.prevent='updateReport' class="space-y-4">
                            <!-- Name -->
                            <div>
                                <label for="name-edit"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Barang</label>
                                <input wire:model.defer="name" type="text" id="name-edit"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Description -->
                            <div>
                                <label for="description-edit"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                <textarea wire:model.defer="description" id="description-edit" rows="3"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Location Found -->
                            <div>
                                <label for="location_found-edit"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Lokasi
                                    Ditemukan</label>
                                <input wire:model.defer="location_found" type="text" id="location_found-edit"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                @error('location_found')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Date Found -->
                            <div>
                                <label for="date_found-edit"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                    Ditemukan</label>
                                <input wire:model.defer="date_found" type="date" id="date_found-edit"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                @error('date_found')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Category -->
                            <div>
                                <label for="category-edit"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                <select wire:model.defer="category_id" id="category-edit"
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
                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 dark:text-white">Foto (Opsional:
                                    Ganti foto)</label>
                                <div
                                    class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-6 dark:border-gray-300/25">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                            <label for="image-edit"
                                                class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 dark:text-indigo-200">
                                                <span>Upload file baru</span>
                                                <input wire:model='image' id="image-edit" type="file"
                                                    class="sr-only" accept="image/png, image/jpg, image/jpeg" />
                                            </label>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600 dark:text-zinc-50">PNG, JPG up to 5MB
                                        </p>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Image Preview -->
                            <div wire:loading wire:target="image"
                                class="flex h-20 w-20 items-center justify-center rounded-lg border border-gray-200 bg-gray-50">
                                <div
                                    class="animate-pulse rounded-full bg-blue-200 px-3 py-1 text-[10px] font-medium leading-none text-center text-blue-800">
                                    loading...</div>
                            </div>

                            @if ($image)
                                <p class_loading="my-2 text-sm/6 font-medium">Preview Baru:</p>
                                <img src="{{ $image->temporaryUrl() }}"
                                    class="mt-2 block h-20 w-20 rounded-2xl object-cover">
                            @elseif ($existingImage)
                                <p class="my-2 text-sm/6 font-medium">Foto Saat Ini:</p>
                                <img src="{{ asset('storage/' . $existingImage) }}"
                                    class="mt-2 block h-20 w-20 rounded-2xl object-cover">
                            @endif

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <span wire:loading.remove wire:target='updateReport'>
                                    Simpan Perubahan
                                </span>
                                <span wire:loading wire:target='updateReport'>
                                    Menyimpan...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- ======================================================================== -->
    <!-- MODAL DELETE -->
    <!-- ======================================================================== -->
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
                        </button>
                    </div>
                    <div class="p-4 md:p-5">
                        <p class="text-gray-700 dark:text-gray-300">
                            Anda yakin ingin menghapus laporan: <strong>{{ $name }}</strong>?
                            Tindakan ini tidak dapat dibatalkan.
                        </p>
                        <div class="mt-6 flex justify-end space-x-2">
                            <button wire:click="closeModal" type="button"
                                class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                                Batal
                            </button>
                            <button wire:click="deleteReport" type="button"
                                class="rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                <span wire:loading.remove wire:target='deleteReport'>
                                    Ya, Hapus
                                </span>
                                <span wire:loading wire:target='deleteReport'>
                                    Menghapus...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($showRejectionModal && $selectedItem)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
            <div class="relative w-full max-w-md p-4">
                <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">

                    <div
                        class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Detail Penolakan Laporan
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

                    <div class="p-4 md:p-5 space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Barang:</h4>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $selectedItem->name }}
                            </p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Alasan Penolakan:</h4>
                            <p class="text-gray-700 dark:text-gray-300">
                                {{ $selectedItem->rejection_reason ?? 'Tidak ada alasan dari admin.' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Ditangani Oleh:</h4>
                            <p class="text-gray-700 dark:text-gray-300">
                                {{ $selectedItem->handler->name ?? 'Admin Sistem' }}
                                <span
                                    class="text-xs text-gray-400">({{ $selectedItem->handler->role ?? 'N/A' }})</span>
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end space-x-2 rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5">
                        <button wire:click="closeModal" type="button"
                            class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                            Mengerti
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div> <!-- Akhir Root Div -->
