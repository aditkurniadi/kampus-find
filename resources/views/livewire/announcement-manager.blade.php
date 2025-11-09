<div>
    <x-slot:title>
        Announcements Manager - {{ config('app.name') }}
    </x-slot:title>
    <div>
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>
                <h2 class="text-2xl font-semibold dark:text-white">Manajemen Pengumuman</h2>
            </div>
            <div>
                <button wire:click='openCreateModal' type="button"
                    class="inline-flex items-center rounded-lg bg-blue-700 px-4 py-2 ml-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 mr-1.5">
                        <path
                            d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                    </svg>
                    Tambah Pengumuman
                </button>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Judul</th>
                        <th scope="col" class="px-6 py-3">Pembuat</th>
                        @can('is-superadmin')
                            <th scope="col" class="px-6 py-3">Status</th>
                        @endcan
                        <th scope="col" class="px-6 py-3">Tanggal Dibuat</th>
                        @can('is-superadmin')
                            <th scope="col" class="px-6 py-3">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($announcements as $item)
                        <tr wire:key="{{ $item->id }}"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->title }}
                                <p class="text-xs font-normal text-gray-500 dark:text-gray-400 line-clamp-1">
                                    {{-- [DIUBAH] Membatasi teks ke 80 karakter dan menghapus HTML --}}
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 80, '...') }}
                                </p>
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->user->name ?? 'N/A' }}
                            </td>
                            @can('is-superadmin')
                                <td class="px-6 py-4">
                                    <button wire:click="toggleStatus({{ $item->id }})" type="button"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                                    {{ $item->is_active ? 'bg-blue-600 dark:bg-blue-500' : 'bg-gray-200 dark:bg-gray-600' }}"
                                        role="switch" aria-checked="{{ $item->is_active ? 'true' : 'false' }}">

                                        <span class="sr-only">Toggle status</span>

                                        <span aria-hidden="true"
                                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out
                                    {{ $item->is_active ? 'translate-x-5' : 'translate-x-0' }}">
                                        </span>
                                    </button>
                                </td>
                            @endcan
                            <td class="px-6 py-4">
                                {{ $item->created_at }}
                            </td>
                            @can('is-superadmin')
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <button wire:click="openEditModal({{ $item->id }})" type="button"
                                            class="p-1 rounded-full text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-700 hover:bg-blue-100 dark:hover:bg-blue-800/50"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5 align-middle">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                        <button wire:click="openDeleteConfirm({{ $item->id }})" type="button"
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
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada pengumuman untuk ditampilkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $announcements->links() }}
        </div>


        @if ($showModal)
            <div
                class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50">
                <div class="relative w-full max-w-3xl p-4 max-h-[90vh] my-6">
                    <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700 overflow-y-auto">
                        <div
                            class="sticky top-0 flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5 bg-white dark:bg-gray-700 z-10">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Buat Pengumuman Baru
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
                                            <label for="title_create"
                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                            <input wire:model.defer="title" type="text" id="title_create"
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                            @error('title')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="status_create"
                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                            <select wire:model.defer="isActive" id="status_create"
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                <option value="0">Nonaktif (Sembunyikan)</option>
                                                @can('is-superadmin')
                                                    <option value="1">Aktif (Tampilkan)</option>
                                                @endcan
                                            </select>
                                            @error('isActive')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <label for="content_create"
                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Konten</label>
                                            <textarea wire:model.defer="content" id="content_create" rows="8"
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                            @error('content')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-6">
                                    <button type="submit"
                                        class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <span wire:loading.remove wire:target='createData'>
                                            Simpan Pengumuman
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
                                Edit Pengumuman
                            </h3>
                            <button wire:click="closeModal" type="button"
                                class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="h-3 w-3" ...> (Icon X) </svg>
                            </button>
                        </div>

                        <div class="p-4 md:p-5">
                            <form wire:submit.prevent='updateData'>
                                <div class="grid grid-cols-1 gap-y-4 lg:grid-cols-2 lg:gap-x-6">

                                    <div class="space-y-4">
                                        <div>
                                            <label for="title_edit"
                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                            <input wire:model.defer="title" type="text" id="title_edit"
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                            @error('title')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="status_edit"
                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                            <select wire:model.defer="isActive" id="status_edit"
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                <option value="1">Aktif (Tampilkan)</option>
                                                <option value="0">Nonaktif (Sembunyikan)</option>
                                            </select>
                                            @error('isActive')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <label for="content_edit"
                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Konten</label>
                                            <textarea wire:model.defer="content" id="content_edit" rows="8"
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                            @error('content')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
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
                                Konfirmasi Hapus Pengumuman
                            </h3>
                            <button wire:click="closeModal" type="button"
                                class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="h-3 w-3" ...> (Icon X) </svg>
                            </button>
                        </div>
                        <div class="p-4 md:p-5">
                            <p class="text-gray-700 dark:text-gray-300">
                                Anda yakin ingin menghapus pengumuman: <strong>{{ $title }}</strong>?
                                Tindakan ini tidak dapat dibatalkan.
                            </p>
                            <div class="mt-6 flex justify-end space-x-2">
                                <button wire:click="closeModal" type="button"
                                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 ...">
                                    Batal
                                </button>
                                <button wire:click="deleteData" type="button"
                                    class="rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 ...">
                                    <span wire:loading.remove wire:target='deleteData'>
                                        Ya, Hapus
                                    </span>
                                    <span wire:loading wire:target='deleteData'>
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
