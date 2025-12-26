<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">

            {{-- 1. DASHBOARD (Umum) --}}
            @can('is-all')
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navlist.item>

                <flux:navlist.item icon="inbox" :href="route('inbox')" :current="request()->routeIs('inbox')"
                    wire:navigate class="hidden lg:flex justify-between items-center w-full">
                    <div class="flex items-center w-full justify-between">
                        <span>{{ __('Kotak Masuk') }}</span>

                        {{-- Badge Desktop (Hanya muncul di Laptop) --}}
                        @php
                            $unread = \App\Models\Notification::where('user_id', auth()->id())
                                ->where('is_read', false)
                                ->count();
                        @endphp
                        @if ($unread > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                                {{ $unread > 9 ? '9+' : $unread }}
                            </span>
                        @endif
                    </div>
                </flux:navlist.item>
            @endcan

            {{-- 2. GROUP: MAHASISWA (Personal) --}}
            @can('is-mahasiswa')
                <flux:separator class="my-2" />

                <flux:navlist.group :heading="__('Aktivitas Saya')" class="grid">
                    <flux:navlist.item icon="document-text" :href="route('reportMhs')"
                        :current="request()->routeIs('reportMhs')" wire:navigate>
                        {{ __('Laporan Penemuan') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="question-mark-circle" :href="route('myLostItems')"
                        :current="request()->routeIs('myLostItems')" wire:navigate>
                        {{ __('Laporan Kehilangan') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            @endcan

            {{-- 3. GROUP: OPERASIONAL (Keamanan & Superadmin) --}}
            @can('is-keamanan-superadmin')
                <flux:separator class="my-2" />

                <flux:navlist.group :heading="__('Panel Operasional')" class="grid">
                    <flux:navlist.item icon="archive-box" :href="route('foundItems')"
                        :current="request()->routeIs('foundItems')" wire:navigate>
                        {{ __('Data Barang') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="clipboard-document-list" :href="route('reportManager')"
                        :current="request()->routeIs('reportManager')" wire:navigate>
                        {{ __('Laporan Masuk') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="exclamation-triangle" :href="route('admin.lostItems')"
                        :current="request()->routeIs('admin.lostItems')" wire:navigate>
                        {{ __('Laporan Kehilangan') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="megaphone" :href="route('announcements')"
                        :current="request()->routeIs('announcements')" wire:navigate>
                        {{ __('Pengumuman') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            @endcan

            {{-- 4. GROUP: SYSTEM & SETTINGS (Superadmin Only) --}}
            @can('is-superadmin')
                <flux:separator class="my-2" />

                <flux:navlist.group :heading="__('Sistem & Master Data')" class="grid">
                    <flux:navlist.item icon="users" :href="route('users')" :current="request()->routeIs('users')"
                        wire:navigate>
                        {{ __('Users') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="tag" :href="route('kategori')" :current="request()->routeIs('kategori')"
                        wire:navigate>
                        {{ __('Kategori Barang') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="computer-desktop" :href="route('admin.settings.images')"
                        :current="request()->routeIs('admin.settings.images')" wire:navigate>
                        {{ __('Setting Website') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="chat-bubble-bottom-center-text" :href="route('admin.feedback')"
                        :current="request()->routeIs('admin.feedback')" wire:navigate>
                        {{ __('Feedback') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            @endcan

        </flux:navlist>
        <flux:spacer />

        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                {{-- === MULAI KODE BADGE === --}}
                                @php
                                    $pts = auth()->user()->trust_points ?? 0;
                                    $badge = 'Warga Baru';
                                    // Tambahkan dark mode style
                                    $color = 'bg-gray-100 text-gray-600 dark:bg-zinc-700 dark:text-gray-300';

                                    if ($pts >= 50) {
                                        $badge = 'Teman Baik';
                                        $color = 'bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-300';
                                    }
                                    if ($pts >= 100) {
                                        $badge = 'Pahlawan Kampus';
                                        $color =
                                            'bg-indigo-100 text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-300';
                                    }
                                    if ($pts >= 200) {
                                        $badge = 'Legend';
                                        $color =
                                            'bg-purple-100 text-purple-600 dark:bg-purple-900/50 dark:text-purple-300';
                                    }
                                @endphp

                                <div class="flex items-center gap-2 mt-1 mb-0.5">
                                    <span
                                        class="text-[10px] font-bold text-yellow-600 dark:text-yellow-400 flex items-center gap-0.5">
                                        ⭐ {{ $pts }}
                                    </span>
                                    <span class="text-[10px] px-1.5 py-0.5 rounded-md font-medium {{ $color }}">
                                        {{ $badge }}
                                    </span>
                                </div>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <div class="">
            @livewire('notification-bell')
        </div>

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                {{-- === MULAI KODE BADGE === --}}
                                @php
                                    $pts = auth()->user()->trust_points ?? 0;
                                    $badge = 'Warga Baru';
                                    // Tambahkan dark mode style
                                    $color = 'bg-gray-100 text-gray-600 dark:bg-zinc-700 dark:text-gray-300';

                                    if ($pts >= 50) {
                                        $badge = 'Teman Baik';
                                        $color = 'bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-300';
                                    }
                                    if ($pts >= 100) {
                                        $badge = 'Pahlawan Kampus';
                                        $color =
                                            'bg-indigo-100 text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-300';
                                    }
                                    if ($pts >= 200) {
                                        $badge = 'Legend';
                                        $color =
                                            'bg-purple-100 text-purple-600 dark:bg-purple-900/50 dark:text-purple-300';
                                    }
                                @endphp

                                <div class="flex items-center gap-2 mt-1 mb-0.5">
                                    <span
                                        class="text-[10px] font-bold text-yellow-600 dark:text-yellow-400 flex items-center gap-0.5">
                                        ⭐ {{ $pts }}
                                    </span>
                                    <span class="text-[10px] px-1.5 py-0.5 rounded-md font-medium {{ $color }}">
                                        {{ $badge }}
                                    </span>
                                </div>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts

    @livewireScripts
    @if (session('toast'))
        <script>
            document.addEventListener('livewire:navigated', () => {
                setTimeout(() => {
                    Livewire.dispatch('show-toast', {
                        type: '{{ session('toast')['type'] }}',
                        message: '{{ session('toast')['message'] }}'
                    });
                }, 100);
            }, {
                once: true
            });
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>
