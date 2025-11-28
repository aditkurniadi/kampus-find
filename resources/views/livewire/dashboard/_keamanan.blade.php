<div>
    <x-slot:title>
        Dashboard Petugas Keamanan - {{ config('app.name') }}
    </x-slot:title>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            <!-- INI KARTU BARU ANDA (MENGGANTIKAN DIV KIRI ATAS PERTAMA) -->
            <div
                class="relative flex h-full flex-col rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800 md:p-6">

                <!-- Bagian Atas: Judul dan Ikon -->
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                        Total Barang Temuan
                    </h3>
                    <!-- Ikon (Contoh dari Heroicons) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>

                <!-- Bagian Bawah: Angka Total -->
                <div class="mt-auto">
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $totalFound }} <!-- Gunakan variabel dari komponen -->
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Barang Temuan
                    </p>
                </div>
            </div>

            <div
                class="relative flex h-full flex-col rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800 md:p-6">

                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                        Kembali Hari Ini
                    </h3>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

                <div class="mt-auto">
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $returnedToday }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Diserahkan ke Pemilik
                    </p>
                </div>
            </div>

            {{-- <div
                class="relative flex h-full flex-col rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800 md:p-6">

                <!-- Bagian Atas: Judul dan Ikon -->
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                        Total Barang Temuan
                    </h3>
                    <!-- Ikon (Contoh dari Heroicons) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>

                <!-- Bagian Bawah: Angka Total -->
                <div class="mt-auto">
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{-- {{ $totalFound }} <!-- Gunakan variabel dari komponen -->
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Barang Temuan
                    </p>
                </div>
            </div> --}}
        </div>
        <div>
            {{-- @livewire('users') --}}
        </div>
    </div>
