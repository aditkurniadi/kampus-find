import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

// Tentukan apakah kita menggunakan HTTPS di domain ini
const isSecure = window.location.protocol === 'https:';

window.Echo = new Echo({
    broadcaster: 'pusher',
    
    // ❗ KRITIS: Pastikan variabel VITE_PUSHER_APP_KEY sudah didefinisikan di .env
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    
    // Protokol
    // Gunakan WSS (secure) jika domain saat ini adalah HTTPS.
    forceTLS: isSecure, 
    
    // Jika perlu, Anda bisa menambahkan opsi host eksplisit (optional, Pusher biasanya auto-resolve)
    // wsHost: 'ws-' + import.meta.env.VITE_PUSHER_APP_CLUSTER + '.pusher.com',

    encrypted: true, 
    enabledTransports: ['ws', 'wss'],
    
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Accept': 'application/json',
        },
    },
});