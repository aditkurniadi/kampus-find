<div class="flex justify-center min-h-screen bg-zinc-50 dark:bg-zinc-900 pt-10 pb-12 px-4 sm:px-6 lg:px-8">

    {{-- Container Card --}}
    <div
        class="w-full max-w-lg bg-white dark:bg-zinc-800 rounded-2xl shadow-xl border border-zinc-200 dark:border-zinc-700 p-8 space-y-8 h-fit transition-all duration-500 ease-in-out">

        {{-- KONDISI: Jika Sukses Submit --}}
        @if ($isSuccessful)
            <div class="flex flex-col items-center justify-center text-center animate-fade-in-up">
                <lottie-player src="{{ asset('animations/success.json') }}" background="transparent" speed="1"
                    style="width: 250px; height: 250px;" loop autoplay>
                </lottie-player>

                <h2 class="text-3xl font-black text-indigo-600 dark:text-indigo-400 mt-4">
                    Terima Kasih!
                </h2>
                <p class="mt-2 text-zinc-600 dark:text-zinc-300">
                    Masukan kamu sangat berarti buat kami agar aplikasi ini makin keren.
                </p>

                <div class="mt-8 w-full space-y-3">
                    <a href="{{ route('home') }}"
                        class="block w-full rounded-lg bg-indigo-600 px-4 py-3 text-center text-sm font-semibold text-white hover:bg-indigo-500 transition">
                        Kembali ke Home
                    </a>
                    {{-- Opsi kirim lagi jika mau --}}
                    <button wire:click="$set('isSuccessful', false)"
                        class="block w-full text-sm text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300 underline">
                        Kirim ulasan lain
                    </button>
                </div>
            </div>

            {{-- KONDISI: Form Feedback (Default) --}}
        @else
            <div>
                {{-- Header Section --}}
                <div class="text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                        Berikan Penilaian Anda
                    </h2>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                        Bagaimana pengalaman Anda menggunakan aplikasi ini?
                    </p>
                </div>

                <form wire:submit="submit" class="space-y-6 mt-8">

                    {{-- Star Rating Component --}}
                    <div class="flex flex-col items-center justify-center gap-2">
                        <div class="flex items-center gap-2" x-data="{ hoverRating: 0 }">
                            @foreach (range(1, 5) as $star)
                                <button type="button" wire:click="setRating({{ $star }})"
                                    @mouseenter="hoverRating = {{ $star }}" @mouseleave="hoverRating = 0"
                                    class="focus:outline-none transition-transform duration-150 hover:scale-110 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-10 h-10 transition-colors duration-200"
                                        :class="{
                                            'text-yellow-400': hoverRating >= {{ $star }} || (hoverRating ===
                                                0 && $wire.rating >= {{ $star }}),
                                            'text-zinc-200 dark:text-zinc-600': !(hoverRating >= {{ $star }} ||
                                                (hoverRating === 0 && $wire.rating >= {{ $star }})
                                            )
                                        }">
                                        <path fill-rule="evenodd"
                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                        <flux:error name="rating" />
                    </div>

                    {{-- Text Area --}}
                    <flux:field>
                        <flux:label>Pesan / Saran</flux:label>
                        <flux:textarea wire:model="message" placeholder="Tuliskan saran Anda di sini..."
                            rows="4" />
                        <flux:error name="message" />
                    </flux:field>

                    {{-- Tombol Submit --}}
                    <div class="pt-2">
                        {{-- Tambahkan loading state agar user tau sedang proses --}}
                        <flux:button variant="primary" type="submit" class="w-full justify-center"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove>Kirim Feedback</span>
                            <span wire:loading>Mengirim...</span>
                        </flux:button>
                    </div>

                </form>
            </div>
        @endif
    </div>
</div>
