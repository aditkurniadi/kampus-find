<div class="max-w-5xl mx-auto py-6 sm:py-8 px-4 sm:px-6" x-data>

    {{-- Header (Responsive: Stack di Mobile, Row di Desktop) --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-6 sm:mb-8">
        <div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Kotak Masuk</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">Notifikasi dan update terbaru untuk Anda.</p>
        </div>

        @if ($notifications->count() > 0)
            <button wire:click="markAllRead"
                class="self-start sm:self-auto text-xs font-semibold uppercase tracking-wider text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 hover:underline transition">
                Tandai semua dibaca
            </button>
        @endif
    </div>

    {{-- LIST VIEW (Preview Only) --}}
    <div class="grid gap-3">
        @forelse($notifications as $notif)
            <div wire:key="item-{{ $notif->id }}" wire:click="showDetail({{ $notif->id }})"
                class="group relative cursor-pointer rounded-2xl border p-3 sm:p-4 transition-all duration-200 
                {{ $notif->is_read
                    ? 'bg-white/50 border-gray-100 hover:bg-white hover:shadow-md dark:bg-zinc-900/50 dark:border-zinc-800 dark:hover:bg-zinc-800'
                    : 'bg-white border-indigo-100 shadow-sm ring-1 ring-indigo-50 hover:shadow-lg hover:-translate-y-0.5 dark:bg-zinc-800 dark:border-indigo-900 dark:ring-indigo-900' }}
                {{ $notif->type == 'reward' ? 'border-l-4 border-l-yellow-400 dark:border-l-yellow-500' : '' }}">

                <div class="flex items-start gap-3 sm:gap-4">
                    {{-- Icon / Avatar --}}
                    <div class="shrink-0 mt-0.5 sm:mt-1">
                        @if ($notif->type == 'reward')
                            <div
                                class="flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-full bg-yellow-100 text-lg sm:text-xl shadow-inner dark:bg-yellow-900/30">
                                🏆
                            </div>
                        @elseif($notif->type == 'system')
                            <div
                                class="flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-full bg-gray-100 text-lg sm:text-xl text-gray-500 shadow-inner dark:bg-zinc-700 dark:text-gray-300">
                                ⚙️
                            </div>
                        @else
                            <div
                                class="flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-full bg-blue-50 text-lg sm:text-xl text-blue-500 shadow-inner dark:bg-blue-900/20 dark:text-blue-400">
                                📩
                            </div>
                        @endif
                    </div>

                    {{-- Content Preview --}}
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-2">
                            <h3
                                class="font-bold truncate text-sm sm:text-base {{ $notif->is_read ? 'text-gray-700 dark:text-gray-300' : 'text-gray-900 dark:text-white' }}">
                                {{ $notif->title }}
                            </h3>
                            <span class="shrink-0 text-[10px] font-medium text-gray-400">
                                {{ $notif->created_at->diffForHumans() }}
                            </span>
                        </div>

                        {{-- Snippet (Truncated Text) --}}
                        <p class="mt-0.5 sm:mt-1 line-clamp-1 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                            {{ Str::limit($notif->message, 80) }}
                        </p>
                    </div>

                    {{-- Unread Indicator (Dot) --}}
                    @if (!$notif->is_read)
                        <div class="shrink-0 self-center">
                            <span
                                class="block h-2 w-2 sm:h-2.5 sm:w-2.5 rounded-full bg-indigo-500 ring-2 ring-white dark:ring-zinc-900"></span>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div
                class="flex flex-col items-center justify-center py-12 sm:py-16 text-center border-2 border-dashed border-gray-200 dark:border-zinc-800 rounded-3xl bg-gray-50/50 dark:bg-zinc-900/50">
                <div class="mb-4 rounded-full bg-gray-100 p-3 sm:p-4 text-2xl sm:text-3xl dark:bg-zinc-800">📭</div>
                <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Tidak ada pesan</h3>
                <p class="text-xs sm:text-sm text-gray-500">Kotak masuk Anda bersih dan rapi.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $notifications->links() }}
    </div>

    {{-- MODAL DETAIL VIEW --}}
    @if ($selectedNotification)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" x-transition>
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" wire:click="closeDetail">
            </div>

            {{-- Modal Content --}}
            <div
                class="relative w-full max-w-lg transform overflow-hidden rounded-2xl bg-white p-5 sm:p-6 shadow-2xl transition-all dark:bg-zinc-900 border border-gray-100 dark:border-zinc-700 max-h-[90vh] overflow-y-auto">

                {{-- Tombol Close X --}}
                <button wire:click="closeDetail"
                    class="absolute right-4 top-4 rounded-full p-1 text-gray-400 hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-zinc-800 dark:hover:text-gray-300">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="flex flex-col items-center text-center sm:items-start sm:text-left">
                    {{-- Icon Besar di Detail --}}
                    <div
                        class="mb-4 inline-flex h-14 w-14 sm:h-16 sm:w-16 items-center justify-center rounded-full shadow-sm
                        {{ $selectedNotification->type == 'reward' ? 'bg-yellow-100 text-2xl sm:text-3xl dark:bg-yellow-900/30' : 'bg-indigo-50 text-2xl sm:text-3xl dark:bg-indigo-900/30' }}">
                        {{ $selectedNotification->type == 'reward' ? '🏆' : '📩' }}
                    </div>

                    <h3 class="text-lg sm:text-xl font-bold leading-6 text-gray-900 dark:text-white">
                        {{ $selectedNotification->title }}
                    </h3>

                    <p class="mt-1 text-xs font-medium text-gray-400">
                        Diterima pada {{ $selectedNotification->created_at->translatedFormat('d F Y, H:i') }}
                    </p>

                    {{-- Isi Pesan Full --}}
                    <div
                        class="mt-4 w-full rounded-xl bg-gray-50 p-4 text-sm leading-relaxed text-gray-600 dark:bg-zinc-800/50 dark:text-gray-300 text-left">
                        {!! nl2br(e($selectedNotification->message)) !!}
                    </div>
                </div>

                {{-- Footer Modal --}}
                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-3">
                    {{-- Tombol Hapus --}}
                    <button wire:click="delete({{ $selectedNotification->id }})"
                        class="order-2 sm:order-1 w-full sm:w-auto rounded-lg px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-900/20 dark:hover:text-red-400 transition">
                        Hapus Pesan
                    </button>

                    {{-- Tombol Tutup --}}
                    <button wire:click="closeDetail"
                        class="order-1 sm:order-2 w-full sm:w-auto rounded-lg bg-indigo-600 px-5 py-2 text-sm font-bold text-white shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition active:scale-95">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
