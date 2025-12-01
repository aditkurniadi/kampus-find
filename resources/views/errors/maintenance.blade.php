<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance - Kampus Find</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Agar support Dark Mode otomatis mengikuti sistem/browser */
        @media (prefers-color-scheme: dark) {
            html {
                background-color: #111827;
            }

            /* bg-gray-900 */
        }
    </style>
</head>

<body class="h-full">
    <div class="bg-white dark:bg-gray-900 min-h-screen flex flex-col">

        <main class="mx-auto w-full max-w-7xl px-6 pt-10 pb-16 sm:pb-24 lg:px-8 flex-1 flex flex-col justify-center">


            <div class="mx-auto mt-20 max-w-2xl text-center sm:mt-24">
                <p class="text-base/8 font-semibold text-indigo-600 dark:text-indigo-400">System Maintenance</p>
                <h1
                    class="mt-4 text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-6xl dark:text-white">
                    Kami Akan Segera Kembali
                </h1>
                <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8 dark:text-gray-400">
                    Maaf atas ketidaknyamanan ini. Kami sedang melakukan pemeliharaan sistem rutin untuk meningkatkan
                    layanan Kampus Find.
                </p>
            </div>

            <div class="mx-auto mt-16 flow-root max-w-lg sm:mt-20">
                <h2 class="sr-only">Bantuan Darurat</h2>
                <ul role="list"
                    class="-mt-6 divide-y divide-gray-900/5 border-b border-gray-900/5 dark:divide-white/10 dark:border-white/10">

                    {{-- Kontak Keamanan --}}
                    <li class="relative flex gap-x-6 py-6">
                        <div
                            class="flex size-10 flex-none items-center justify-center rounded-lg shadow-xs outline-1 outline-gray-900/10 dark:bg-gray-800/50 dark:-outline-offset-1 dark:outline-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="size-6 text-indigo-600 dark:text-indigo-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="flex-auto">
                            <h3 class="text-sm/6 font-semibold text-gray-900 dark:text-white">
                                <a href="tel:+6283879354568">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    Hubungi Keamanan
                                </a>
                            </h3>
                            <p class="mt-2 text-sm/6 text-gray-600 dark:text-gray-400">Untuk laporan kehilangan yang
                                sangat mendesak.</p>
                        </div>
                        <div class="flex-none self-center">
                            <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                class="size-5 text-gray-400 dark:text-gray-500">
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </div>
                    </li>

                    {{-- Login Admin (PENTING AGAR ADMIN BISA MASUK) --}}
                    <li class="relative flex gap-x-6 py-6">
                        <div
                            class="flex size-10 flex-none items-center justify-center rounded-lg shadow-xs outline-1 outline-gray-900/10 dark:bg-gray-800/50 dark:-outline-offset-1 dark:outline-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="size-6 text-indigo-600 dark:text-indigo-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <div class="flex-auto">
                            <h3 class="text-sm/6 font-semibold text-gray-900 dark:text-white">
                                <a href="{{ route('login') }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    Login Administrator
                                </a>
                            </h3>
                            <p class="mt-2 text-sm/6 text-gray-600 dark:text-gray-400">Akses khusus untuk pengelola
                                sistem.</p>
                        </div>
                        <div class="flex-none self-center">
                            <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                class="size-5 text-gray-400 dark:text-gray-500">
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </div>
                    </li>

                </ul>
                <div class="mt-10 flex justify-center">
                    <p class="text-sm/6 font-semibold text-gray-500">Estimasi selesai: Segera</p>
                </div>
            </div>
        </main>

        <footer class="border-t border-gray-100 py-6 sm:py-10 dark:border-white/10">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-center gap-8 px-6 sm:flex-row lg:px-8">
                <p class="text-sm/7 text-gray-400 dark:text-gray-500">&copy; {{ date('Y') }} Kampus Find. All rights
                    reserved.</p>
            </div>
        </footer>
    </div>
</body>

</html>
