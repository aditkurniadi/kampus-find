<a href="{{ route('inbox') }}" wire:navigate
    class="p-2 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition group flex items-center justify-center">

    {{-- WRAPPER BARU: Ini kuncinya, biar badge nempel ke ikon --}}
    <div class="relative inline-block">

        {{-- Ikon Lonceng --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 group-hover:text-gray-900 dark:group-hover:text-white transition">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>

        {{-- Badge Merah --}}
        @if ($unreadCount > 0)
            <span
                class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white ring-2 ring-white dark:ring-zinc-800 pointer-events-none">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif

    </div>
</a>
