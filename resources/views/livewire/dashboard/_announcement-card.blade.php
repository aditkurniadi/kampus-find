<div
    class="relative flex flex-col rounded-xl border border-blue-200 bg-blue-50 p-4 dark:border-blue-700/50 dark:bg-blue-900/20 md:p-6 mb-4">

    <div class="flex items-center gap-3 mb-4">
        <div class="flex-shrink-0 rounded-full bg-blue-100 p-2 dark:bg-blue-800">
            <svg class="h-6 w-6 text-blue-700 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.34 3.34a1.5 1.5 0 0 0-1.5 1.5v.755a11.95 11.95 0 0 1-5.635 3.31l-.25.125a1.5 1.5 0 0 0-1.06 1.343v1.343a1.5 1.5 0 0 0 1.06 1.343l.25.125a11.95 11.95 0 0 1 5.635 3.31V17.25a1.5 1.5 0 0 0 1.5 1.5h.008a1.5 1.5 0 0 0 1.5-1.5v-1.738a11.95 11.95 0 0 1 5.635-3.31l.25-.125a1.5 1.5 0 0 0 1.06-1.343v-1.343a1.5 1.5 0 0 0-1.06-1.343l-.25-.125a11.95 11.95 0 0 1-5.635-3.31V4.84a1.5 1.5 0 0 0-1.5-1.5h-.008Z" />
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-200">
            Papan Pengumuman
        </h3>
    </div>

    <div class="space-y-4 max-h-72 overflow-y-auto pr-2">

        @foreach ($announcements as $announcement)
            <div class="rounded-lg bg-white/50 p-4 dark:bg-gray-800/30 ring-1 ring-blue-200/50 dark:ring-blue-700/60">

                <h4 class="font-semibold text-gray-900 dark:text-white">
                    {{ $announcement->title }}
                </h4>

                <div class="mt-2 text-sm text-gray-800 dark:text-gray-300 prose prose-sm dark:prose-invert max-w-none">
                    {!! nl2br(e($announcement->content)) !!}
                </div>

                <div class="mt-3 border-t border-blue-200/50 pt-2 dark:border-blue-700/50">
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                        Diposting oleh: <strong>{{ $announcement->user?->name ?? 'Admin' }}</strong>

                        @if ($announcement->created_at)
                            - {{ $announcement->created_at->diffForHumans() }}
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
