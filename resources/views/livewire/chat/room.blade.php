<div class="flex flex-col w-full h-[calc(100vh-5rem)] bg-gray-50 dark:bg-zinc-900 rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-zinc-800"
    x-data="{ showImageModal: false, selectedImage: '' }">

    {{-- ========================================== --}}
    {{-- 1. HEADER CHAT (STICKY)                    --}}
    {{-- ========================================== --}}
    <div
        class="flex-none bg-white dark:bg-zinc-800 px-6 py-4 border-b border-gray-200 dark:border-zinc-700 flex justify-between items-center z-10 shadow-sm">
        <div class="flex items-center gap-4">
            {{-- Icon Avatar Barang --}}
            <div
                class="flex h-11 w-11 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-300 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <div>
                <h2 class="font-bold text-lg text-gray-900 dark:text-white leading-tight">
                    {{ $lostItem->item_name }}
                </h2>
                <div class="flex items-center gap-2 mt-0.5">
                    @if ($lostItem->status == 'ditemukan')
                        <span class="relative flex h-2 w-2">
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        <p class="text-xs text-green-600 dark:text-green-400 font-bold uppercase tracking-wide">
                            Ditemukan</p>
                    @elseif($lostItem->status == 'dicari')
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                        </span>
                        <p class="text-xs text-yellow-600 dark:text-yellow-400 font-bold uppercase tracking-wide">Sedang
                            Dicari</p>
                    @else
                        <span class="h-2 w-2 rounded-full bg-gray-400"></span>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wide">{{ $lostItem->status }}</p>
                    @endif
                </div>
            </div>
        </div>

        @php
            // Logika Link Kembali berdasarkan Role
            $backRoute = route('myLostItems'); // Default untuk Mahasiswa

            if (in_array(auth()->user()->role, ['superadmin', 'keamanan'])) {
                $backRoute = route('admin.lostItems'); // Khusus Admin/Keamanan
            }
        @endphp

        <a href="{{ $backRoute }}"
            class="group flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 transition bg-gray-100 dark:bg-zinc-700/50 px-4 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-zinc-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-4 h-4 transition-transform group-hover:-translate-x-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- ========================================== --}}
    {{-- 2. AREA CHAT (SCROLLABLE)                  --}}
    {{-- ========================================== --}}
    <div id="chat-container"
        class="flex-1 min-h-0 overflow-y-auto p-4 sm:p-6 space-y-6 bg-[#f0f2f5] dark:bg-[#0b0b0b] relative scroll-smooth"
        x-data="{
            scrollBottom() {
                const container = this.$el;
                setTimeout(() => {
                    container.scrollTop = container.scrollHeight;
                }, 100);
            }
        }" x-init="scrollBottom()" @chat-scroll.window="scrollBottom()">

        {{-- Background Pattern (Titik-titik halus) --}}
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05] pointer-events-none"
            style="background-image: radial-gradient(#6366f1 1px, transparent 1px); background-size: 24px 24px;">
        </div>

        @foreach ($messages as $msg)
            @php
                $isMe = $msg['sender_id'] === auth()->id();

                // LOGIKA NAMA ADMIN
                // Pastikan role user tersedia di array sender.
                // Jika sender adalah superadmin/keamanan, kita samarkan namanya.
                $senderRole = $msg['sender']['role'] ?? 'mahasiswa';
                $senderName = $msg['sender']['name'];

                if (in_array($senderRole, ['superadmin', 'keamanan'])) {
                    $senderName = 'Admin Kampus';
                }

                // Deteksi apakah ini pesan auto-send (info barang)
                $isAutoMessage = str_contains($msg['message'] ?? '', '📋 Informasi Barang Hilang');
            @endphp

            <div class="flex w-full {{ $isMe ? 'justify-end' : 'justify-start' }} relative z-0 group">
                <div class="flex max-w-[85%] md:max-w-[70%] flex-col {{ $isMe ? 'items-end' : 'items-start' }}">

                    {{-- Nama Pengirim (Hanya muncul jika pesan dari orang lain) --}}
                    @if (!$isMe)
                        <span
                            class="text-[11px] font-bold mb-1 ml-1 {{ $senderName == 'Admin Kampus' ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-500 dark:text-gray-400' }}">
                            {{ $senderName }}
                            @if ($senderName == 'Admin Kampus')
                                {{-- Icon Centang Biru untuk Admin --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-3 h-3 inline-block -mt-0.5 ml-0.5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </span>
                    @endif

                    {{-- Bubble Chat --}}
                    <div
                        class="px-4 py-2.5 shadow-sm text-[15px] leading-relaxed break-words relative transition-all
                        {{ $isMe
                            ? 'bg-indigo-600 text-white rounded-2xl rounded-tr-none'
                            : 'bg-white dark:bg-zinc-800 dark:text-gray-100 text-gray-800 rounded-2xl rounded-tl-none border border-gray-100 dark:border-zinc-700' }}
                        {{ $isAutoMessage ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800' : '' }}">

                        {{-- Gambar (jika ada) --}}
                        @if (!empty($msg['image_path']))
                            <div class="mb-2 rounded-lg overflow-hidden">
                                <button type="button"
                                    @click="showImageModal = true; selectedImage = '{{ asset('storage/' . $msg['image_path']) }}'"
                                    class="block w-full">
                                    <img src="{{ asset('storage/' . $msg['image_path']) }}" alt="Gambar chat"
                                        class="max-w-full h-auto max-h-64 rounded-lg object-cover cursor-pointer hover:opacity-90 transition-opacity">
                                </button>
                            </div>
                        @endif

                        {{-- Pesan Teks (jika ada) --}}
                        @if (!empty($msg['message']))
                            @if ($isAutoMessage)
                                {{-- Styling khusus untuk pesan auto-send --}}
                                <div class="text-sm leading-relaxed space-y-1.5">
                                    @php
                                        $lines = explode("\n", $msg['message']);
                                    @endphp
                                    @foreach ($lines as $line)
                                        @php
                                            $line = trim($line);
                                        @endphp
                                        @if (empty($line))
                                            <div class="h-1"></div>
                                        @elseif (str_contains($line, '━━'))
                                            <div
                                                class="border-t {{ $isMe ? 'border-indigo-400' : 'border-gray-300 dark:border-gray-600' }} my-2">
                                            </div>
                                        @elseif (str_contains($line, ':'))
                                            @php
                                                $parts = explode(':', $line, 2);
                                                $label = trim($parts[0] ?? '');
                                                $value = trim($parts[1] ?? '');
                                            @endphp
                                            @if ($label && $value)
                                                <div>
                                                    <span
                                                        class="font-semibold {{ $isMe ? 'text-indigo-200' : 'text-blue-600 dark:text-blue-400' }}">{{ $label }}:</span>
                                                    <span
                                                        class="ml-1 {{ $isMe ? 'text-white' : 'text-gray-700 dark:text-gray-300' }}">{{ $value }}</span>
                                                </div>
                                            @else
                                                <div
                                                    class="{{ $isMe ? 'text-white' : 'text-gray-700 dark:text-gray-300' }}">
                                                    {{ $line }}</div>
                                            @endif
                                        @else
                                            <div
                                                class="{{ $isMe ? 'text-white' : 'text-gray-700 dark:text-gray-300' }}">
                                                {{ $line }}</div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="whitespace-pre-wrap">{{ $msg['message'] }}</div>
                            @endif
                        @endif

                        {{-- Time Stamp --}}
                        <div class="flex justify-end items-center gap-1 mt-1 select-none opacity-80">
                            <span class="text-[10px] {{ $isMe ? 'text-indigo-100' : 'text-gray-400' }}">
                                {{ \Carbon\Carbon::parse($msg['created_at'])->format('H:i') }}
                            </span>
                            @if ($isMe)
                                {{-- Icon Read Check (Double Tick) --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-3 h-3 {{ $msg['is_read'] ? 'text-blue-300' : 'text-indigo-400' }}">
                                    <path fill-rule="evenodd"
                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Script untuk Auto-Scroll --}}
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.hook('morph.updated', ({
                el,
                component
            }) => {
                // Scroll ke bawah setelah Livewire update
                const chatContainer = document.getElementById('chat-container');
                if (chatContainer) {
                    setTimeout(() => {
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }, 100);
                }
            });
        });

        // Event listener untuk chat-scroll
        window.addEventListener('chat-scroll', () => {
            const chatContainer = document.getElementById('chat-container');
            if (chatContainer) {
                setTimeout(() => {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }, 100);
            }
        });

        // ===== PUSHER REAL-TIME LISTENER =====
        if (window.Echo) {
            Echo.private('chat.{{ $lostItem->id }}')
                .listen('MessageSent', (data) => {
                    console.log('Pesan baru dari Pusher:', data);
                    // Refresh component Livewire
                    @this.dispatch('refreshMessages');
                })
                .error((error) => {
                    console.error('Pusher error:', error);
                });
        } else {
            console.warn('Echo/Pusher belum tersedia');
        }
    </script>

    {{-- ========================================== --}}
    {{-- 3. INPUT CHAT & QUICK REPLIES              --}}
    {{-- ========================================== --}}
    @php
        $isAdmin = in_array(auth()->user()->role, ['superadmin', 'keamanan']);
    @endphp
    <div class="flex-none bg-white dark:bg-zinc-800 p-4 border-t border-gray-200 dark:border-zinc-700 relative z-20"
        x-data="{
            msg: @entangle('newMessage'),
            showTemplates: false,
            isAdmin: {{ $isAdmin ? 'true' : 'false' }},
            // DAFTAR TEMPLATE ADMIN
            templates: [
                { label: '👋 Salam Pembuka', text: 'Halo, selamat siang. Ada yang bisa kami bantu terkait laporan ini?' },
                { label: '❓ Tanya Ciri-ciri', text: 'Bisa sebutkan ciri-ciri spesifik lainnya agar kami bisa memverifikasi?' },
                { label: '📍 Lokasi Pengambilan', text: 'Barang Anda sudah kami amankan. Silakan diambil di Pos Satpam Utama.' },
                { label: '🆔 Syarat Pengambilan', text: 'Mohon bawa KTM/KTP sebagai bukti kepemilikan saat pengambilan.' },
                { label: '✅ Konfirmasi Selesai', text: 'Terima kasih. Laporan ini akan kami tandai sebagai selesai.' }
            ],
            checkInput() {
                // Trigger template jika ketik '/' dan user adalah admin
                if (this.isAdmin && this.msg && this.msg.endsWith('/')) {
                    this.showTemplates = true;
                } else {
                    this.showTemplates = false;
                }
            },
            selectTemplate(text) {
                // Hapus '/' terakhir dan ganti dengan template
                this.msg = this.msg.replace(/\/$/, '') + text;
                this.showTemplates = false;
                $refs.chatInput.focus();
            }
        }">

        {{-- POPUP TEMPLATE (Hanya muncul jika showTemplates = true DAN user adalah admin) --}}
        @if ($isAdmin)
            <div x-show="showTemplates && isAdmin" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
                class="absolute bottom-24 left-4 right-4 md:left-auto md:right-auto md:w-96 bg-white dark:bg-zinc-900 rounded-xl shadow-2xl border border-gray-200 dark:border-zinc-700 overflow-hidden z-50">

                <div
                    class="px-4 py-2 bg-gray-50 dark:bg-zinc-800 border-b border-gray-200 dark:border-zinc-700 text-xs font-bold text-gray-500 uppercase tracking-wide flex justify-between items-center">
                    <span>Balasan Cepat</span>
                    <span class="text-[10px] bg-gray-200 dark:bg-zinc-700 px-1.5 py-0.5 rounded text-gray-500">ESC to
                        close</span>
                </div>

                <ul class="max-h-60 overflow-y-auto">
                    <template x-for="tpl in templates">
                        <li @click="selectTemplate(tpl.text)"
                            class="px-4 py-3 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 cursor-pointer border-b border-gray-100 dark:border-zinc-800 last:border-0 transition-colors group">
                            <p class="text-sm font-bold text-gray-800 dark:text-gray-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400"
                                x-text="tpl.label"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate" x-text="tpl.text"></p>
                        </li>
                    </template>
                </ul>
            </div>
        @endif

        {{-- FORM INPUT --}}
        <form wire:submit="sendMessage" class="relative flex items-center gap-3 max-w-7xl mx-auto"
            enctype="multipart/form-data">

            {{-- Tombol Upload Foto --}}
            <label for="image-upload"
                class="p-2 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition bg-gray-100 dark:bg-zinc-900 rounded-full cursor-pointer"
                title="Unggah Foto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <input type="file" id="image-upload" wire:model="image" accept="image/*" class="hidden">
            </label>

            {{-- Preview Gambar yang Dipilih --}}
            @if ($image)
                <div
                    class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-zinc-700 px-3 py-1.5 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span class="truncate max-w-[120px]">{{ $image->getClientOriginalName() }}</span>
                    <button type="button" wire:click="$set('image', null)"
                        class="text-red-500 hover:text-red-700 font-bold text-lg leading-none">×</button>
                </div>
            @endif

            {{-- Tombol '/' Trigger Manual (Hanya untuk Admin) --}}
            @if ($isAdmin)
                <button type="button" @click="msg += '/'; checkInput(); $refs.chatInput.focus()"
                    class="p-2 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition bg-gray-100 dark:bg-zinc-900 rounded-full"
                    title="Gunakan Template (/)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>
                </button>
            @endif

            <div class="relative flex-1">
                <input x-ref="chatInput" x-model="msg" @input="checkInput()"
                    @keydown.escape="showTemplates = false" type="text"
                    class="w-full pl-5 pr-4 py-3 bg-gray-100 dark:bg-zinc-900 border-0 rounded-full text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:bg-white dark:focus:bg-zinc-900 transition-all shadow-sm"
                    placeholder="{{ $isAdmin ? 'Ketik pesan... (Gunakan \'/\' untuk template)' : 'Ketik pesan...' }}">
            </div>

            <button type="submit"
                class="p-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow-lg hover:shadow-indigo-500/30 transition-all active:scale-95 flex items-center justify-center"
                :disabled="!msg && !$wire.image">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-5 h-5 translate-x-0.5 -translate-y-0.5">
                    <path
                        d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                </svg>
            </button>
        </form>
    </div>

    {{-- Modal untuk Menampilkan Gambar Besar --}}
    <div x-show="showImageModal" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click.self="showImageModal = false"
        @keydown.escape.window="showImageModal = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
        style="display: none;">

        {{-- Container Gambar --}}
        <div class="relative max-w-7xl max-h-[90vh] w-full h-full flex items-center justify-center">
            {{-- Tombol Close --}}
            <button @click="showImageModal = false"
                class="absolute top-4 right-4 z-10 p-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full text-white transition-all hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Gambar --}}
            <img :src="selectedImage" alt="Preview gambar"
                class="max-w-full max-h-[90vh] w-auto h-auto object-contain rounded-lg shadow-2xl" @click.stop>
        </div>
    </div>

    {{-- Script untuk Auto-Scroll --}}
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.hook('morph.updated', ({
                el,
                component
            }) => {
                // Scroll ke bawah setelah Livewire update
                const chatContainer = document.getElementById('chat-container');
                if (chatContainer) {
                    setTimeout(() => {
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }, 100);
                }
            });
        });

        // Event listener untuk chat-scroll
        window.addEventListener('chat-scroll', () => {
            const chatContainer = document.getElementById('chat-container');
            if (chatContainer) {
                setTimeout(() => {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }, 100);
            }
        });

        // ===== PUSHER REAL-TIME LISTENER =====
        if (window.Echo) {
            Echo.private('chat.{{ $lostItem->id }}')
                .listen('MessageSent', (data) => {
                    console.log('Pesan baru dari Pusher:', data);
                    // Refresh component Livewire
                    @this.dispatch('refreshMessages');
                })
                .error((error) => {
                    console.error('Pusher error:', error);
                });
        } else {
            console.warn('Echo/Pusher belum tersedia');
        }
    </script>

</div>
