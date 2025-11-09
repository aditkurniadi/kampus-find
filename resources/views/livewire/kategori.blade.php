<div>
    <x-slot:title>
        Kategori Manager - {{ config('app.name') }}
    </x-slot:title>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-gray-900 dark:text-white">Data Kategori</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button wire:click="openCreateModal"
                    class="block rounded-xl bg-blue-700 px-2 py-2 text-white hover:bg-blue-800 ..." type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4 align-middle mx-1 inline">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Tambah Data Kategori
                </button>
            </div>
        </div>

        <!-- 1. TAMBAHKAN INPUT SEARCH DI SINI -->
        <div class="my-4">
            <input wire:model.live="search" type="text" placeholder="Cari nama atau email..."
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
        </div>
        <!-- AKHIR DARI INPUT SEARCH -->

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <table class="min-w-full border-separate border-spacing-0">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8 dark:border-white/15 dark:bg-gray-900/75 dark:text-white">
                                    Name</th>
                                <th scope="col"
                                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell dark:border-white/15 dark:bg-gray-900/75 dark:text-white">
                                    Slug</th>
                                <th scope="col"
                                    class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter dark:border-white/15 dark:bg-gray-900/75 dark:text-white">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr wire:key="{{ $category->id }}">
                                    <td
                                        class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8 dark:border-white/10 dark:text-white">
                                        {{ $category->name }}</td>
                                    <td
                                        class="hidden whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 sm:table-cell dark:border-white/10 dark:text-gray-400">
                                        {{ $category->slug }}</td>
                                    <td
                                        class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm dark:border-white/10">
                                        <button wire:click="openEditModal({{ $category->id }})" type="button"
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4 align-middle">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button wire:click="openDeleteConfirm({{ $category->id }})" type="button"
                                            class="ml-2 text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4 align-middle">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"
                                        class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-center text-gray-900 sm:pl-6 lg:pl-8 dark:border-white/10 dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="size-10 align-middle mx-1 inline">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                        </svg>
                                        <br>
                                        Data Kategori Kosong
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($showModal)
            <!-- Modal Create -->
            <div
                class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
                <div class="relative w-full max-w-md p-4">
                    <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">
                        <div
                            class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Tambah Data Kategori
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
                        <div class="p-4 md:p-5">
                            <form wire:submit.prevent='createKategori' class="space-y-4" x-data="{
                                slugify(value) {
                                    return value.toLowerCase()
                                        .replace(/\s+/g, '-') // Ganti spasi dengan -
                                        .replace(/[^a-z0-9\-]+/g, '') // Hapus karakter non-alfanumerik
                                        .replace(/--+/g, '-') // Ganti -- ganda dengan satu -
                                        .replace(/^-+/, '') // Hapus - di awal
                                        .replace(/-+$/, ''); // Hapus - di akhir
                                }
                            }">
                                <div>
                                    <label for="create_name"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                    <!-- PERUBAHAN: x-ref dan @input, ID unik -->
                                    <input wire:model.defer="name" type="text" name="name" id="create_name"
                                        x-ref="nameInput"
                                        @input="$refs.slugInput.value = slugify($event.target.value); $refs.slugInput.dispatchEvent(new Event('input'));"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="create_slug"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                    <!-- PERUBAHAN: x-ref, ID unik -->
                                    <input wire:model.defer="slug" type="text" name="slug" id="create_slug"
                                        x-ref="slugInput"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    @error('slug')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- PERBAIKAN: Hapus wire:click dari tombol, cukup type="submit" -->
                                <button type="submit"
                                    class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <span wire:loading.remove wire:target='createKategori'>
                                        Simpan Data
                                    </span>
                                    <span wire:loading wire:target='createKategori'>
                                        Menyimpan...
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($showModalEdit)
            <!-- Modal Edit -->
            <div
                class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
                <div class="relative w-full max-w-md p-4">
                    <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">
                        <div
                            class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Data Kategori: {{ $name ?? '' }}
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
                            <form wire:submit.prevent='updateKategori' class="space-y-4" x-data="{
                                slugify(value) {
                                    return value.toLowerCase()
                                        .replace(/\s+/g, '-') // Ganti spasi dengan -
                                        .replace(/[^a-z0-9\-]+/g, '') // Hapus karakter non-alfanumerik
                                        .replace(/--+/g, '-') // Ganti -- ganda dengan satu -
                                        .replace(/^-+/, '') // Hapus - di awal
                                        .replace(/-+$/, ''); // Hapus - di akhir
                                }
                            }">
                                <div>
                                    <label for="edit_name"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                    <!-- PERUBAHAN: x-ref dan @input, ID unik -->
                                    <input wire:model.defer="name" type="text" name="name" id="edit_name"
                                        x-ref="nameInput"
                                        @input="$refs.slugInput.value = slugify($event.target.value); $refs.slugInput.dispatchEvent(new Event('input'));"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="edit_slug"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                    <!-- PERUBAHAN: x-ref, ID unik -->
                                    <input wire:model.defer="slug" type="text" name="slug" id="edit_slug"
                                        x-ref="slugInput"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    @error('slug')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- PERBAIKAN: Hapus wire:click dari tombol, cukup type="submit" -->
                                <button type="submit"
                                    class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <span wire:loading.remove wire:target='updateKategori'>
                                        Update Data
                                    </span>
                                    <span wire:loading wire:target='updateKategori'>
                                        Menyimpan...
                                    </span>
                                </button>
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
                                Konfirmasi Hapus Kategori
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
                                Anda yakin ingin menghapus kategori: <strong>{{ $name }}</strong>?
                                Tindakan ini tidak dapat dibatalkan.
                            </p>
                            <div class="mt-6 flex justify-end space-x-2">
                                <button wire:click="closeModal" type="button"
                                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                                    Batal
                                </button>
                                <button wire:click="deleteKategori" type="button"
                                    class="rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                    <span wire:loading.remove wire:target='deleteKategori'>
                                        Ya, Hapus
                                    </span>
                                    <span wire:loading wire:target='deleteKategori'>
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
</div>
