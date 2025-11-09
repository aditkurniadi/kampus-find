<header class="bg-white dark:bg-gray-900">
    <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">

                <x-app-logo-icon class="h-20 w-auto text-indigo-500" />

                <span class="sr-only">Your Company</span>
            </a>
        </div>
        <div class="flex lg:hidden">
            <button type="button" command="show-modal" commandfor="mobile-menu"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 dark:text-gray-400">
                <span class="sr-only">Open main menu</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                    aria-hidden="true" class="size-6">
                    <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <el-popover-group class="hidden lg:flex lg:gap-x-12">
            {{-- <div class="relative">
                <button popovertarget="desktop-menu-product"
                    class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900 dark:text-white">
                    Layanan
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                        class="size-5 flex-none text-gray-400 dark:text-gray-500">
                        <path
                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                </button>

                <el-popover id="desktop-menu-product" anchor="bottom" popover
                    class="w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(3)] backdrop:bg-transparent open:block data-closed:translate-y-1 data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="p-4">
                        <div
                            class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50 dark:hover:bg-white/5">
                            <div
                                class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white dark:bg-gray-700/50 dark:group-hover:bg-gray-700">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    data-slot="icon" aria-hidden="true"
                                    class="size-6 text-gray-600 group-hover:text-indigo-600 dark:text-gray-400 dark:group-hover:text-white">
                                    <path d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="flex-auto">
                                <a href="#" class="block font-semibold text-gray-900 dark:text-white">
                                    Analytics
                                    <span class="absolute inset-0"></span>
                                </a>
                                <p class="mt-1 text-gray-600 dark:text-gray-400">Get a better understanding of your
                                    traffic</p>
                            </div>
                        </div>
                    </div>
                </el-popover>
            </div> --}}

            <a href="{{ route('home') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Home</a>
            <a href="{{ route('gallery') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Galeri
                Barang</a>

            {{-- <div class="relative">
                <button popovertarget="desktop-menu-company"
                    class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900 dark:text-white">
                    Company
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                        class="size-5 flex-none text-gray-400 dark:text-gray-500">
                        <path
                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                </button>

                <el-popover id="desktop-menu-company" anchor="bottom" popover
                    class="w-56 overflow-visible rounded-xl bg-white p-2 shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(3)] backdrop:bg-transparent open:block data-closed:translate-y-1 data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <a href="#"
                        class="block rounded-lg px-3 py-2 text-sm/6 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">About
                        us</a>
                    <a href="#"
                        class="block rounded-lg px-3 py-2 text-sm/6 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Careers</a>
                    <a href="#"
                        class="block rounded-lg px-3 py-2 text-sm/6 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Support</a>
                    <a href="#"
                        class="block rounded-lg px-3 py-2 text-sm/6 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Press</a>
                    <a href="#"
                        class="block rounded-lg px-3 py-2 text-sm/6 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Blog</a>
                </el-popover>
            </div> --}}
        </el-popover-group>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <a href="{{ route('login') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Log in <span
                    aria-hidden="true">&rarr;</span></a>
        </div>
    </nav>
    <el-dialog>
        <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
            <div tabindex="0" class="fixed inset-0 focus:outline-none">
                <el-dialog-panel
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 dark:bg-gray-900 dark:sm:ring-gray-100/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img src="/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt=""
                                class="h-8 w-auto dark:hidden" />
                            <img src="/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt=""
                                class="h-8 w-auto not-dark:hidden" />
                        </a>
                        <button type="button" command="close" commandfor="mobile-menu"
                            class="-m-2.5 rounded-md p-2.5 text-gray-700 dark:text-gray-400">
                            <span class="sr-only">Close menu</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                data-slot="icon" aria-hidden="true" class="size-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10 dark:divide-white/10">
                            <div class="space-y-2 py-6">
                                {{-- <div class="-mx-3">
                                    <button type="button" command="--toggle" commandfor="products"
                                        class="flex w-full items-center justify-between rounded-lg py-2 pr-3.5 pl-3 text-base/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">
                                        Layanan
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon"
                                            aria-hidden="true" class="size-5 flex-none in-aria-expanded:rotate-180">
                                            <path
                                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                                clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <el-disclosure id="products" hidden class="mt-2 block space-y-2">
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Analytics</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Engagement</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Security</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Integrations</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Automations</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Watch
                                            demo</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Contact
                                            sales</a>
                                    </el-disclosure>
                                </div> --}}

                                <a href="{{ route('home') }}"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Home</a>
                                <a href="{{ route('gallery') }}"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Galeri
                                    Barang</a>

                                {{-- <div class="-mx-3">
                                    <button type="button" command="--toggle" commandfor="company"
                                        class="flex w-full items-center justify-between rounded-lg py-2 pr-3.5 pl-3 text-base/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">
                                        Company
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon"
                                            aria-hidden="true" class="size-5 flex-none in-aria-expanded:rotate-180">
                                            <path
                                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                                clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <el-disclosure id="company" hidden class="mt-2 block space-y-2">
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">About
                                            us</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Careers</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Support</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Press</a>
                                        <a href="#"
                                            class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Blog</a>
                                    </el-disclosure>
                                </div> --}}
                            </div>
                            <div class="py-6">
                                <a href="{{ route('login') }}"
                                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-white/5">Log
                                    in</a>
                            </div>
                        </div>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>
</header>
