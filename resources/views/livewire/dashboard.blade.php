<div>
    @can('is-all')
        @if ($announcements && $announcements->isNotEmpty())
            @include('livewire.dashboard._announcement-card', [
                'announcements' => $announcements,
            ])
        @endif
    @endcan

    <!-- INI KARTU BARU ANDA (MENGGANTIKAN DIV KIRI ATAS PERTAMA) -->
    <div
        class="relative flex h-full flex-col rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800 md:p-6 mb-3.5">

        <!-- Bagian Atas: Judul dan Ikon -->
        <div class="flex items-center justify-between">
            <h3 class="text-base text-gray-900 dark:text-white">
                Hai, Selamat datang !
            </h3>
            {{-- <!-- Ikon (Contoh dari Heroicons) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg> --}}
        </div>

        <!-- Bagian Bawah: Angka Total -->
        <div class="mt-auto">
            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                Selamat Datang, {{ auth()->user()->name }}!
            </p>
            {{-- <p class="text-sm text-gray-500 dark:text-gray-400">
                        Registered users
                    </p> --}}
        </div>
    </div>

    @can('is-superadmin')
        @include('livewire.dashboard._superadmin')
    @elsecan('is-keamanan-superadmin')
        @include('livewire.dashboard._keamanan')
    @elsecan('is-mahasiswa')
        @include('livewire.dashboard._mahasiswa')
    @endcan
</div>
