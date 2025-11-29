import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

// Tentukan apakah kita menggunakan HTTPS di domain ini
const isSecure = window.location.protocol === 'https:';

window.Echo = new Echo({
    // 1. Ganti Driver ke Pusher
    broadcaster: 'pusher',
    
    // 2. Gunakan Variabel PUSHER
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    
    // 3. Protokol (Memaksa WSS jika domain adalah HTTPS)
    forceTLS: isSecure, 
    encrypted: true, // Wajib jika forceTLS: true
    scheme: isSecure ? 'wss' : 'ws', 

    // Opsi standar
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Accept': 'application/json',
        },
    },
    enabledTransports: ['ws', 'wss'],
});