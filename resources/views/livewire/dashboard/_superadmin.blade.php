<div>
    <x-slot:title>
        Dashboard Admin - {{ config('app.name') }}
    </x-slot:title>

    <div class="flex h-full w-full flex-1 flex-col gap-6">

        {{-- ========================================== --}}
        {{-- SECTION 1: STATISTIK UTAMA (4 KARTU)       --}}
        {{-- ========================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- KARTU 1: TOTAL USERS --}}
            <div
                class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pengguna</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- KARTU 2: TOTAL BARANG --}}
            <div
                class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Barang</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalFound }}</p>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-purple-50 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- KARTU 3: KEMBALI HARI INI --}}
            <div
                class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kembali Hari Ini</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $returnedToday }}</p>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-green-50 text-green-600 dark:bg-green-900/20 dark:text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- KARTU 4: RATING WEBSITE --}}
            <div
                class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Rating Website</p>
                        <div class="mt-2 flex items-baseline gap-2">
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $averageRating }}</p>
                            <span class="text-sm text-gray-500">/ 5.0</span>
                        </div>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-yellow-50 text-yellow-600 dark:bg-yellow-900/20 dark:text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <flux:button wire:click="confirmMaintenanceToggle" variant="{{ $isMaintenanceOn ? 'danger' : 'filled' }}"
                icon="{{ $isMaintenanceOn ? 'lock-open' : 'lock-closed' }}"
                class="w-full justify-start {{ $isMaintenanceOn ? 'bg-red-600 hover:bg-red-700 text-white' : '' }}">
                {{ $isMaintenanceOn ? 'Matikan Maintenance' : 'Aktifkan Maintenance' }}
            </flux:button>

        </div>


        {{-- ========================================== --}}
        {{-- SECTION 2: GRAFIK & VISUALISASI            --}}
        {{-- ========================================== --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- GRAFIK AREA (Lebar 2 Kolom) --}}
            <div
                class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800 lg:col-span-2">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tren Aktivitas</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Statistik laporan masuk vs barang kembali (7
                            Hari)</p>
                    </div>
                </div>
                <div class="relative h-80 w-full" wire:ignore>
                    <div id="activityChart" class="h-full w-full"></div>
                </div>
            </div>

            {{-- CHART DONAT + AKSI CEPAT (Lebar 1 Kolom) --}}
            <div class="flex flex-col gap-6">

                {{-- Donut Chart --}}
                <div
                    class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
                    <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Sebaran Kategori</h3>
                    <div class="flex h-64 items-center justify-center" wire:ignore>
                        @if (empty($chartPieSeries))
                            <p class="text-sm text-gray-400 italic">Belum ada data kategori.</p>
                        @else
                            <div id="categoryChart" class="w-full"></div>
                        @endif
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div
                    class="relative flex flex-col rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
                    <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Aksi Cepat</h3>
                    <div class="flex flex-col gap-3">
                        <flux:button href="{{ route('foundItems') }}" icon="plus" class="w-full justify-start">Tambah
                            Barang Temuan</flux:button>
                        <flux:button href="{{ route('announcements') }}" icon="megaphone" class="w-full justify-start">
                            Buat Pengumuman</flux:button>
                    </div>
                </div>
            </div>
        </div>


        {{-- ========================================== --}}
        {{-- SECTION 3: TABEL AKTIVITAS TERBARU         --}}
        {{-- ========================================== --}}
        <div
            class="overflow-hidden rounded-xl border border-neutral-200 bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
            <div
                class="flex items-center justify-between border-b border-neutral-200 px-6 py-4 dark:border-neutral-700">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Aktivitas Terbaru</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">5 laporan barang masuk terakhir.</p>
                </div>
                <flux:button href="{{ route('foundItems') }}" size="sm" icon="arrow-right" icon-trailing>Lihat
                    Semua</flux:button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead
                        class="bg-gray-50 text-xs font-medium uppercase text-gray-500 dark:bg-neutral-900/50 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">Pelapor</th>
                            <th class="px-6 py-3">Barang & Kategori</th>
                            <th class="px-6 py-3">Lokasi</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-right">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse($recentActivities as $item)
                            <tr class="transition hover:bg-gray-50 dark:hover:bg-neutral-700/50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-400">
                                            {{ substr($item->user->name ?? 'A', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">
                                                {{ $item->user->name ?? 'Anonim' }}</p>
                                            <p class="text-xs text-gray-500">{{ $item->user->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $item->item_name }}</p>
                                    <span
                                        class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 dark:bg-gray-700 dark:text-gray-300">
                                        {{ $item->category->name ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" class="h-4 w-4">
                                            <path fill-rule="evenodd"
                                                d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 0 0 .281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 1 0 3 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 0 0 2.273 1.765 11.842 11.842 0 0 0 .976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ Str::limit($item->location, 20) }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->status == 'selesai')
                                        <span
                                            class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-900/30 dark:text-green-400">Selesai
                                            / Kembali</span>
                                    @elseif($item->status == 'available')
                                        <span
                                            class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-900/30 dark:text-blue-400">Ditemukan</span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20 dark:bg-yellow-900/30 dark:text-yellow-500">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-xs text-gray-500">
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center italic text-gray-500">Belum ada
                                    aktivitas terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL KONFIRMASI PASSWORD --}}
        <flux:modal wire:model="confirmingMaintenance" class="min-w-[22rem]">
            <form wire:submit="toggleMaintenance" class="space-y-6">
                <div>
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-full {{ $isMaintenanceOn ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        <flux:icon name="{{ $isMaintenanceOn ? 'lock-open' : 'lock-closed' }}" class="h-6 w-6" />
                    </div>

                    <flux:heading size="lg">
                        {{ $isMaintenanceOn ? 'Matikan Mode Maintenance?' : 'Aktifkan Mode Maintenance?' }}
                    </flux:heading>

                    <flux:subheading class="mt-2">
                        @if ($isMaintenanceOn)
                            Website akan dapat diakses kembali oleh seluruh pengguna (Mahasiswa & Tamu).
                        @else
                            Website akan <strong>dikunci</strong>. Hanya Admin yang bisa mengakses dashboard. User lain
                            akan melihat halaman perbaikan.
                        @endif
                    </flux:subheading>
                </div>

                {{-- LOGIKA INPUT PASSWORD / GOOGLE --}}
                @if (empty(auth()->user()->google_id))
                    {{-- CASE 1: USER BIASA (Wajib Password) --}}
                    <flux:field>
                        <flux:label>Konfirmasi Password</flux:label>
                        <flux:input type="password" wire:model="passwordConfirmation"
                            placeholder="Masukkan password admin..." autofocus />
                        <flux:error name="passwordConfirmation" />
                    </flux:field>
                @else
                    {{-- CASE 2: USER GOOGLE (Bypass Password) --}}
                    <div
                        class="rounded-md bg-blue-50 p-4 border border-blue-100 dark:bg-blue-900/20 dark:border-blue-800">
                        <div class="flex">
                            <div class="shrink-0">
                                {{-- G Logo --}}
                                <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-bold text-blue-800 dark:text-blue-200">Verifikasi Akun Google
                                </h3>
                                <p class="mt-1 text-xs text-blue-700 dark:text-blue-300">
                                    Anda login sebagai <strong>{{ auth()->user()->name }}</strong> via Google. Tidak
                                    perlu password untuk konfirmasi.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex justify-end gap-2 pt-4">
                    <flux:button variant="ghost" wire:click="$set('confirmingMaintenance', false)">Batal</flux:button>

                    <flux:button type="submit" variant="{{ $isMaintenanceOn ? 'primary' : 'danger' }}">
                        {{ $isMaintenanceOn ? 'Ya, Matikan Sekarang' : 'Ya, Aktifkan Sekarang' }}
                    </flux:button>
                </div>
            </form>
        </flux:modal>

    </div>

    {{-- SCRIPT JAVASCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {

            // ================================================================
            // SOLUSI: Kosongkan dulu container chart sebelum render ulang
            // ================================================================
            document.querySelector("#activityChart").innerHTML = "";
            document.querySelector("#categoryChart").innerHTML = "";
            // ================================================================

            // --- CHART 1: AREA CHART ---
            const dates = @json($chartDates);
            const foundData = @json($chartFoundData);
            const solvedData = @json($chartSolvedData);

            const optionsArea = {
                // ... konfigurasi optionsArea sama seperti sebelumnya ...
                series: [{
                    name: 'Barang Ditemukan',
                    data: foundData
                }, {
                    name: 'Barang Kembali',
                    data: solvedData
                }],
                chart: {
                    type: 'area',
                    height: 320,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Inter, sans-serif',
                    background: 'transparent'
                },
                colors: ['#6366f1', '#22c55e'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    categories: dates,
                    labels: {
                        style: {
                            colors: '#9ca3af'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#9ca3af'
                        },
                        formatter: (val) => val.toFixed(0)
                    }
                },
                grid: {
                    borderColor: '#e5e7eb',
                    strokeDashArray: 4
                },
                theme: {
                    mode: document.documentElement.classList.contains('dark') ? 'dark' : 'light'
                }
            };
            const chart1 = new ApexCharts(document.querySelector("#activityChart"), optionsArea);
            chart1.render();

            // --- CHART 2: DONUT CHART ---
            const pieLabels = @json($chartPieLabels);
            const pieSeries = @json($chartPieSeries);

            // Cek agar tidak error jika data kosong
            const categoryChartEl = document.querySelector("#categoryChart");

            if (pieSeries.length > 0 && categoryChartEl) {
                const optionsPie = {
                    // ... konfigurasi optionsPie sama seperti sebelumnya ...
                    series: pieSeries,
                    labels: pieLabels,
                    chart: {
                        type: 'donut',
                        height: 250,
                        fontFamily: 'Inter, sans-serif',
                        background: 'transparent'
                    },
                    colors: ['#3b82f6', '#f59e0b', '#10b981', '#8b5cf6', '#ec4899'],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        color: '#9ca3af',
                                        formatter: (w) => w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            colors: '#9ca3af'
                        }
                    },
                    stroke: {
                        show: false
                    },
                    theme: {
                        mode: document.documentElement.classList.contains('dark') ? 'dark' : 'light'
                    }
                };
                const chart2 = new ApexCharts(categoryChartEl, optionsPie);
                chart2.render();
            }
        });
    </script>
</div>
