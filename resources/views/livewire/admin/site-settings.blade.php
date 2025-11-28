<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Pengaturan Gambar Website</h1>
        <p class="text-zinc-500 dark:text-zinc-400">Kelola gambar latar belakang. Klik "Reset Default" untuk kembali ke
            gambar bawaan.</p>
    </div>

    <form wire:submit.prevent="save" class="space-y-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- 1. WELCOME PAGE HERO --}}
            <div
                class="p-4 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700 flex flex-col h-full">
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold dark:text-white">Halaman Utama</h3>

                        @if ($current_welcome)
                            <button type="button" wire:click="confirmReset('welcome_image')"
                                class="text-xs font-medium text-red-600 hover:text-red-800 hover:underline dark:text-red-400 dark:hover:text-red-300">
                                Reset Default
                            </button>
                        @endif
                    </div>

                    <div
                        class="aspect-video w-full rounded-lg overflow-hidden bg-gray-100 mb-4 border border-gray-200 relative group">
                        @if ($welcome_image)
                            <img src="{{ $welcome_image->temporaryUrl() }}" class="w-full h-full object-cover">
                            {{-- Badge Preview Baru --}}
                            <span
                                class="absolute top-2 right-2 bg-blue-500 text-white text-[10px] px-2 py-1 rounded-full shadow-sm">Preview
                                Baru</span>
                        @elseif ($current_welcome)
                            <img src="{{ Storage::url($current_welcome) }}" class="w-full h-full object-cover">
                        @else
                            {{-- Tampilan Default (Placeholder) --}}
                            <div
                                class="w-full h-full flex flex-col items-center justify-center bg-gray-50 dark:bg-zinc-800 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-8 mb-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <span class="text-xs">Menggunakan Default</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <input type="file" wire:model="welcome_image"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-zinc-700 dark:file:text-zinc-300 cursor-pointer">
                        @error('welcome_image')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- 2. LOGIN PAGE --}}
            <div
                class="p-4 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700 flex flex-col h-full">
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold dark:text-white">Halaman Login</h3>
                        @if ($current_login)
                            <button type="button" wire:click="confirmReset('welcome_image')"
                                class="text-xs font-medium text-red-600 hover:text-red-800 hover:underline dark:text-red-400 dark:hover:text-red-300">
                                Reset Default
                            </button>
                        @endif
                    </div>

                    <div
                        class="aspect-[3/4] w-full rounded-lg overflow-hidden bg-gray-100 mb-4 border border-gray-200 relative">
                        @if ($login_image)
                            <img src="{{ $login_image->temporaryUrl() }}" class="w-full h-full object-cover">
                            <span
                                class="absolute top-2 right-2 bg-blue-500 text-white text-[10px] px-2 py-1 rounded-full shadow-sm">Preview
                                Baru</span>
                        @elseif ($current_login)
                            <img src="{{ Storage::url($current_login) }}" class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center bg-gray-50 dark:bg-zinc-800 text-gray-400">
                                <span class="text-xs">Menggunakan Default</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <input type="file" wire:model="login_image"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-zinc-700 dark:file:text-zinc-300 cursor-pointer">
                        @error('login_image')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- 3. REGISTER PAGE --}}
            <div
                class="p-4 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700 flex flex-col h-full">
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold dark:text-white">Halaman Register</h3>
                        @if ($current_register)
                            <button type="button" wire:click="resetImage('login_image')"
                                wire:confirm="Kembalikan gambar Login ke default?"
                                class="text-xs font-medium text-red-600 hover:underline dark:text-red-400">
                                Reset Default
                            </button>
                        @endif
                    </div>

                    <div
                        class="aspect-[3/4] w-full rounded-lg overflow-hidden bg-gray-100 mb-4 border border-gray-200 relative">
                        @if ($register_image)
                            <img src="{{ $register_image->temporaryUrl() }}" class="w-full h-full object-cover">
                            <span
                                class="absolute top-2 right-2 bg-blue-500 text-white text-[10px] px-2 py-1 rounded-full shadow-sm">Preview
                                Baru</span>
                        @elseif ($current_register)
                            <img src="{{ Storage::url($current_register) }}" class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center bg-gray-50 dark:bg-zinc-800 text-gray-400">
                                <span class="text-xs">Menggunakan Default</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <input type="file" wire:model="register_image"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-zinc-700 dark:file:text-zinc-300 cursor-pointer">
                        @error('register_image')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-zinc-700">
            <button type="submit"
                class="rounded-md bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:opacity-50">
                <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </button>
        </div>
    </form>

    {{-- MODAL KONFIRMASI CUSTOM --}}
    @if ($confirmingResetKey)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50 backdrop-blur-sm p-4 md:p-5">
            <div class="relative w-full max-w-md p-4">
                <div
                    class="relative rounded-lg bg-white shadow-xl ring-1 ring-gray-900/5 dark:bg-zinc-800 dark:ring-white/10">

                    {{-- Tombol Close X --}}
                    <button type="button" wire:click="cancelReset"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>

                    <div class="p-4 md:p-5 text-center">
                        {{-- Ikon Peringatan --}}
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            Apakah Anda yakin ingin mereset gambar ini ke default?
                        </h3>

                        <div class="flex justify-center gap-3">
                            {{-- Tombol Ya --}}
                            <button wire:click="performReset" type="button"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                <span wire:loading.remove wire:target="performReset">Ya, Reset Sekarang</span>
                                <span wire:loading wire:target="performReset">Memproses...</span>
                            </button>

                            {{-- Tombol Batal --}}
                            <button wire:click="cancelReset" type="button"
                                class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-zinc-700 dark:text-gray-400 dark:border-zinc-600 dark:hover:text-white dark:hover:bg-zinc-600">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
