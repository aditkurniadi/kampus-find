<div>
    <x-slot:title>
        Dashboard Mahasiswa - {{ config('app.name') }}
    </x-slot:title>

    <div class="flex h-full w-full flex-1 flex-col gap-8">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            {{-- Card 1: Total Kontribusi --}}
            <div
                class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:border-blue-300 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                <div
                    class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-blue-50 transition-all group-hover:scale-110 dark:bg-blue-900/10">
                </div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Total Kontribusi</p>
                        <p class="mt-1 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                            {{ $myTotalReports ?? 0 }}</p>
                    </div>
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-500/20 dark:text-blue-400">
                        <flux:icon name="archive-box" variant="mini" />
                    </div>
                </div>
            </div>

            {{-- Card 2: Proses Pencarian --}}
            <div
                class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:border-yellow-300 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                <div
                    class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-yellow-50 transition-all group-hover:scale-110 dark:bg-yellow-900/10">
                </div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Proses Pencarian</p>
                        <p class="mt-1 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                            {{ $myActiveReports ?? 0 }}</p>
                    </div>
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 dark:bg-yellow-500/20 dark:text-yellow-400">
                        <flux:icon name="clock" variant="mini" />
                    </div>
                </div>
            </div>

            {{-- Card 3: Kasus Selesai --}}
            <div
                class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:border-green-300 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                <div
                    class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-green-50 transition-all group-hover:scale-110 dark:bg-green-900/10">
                </div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Laporan Selesai</p>
                        <p class="mt-1 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                            {{ $mySolvedReports ?? 0 }}</p>
                    </div>
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-500/20 dark:text-green-400">
                        <flux:icon name="check-circle" variant="mini" />
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- SECTION 3: MAIN CONTENT (GRID) --}}
        {{-- ========================================== --}}
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- KOLOM KIRI (LEBAR): CTA & LIST LAPORAN --}}
            <div class="flex flex-col gap-8 lg:col-span-2">

                {{-- Banner Ajakan (Call to Action) --}}
                <div
                    class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 px-8 py-8 text-white shadow-lg">
                    <div
                        class="relative z-10 flex flex-col items-start gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="max-w-md">
                            <h3 class="text-2xl font-bold">Menemukan Barang?</h3>
                            <p class="mt-2 text-indigo-100">
                                Jangan biarkan barang tersebut hilang selamanya. Laporkan penemuanmu dan bantu temanmu
                                menemukannya kembali.
                            </p>
                        </div>
                        <flux:button href="{{ route('reportMhs') }}"
                            class="bg-white text-indigo-600 hover:bg-indigo-50 border-none font-bold shadow-md shrink-0">
                            Buat Laporan Baru
                        </flux:button>
                    </div>

                    {{-- Decorative Shapes --}}
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 h-40 w-40 rounded-full bg-white/10 blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-10 -ml-10 h-40 w-40 rounded-full bg-white/10 blur-2xl">
                    </div>
                </div>

                {{-- List Laporan Kehilangan (Modern List View) --}}
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-zinc-900 dark:text-white flex items-center gap-2">
                            <flux:icon name="exclamation-triangle" class="text-red-500" variant="mini" />
                            Laporan Kehilangan Saya
                        </h3>
                        <a href="{{ route('myLostItems') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <div class="flex flex-col gap-3">
                        @forelse($myLostReports ?? [] as $lost)
                            {{-- Card Item --}}
                            <div
                                class="group flex flex-col gap-4 rounded-xl border border-zinc-200 bg-white p-4 shadow-sm transition hover:border-indigo-300 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900 sm:flex-row sm:items-center sm:justify-between">

                                {{-- Kiri: Info Barang --}}
                                <div class="flex items-start gap-4">
                                    {{-- Icon/Gambar Placeholder --}}
                                    <div
                                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-zinc-100 text-zinc-400 dark:bg-zinc-800">
                                        <flux:icon name="photo" variant="mini" class="h-6 w-6" />
                                    </div>

                                    <div>
                                        <h4
                                            class="font-semibold text-zinc-900 dark:text-white group-hover:text-indigo-600 transition">
                                            {{ $lost->item_name }}
                                        </h4>
                                        <div
                                            class="mt-1 flex items-center gap-3 text-xs text-zinc-500 dark:text-zinc-400">
                                            <span class="flex items-center gap-1">
                                                <flux:icon name="calendar" class="h-3 w-3" />
                                                {{ $lost->created_at->diffForHumans() }}
                                            </span>

                                            {{-- Status Badge --}}
                                            <span
                                                class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-medium 
                                                {{ $lost->status == 'ditemukan' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                                {{ ucfirst($lost->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kanan: Action Button (Chat) --}}
                                <div class="flex shrink-0 items-center justify-end">
                                    @if ($lost->messages_exists || $lost->status == 'ditemukan')
                                        <a href="{{ route('chat.room', $lost->id) }}"
                                            class="relative inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-200 dark:ring-zinc-600 dark:hover:bg-zinc-700">
                                            <flux:icon name="chat-bubble-left-right" class="h-4 w-4 text-indigo-500" />
                                            Diskusi
                                            @if ($lost->unread_count > 0)
                                                <span
                                                    class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-600 text-[10px] font-bold text-white shadow-sm">
                                                    {{ $lost->unread_count }}
                                                </span>
                                            @endif
                                        </a>
                                    @else
                                        <div class="flex items-center gap-1.5 rounded-lg bg-zinc-50 px-3 py-2 text-xs font-medium text-zinc-400 dark:bg-zinc-800/50 dark:text-zinc-500 cursor-help"
                                            title="Menunggu respon admin">
                                            <flux:icon name="clock" class="h-3.5 w-3.5" />
                                            Menunggu Admin
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            {{-- Empty State --}}
                            <div
                                class="flex flex-col items-center justify-center rounded-xl border border-dashed border-zinc-300 bg-zinc-50 py-12 text-center dark:border-zinc-700 dark:bg-zinc-800/50">
                                <div class="rounded-full bg-zinc-100 p-3 dark:bg-zinc-800">
                                    <flux:icon name="check" class="h-6 w-6 text-zinc-400" />
                                </div>
                                <h3 class="mt-2 text-sm font-semibold text-zinc-900 dark:text-white">Aman terkendali
                                </h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Belum ada barang yang Anda laporkan
                                    hilang.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN (SIDEBAR): BANTUAN --}}
            <div class="flex flex-col gap-6">

                {{-- Card Bantuan (Tetap Dipertahankan) --}}
                <div
                    class="relative overflow-hidden rounded-xl border border-zinc-200 bg-zinc-50 p-5 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="relative z-10">
                        <div class="mb-3 flex items-center gap-2">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-orange-100 text-orange-600 dark:bg-orange-500/20 dark:text-orange-400">
                                <flux:icon name="lifebuoy" variant="mini" />
                            </div>
                            <h3 class="font-bold text-zinc-900 dark:text-white">Butuh Bantuan?</h3>
                        </div>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            Jika Anda mengalami kendala teknis atau darurat keamanan terkait barang hilang.
                        </p>

                        <div class="mt-4 flex flex-col gap-2">
                            <flux:button variant="outline" size="sm" icon="phone"
                                class="w-full justify-start bg-white dark:bg-zinc-700 shadow-sm">
                                Hotline Satpam
                            </flux:button>
                            <flux:button variant="ghost" size="sm" icon="envelope"
                                class="w-full justify-start text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-700/50">
                                Email Admin
                            </flux:button>
                        </div>
                    </div>

                    {{-- Hiasan Background --}}
                    <div
                        class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-orange-500/5 blur-2xl dark:bg-orange-400/10">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
