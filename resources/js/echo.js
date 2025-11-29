import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

// 1. Deteksi Lingkungan Lokal untuk Pengujian (WS vs WSS)
const isLocalhost = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';
const scheme = isLocalhost ? 'ws' : 'wss';

window.Echo = new Echo({
    // 2. Ganti Driver ke Pusher
    broadcaster: 'pusher', 
    
    // 3. Gunakan Variabel Pusher
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    
    // 4. Pengaturan Protokol (KRITIS)
    // Jika di localhost, forceTLS: false (koneksi tidak aman)
    forceTLS: !isLocalhost, 

    // Opsi tambahan untuk memastikan koneksi yang bersih
    encrypted: true, 
    // host dan port tidak perlu disetel jika cluster sudah disetel dan forceTLS disetel false/true dengan benar.

    // Auth settings (Tetap sama, ini sudah benar untuk Private Channel)
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Accept': 'application/json',
        },
    },
    enabledTransports: ['ws', 'wss'],
});