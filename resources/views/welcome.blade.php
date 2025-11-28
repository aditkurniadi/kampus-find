<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kampus - Find</title>
    @include('partials.head')

    <style>
        /* Sembunyikan Scrollbar tapi tetap bisa di-scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
    @fluxScripts
</head>

<body class="bg-white dark:bg-gray-900">
    @include('partials.header')

    {{-- SECTION 1: HERO --}}
    <div class="relative bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="mx-auto max-w-7xl lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8">
            <div class="px-6 pt-10 pb-24 sm:pb-32 lg:col-span-7 lg:px-0 lg:pt-40 lg:pb-48 xl:col-span-6">
                <div class="mx-auto max-w-lg lg:mx-0">
                    <h1
                        class="mt-24 text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:mt-10 sm:text-7xl dark:text-white">
                        Pusat Informasi Barang Hilang
                    </h1>
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="{{ route('gallery') }}"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">
                            Temukan Barang
                        </a>

                        {{-- Tombol Feedback Cepat --}}
                        <a href="{{ route('feedback') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">
                            Beri Masukan <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0">
                <img src="{{ asset('assets/welcome-page.jpg') }}" alt=""
                    class="aspect-3/2 w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full dark:bg-gray-800" />
            </div>
        </div>
    </div>

    {{-- SECTION 2: STATISTIK --}}
    <div
        class="relative isolate overflow-hidden bg-white py-24 sm:py-32 dark:bg-gray-900 transition-colors duration-300">
        {{-- Background Effects --}}
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-y=.8&w=2830&h=1500&q=80&blend=111827&sat=-100&exp=15&blend-mode=screen"
            alt=""
            class="absolute inset-0 -z-10 size-full object-cover object-right opacity-10 md:object-center dark:hidden" />
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-y=.8&w=2830&h=1500&q=80&blend=111827&sat=-100&exp=15&blend-mode=multiply"
            alt=""
            class="absolute inset-0 -z-10 size-full object-cover object-right not-dark:hidden md:object-center" />

        {{-- Gradients --}}
        <div class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl">
            <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                class="aspect-1097/845 w-274.25 bg-linear-to-tr from-[#ff4694] to-[#776fff] opacity-15 dark:opacity-20">
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl dark:text-white">
                    Kami Hadir Untuk Membantu
                </h2>
            </div>

            {{-- Grid Stats --}}
            <div
                class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-6 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-8">

                {{-- Card 1 --}}
                <div
                    class="flex gap-x-4 rounded-xl bg-white/30 p-6 ring-1 ring-gray-900/5 backdrop-blur-sm dark:bg-white/5 dark:inset-ring dark:inset-ring-white/5">
                    <svg viewBox="0 0 20 20" fill="currentColor"
                        class="h-7 w-5 flex-none text-indigo-600 dark:text-indigo-400">
                        <path
                            d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z"
                            clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                    <div class="text-base/7">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Penemuan Barang Hari Ini</h3>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $dataCount }}</p>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div
                    class="flex gap-x-4 rounded-xl bg-white/30 p-6 ring-1 ring-gray-900/5 backdrop-blur-sm dark:bg-white/5 dark:inset-ring dark:inset-ring-white/5">
                    <svg viewBox="0 0 20 20" fill="currentColor"
                        class="h-7 w-5 flex-none text-indigo-600 dark:text-indigo-400">
                        <path
                            d="m7.171 4.146 1.947 2.466a3.514 3.514 0 0 1 1.764 0l1.947-2.466a6.52 6.52 0 0 0-5.658 0Zm8.683 3.025-2.466 1.947c.15.578.15 1.186 0 1.764l2.466 1.947a6.52 6.52 0 0 0 0-5.658Zm-3.025 8.683-1.947-2.466c-.578.15-1.186.15-1.764 0l-1.947 2.466a6.52 6.52 0 0 0 5.658 0ZM4.146 12.83l2.466-1.947a3.514 3.514 0 0 1 0-1.764L4.146 7.171a6.52 6.52 0 0 0 0 5.658ZM5.63 3.297a8.01 8.01 0 0 1 8.738 0 8.031 8.031 0 0 1 2.334 2.334 8.01 8.01 0 0 1 0 8.738 8.033 8.033 0 0 1-2.334 2.334 8.01 8.01 0 0 1-8.738 0 8.032 8.032 0 0 1-2.334-2.334 8.01 8.01 0 0 1 0-8.738A8.03 8.03 0 0 1 5.63 3.297Zm5.198 4.882a2.008 2.008 0 0 0-2.243.407 1.994 1.994 0 0 0-.407 2.243 1.993 1.993 0 0 0 .992.992 2.008 2.008 0 0 0 2.243-.407c.176-.175.31-.374.407-.585a2.008 2.008 0 0 0-.407-2.243 1.993 1.993 0 0 0-.585-.407Z"
                            clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                    <div class="text-base/7">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Penemuan Telah Kembali</h3>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $dataSelesai }}</p>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div
                    class="flex gap-x-4 rounded-xl bg-white/30 p-6 ring-1 ring-gray-900/5 backdrop-blur-sm dark:bg-white/5 dark:inset-ring dark:inset-ring-white/5">
                    <svg viewBox="0 0 20 20" fill="currentColor"
                        class="h-7 w-5 flex-none text-indigo-600 dark:text-indigo-400">
                        <path
                            d="M2 3.5A1.5 1.5 0 0 1 3.5 2h9A1.5 1.5 0 0 1 14 3.5v11.75A2.75 2.75 0 0 0 16.75 18h-12A2.75 2.75 0 0 1 2 15.25V3.5Zm3.75 7a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5Zm0 3a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5ZM5 5.75A.75.75 0 0 1 5.75 5h4.5a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 5 8.25v-2.5Z"
                            clip-rule="evenodd" fill-rule="evenodd" />
                        <path d="M16.5 6.5h-1v8.75a1.25 1.25 0 1 0 2.5 0V8a1.5 1.5 0 0 0-1.5-1.5Z" />
                    </svg>
                    <div class="text-base/7">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Penemuan Barang Tersedia</h3>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $barangTersedia }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- SECTION 3: FEEDBACK CAROUSEL (NEW)         --}}
    {{-- ========================================== --}}
    <section
        class="py-24 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="mx-auto max-w-2xl text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-white">Apa Kata Mereka?
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Pengalaman pengguna lain menggunakan layanan Kampus Find.
                </p>

                @if (isset($averageRating) && $averageRating > 0)
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <span class="text-3xl font-black text-yellow-500">{{ number_format($averageRating, 1) }}</span>
                        <div class="flex text-yellow-400">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-6 h-6 {{ $i < round($averageRating) ? 'fill-current' : 'text-gray-300 dark:text-gray-600' }}"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                    </div>
                @endif
            </div>

            {{-- Carousel Container --}}
            {{-- Menggunakan x-data AlpineJS untuk kontrol tombol Kiri/Kanan --}}
            <div x-data="{
                scrollLeft() { $refs.scroller.scrollBy({ left: -320, behavior: 'smooth' }) },
                    scrollRight() { $refs.scroller.scrollBy({ left: 320, behavior: 'smooth' }) }
            }" class="relative group">

                {{-- Tombol Previous (Hanya muncul di desktop saat hover) --}}
                <button @click="scrollLeft()"
                    class="hidden md:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-10 h-10 bg-white dark:bg-gray-700 rounded-full shadow-lg items-center justify-center text-gray-600 dark:text-white hover:bg-indigo-50 dark:hover:bg-gray-600 transition-opacity opacity-0 group-hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>

                {{-- Scroll Area --}}
                <div x-ref="scroller"
                    class="flex overflow-x-auto gap-6 pb-8 snap-x snap-mandatory no-scrollbar scroll-smooth">

                    @if ($feedbacks->count() > 0)
                        @foreach ($feedbacks as $feedback)
                            {{-- Item Card --}}
                            <div
                                class="snap-center shrink-0 w-[300px] md:w-[350px] flex flex-col justify-between p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                                <div>
                                    {{-- Header Card: Avatar & Nama --}}
                                    <div class="flex items-center gap-4 mb-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center font-bold text-indigo-600 dark:text-indigo-300">
                                            {{ substr($feedback->user->name ?? 'A', 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-white text-sm">
                                                {{ $feedback->user->name ?? 'Anonim' }}
                                            </h4>
                                            <span
                                                class="text-xs text-gray-500">{{ $feedback->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    {{-- Stars --}}
                                    <div class="flex text-yellow-400 mb-3">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $feedback->rating)
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300 dark:text-gray-600 fill-current"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>

                                    {{-- Message --}}
                                    <p class="text-gray-600 dark:text-gray-300 text-sm italic line-clamp-3">
                                        "{{ $feedback->message }}"
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- Fallback jika belum ada ulasan --}}
                        <div class="w-full text-center py-10">
                            <p class="text-gray-500 italic">Belum ada ulasan saat ini. Jadilah yang pertama!</p>
                            <a href="{{ route('feedback') }}"
                                class="mt-4 inline-block text-indigo-600 font-semibold hover:underline">Beri Ulasan</a>
                        </div>
                    @endif

                    {{-- Spacer kanan agar card terakhir tidak mentok --}}
                    <div class="w-4 shrink-0"></div>
                </div>

                {{-- Tombol Next --}}
                <button @click="scrollRight()"
                    class="hidden md:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-10 h-10 bg-white dark:bg-gray-700 rounded-full shadow-lg items-center justify-center text-gray-600 dark:text-white hover:bg-indigo-50 dark:hover:bg-gray-600 transition-opacity opacity-0 group-hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8 lg:py-40">
            <div class="mx-auto max-w-4xl divide-y divide-gray-900/10 dark:divide-white/10">
                <h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white mb-10">
                    Pertanyaan yang Sering Diajukan
                </h2>

                <dl class="mt-10 space-y-6 divide-y divide-gray-900/10 dark:divide-white/10">

                    {{-- FAQ ITEM 1 --}}
                    <div x-data="{ open: false }" class="pt-6">
                        <dt>
                            <button @click="open = !open" type="button"
                                class="flex w-full items-start justify-between text-left text-gray-900 dark:text-white">
                                <span class="text-base/7 font-semibold">Bagaimana cara melaporkan barang hilang?</span>
                                <span class="ml-6 flex h-7 items-center">
                                    {{-- Icon Plus (Muncul saat tertutup) --}}
                                    <svg x-show="!open" class="size-6" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                    {{-- Icon Minus (Muncul saat terbuka) --}}
                                    <svg x-show="open" class="size-6" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                        style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                    </svg>
                                </span>
                            </button>
                        </dt>
                        <dd x-show="open" x-collapse class="mt-2 pr-12">
                            <p class="text-base/7 text-gray-600 dark:text-gray-400">
                                Anda cukup login ke dalam sistem, lalu masuk ke menu "Laporan Saya" dan klik "Buat
                                Laporan Baru". Isi detail barang seperti foto, lokasi hilang, dan ciri-ciri khusus.
                            </p>
                        </dd>
                    </div>

                    {{-- FAQ ITEM 2 --}}
                    <div x-data="{ open: false }" class="pt-6">
                        <dt>
                            <button @click="open = !open" type="button"
                                class="flex w-full items-start justify-between text-left text-gray-900 dark:text-white">
                                <span class="text-base/7 font-semibold">Apakah saya perlu membayar untuk mengambil
                                    barang?</span>
                                <span class="ml-6 flex h-7 items-center">
                                    <svg x-show="!open" class="size-6" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                    <svg x-show="open" class="size-6" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                    </svg>
                                </span>
                            </button>
                        </dt>
                        <dd x-show="open" x-collapse class="mt-2 pr-12">
                            <p class="text-base/7 text-gray-600 dark:text-gray-400">
                                Tidak. Layanan ini sepenuhnya gratis untuk seluruh civitas akademika kampus. Namun, Anda
                                wajib membawa kartu identitas (KTM/KTP) saat pengambilan barang di pos keamanan.
                            </p>
                        </dd>
                    </div>

                    {{-- FAQ ITEM 3 --}}
                    <div x-data="{ open: false }" class="pt-6">
                        <dt>
                            <button @click="open = !open" type="button"
                                class="flex w-full items-start justify-between text-left text-gray-900 dark:text-white">
                                <span class="text-base/7 font-semibold">Berapa lama barang akan disimpan?</span>
                                <span class="ml-6 flex h-7 items-center">
                                    <svg x-show="!open" class="size-6" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                    <svg x-show="open" class="size-6" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                    </svg>
                                </span>
                            </button>
                        </dt>
                        <dd x-show="open" x-collapse class="mt-2 pr-12">
                            <p class="text-base/7 text-gray-600 dark:text-gray-400">
                                Barang temuan akan disimpan di pos keamanan selama maksimal 3 bulan. Jika tidak ada yang
                                mengklaim, barang akan disumbangkan atau dimusnahkan sesuai kebijakan kampus.
                            </p>
                        </dd>
                    </div>

                    {{-- FAQ ITEM 4 --}}
                    <div x-data="{ open: false }" class="pt-6">
                        <dt>
                            <button @click="open = !open" type="button"
                                class="flex w-full items-start justify-between text-left text-gray-900 dark:text-white">
                                <span class="text-base/7 font-semibold">Bagaimana jika saya menemukan barang orang
                                    lain?</span>
                                <span class="ml-6 flex h-7 items-center">
                                    <svg x-show="!open" class="size-6" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                    <svg x-show="open" class="size-6" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                    </svg>
                                </span>
                            </button>
                        </dt>
                        <dd x-show="open" x-collapse class="mt-2 pr-12">
                            <p class="text-base/7 text-gray-600 dark:text-gray-400">
                                Silakan serahkan barang tersebut ke pos satpam terdekat. Petugas keamanan akan mendata
                                barang tersebut dan menguploadnya ke sistem Kampus Find agar pemiliknya bisa
                                menemukannya.
                            </p>
                        </dd>
                    </div>

                </dl>
            </div>
        </div>
    </section>

    @include('partials.footer')
    @livewireScripts
</body>

</html>
