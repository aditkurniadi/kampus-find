<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header & Search --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Feedback Manager</h2>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Kelola ulasan dan masukan dari pengguna.</p>
            </div>
            <div class="w-full sm:w-72">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass"
                    placeholder="Cari nama atau pesan..." />
            </div>
        </div>

        {{-- Table Container --}}
        <div
            class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                    <thead class="bg-zinc-50 dark:bg-zinc-800">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                User</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                Rating</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                Pesan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th scope="col"
                                class="px-6 py-3 text-end text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700 bg-white dark:bg-zinc-900">
                        @forelse ($feedbacks as $feedback)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">

                                {{-- User --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold text-xs">
                                            {{ substr($feedback->user->name ?? 'A', 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-zinc-900 dark:text-white">
                                                {{ $feedback->user->name ?? 'User Terhapus' }}
                                            </div>
                                            <div class="text-xs text-zinc-500">
                                                {{ $feedback->user->email ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Rating (Bintang) --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex text-yellow-400">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-4 h-4 {{ $i < $feedback->rating ? 'fill-current' : 'text-zinc-300 dark:text-zinc-600' }}"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </td>

                                {{-- Pesan --}}
                                <td class="px-6 py-4">
                                    <p class="text-sm text-zinc-600 dark:text-zinc-300 line-clamp-2 max-w-xs"
                                        title="{{ $feedback->message }}">
                                        {{ $feedback->message }}
                                    </p>
                                </td>

                                {{-- Status Visibility --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($feedback->is_visible)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Ditampilkan
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300">
                                            Disembunyikan
                                        </span>
                                    @endif
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ $feedback->created_at->format('d M Y') }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        {{-- Toggle Visibility Button --}}
                                        <button wire:click="toggleVisibility({{ $feedback->id }})"
                                            class="p-1 rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-700 transition {{ $feedback->is_visible ? 'text-zinc-400' : 'text-green-500' }}"
                                            title="{{ $feedback->is_visible ? 'Sembunyikan' : 'Tampilkan' }}">
                                            @if ($feedback->is_visible)
                                                {{-- Icon Mata Dicoret (Hide) --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                </svg>
                                            @else
                                                {{-- Icon Mata (Show) --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            @endif
                                        </button>

                                        {{-- Delete Button --}}
                                        <button wire:click="delete({{ $feedback->id }})"
                                            wire:confirm="Yakin ingin menghapus feedback ini secara permanen?"
                                            class="p-1 rounded-md text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition"
                                            title="Hapus Permanen">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-zinc-500 dark:text-zinc-400">
                                    Belum ada data feedback.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="bg-zinc-50 dark:bg-zinc-800 px-6 py-4 border-t border-zinc-200 dark:border-zinc-700">
                {{ $feedbacks->links() }}
            </div>
        </div>
    </div>
</div>
