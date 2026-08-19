const CACHE_NAME = 'billpams-pwa-v2';

self.addEventListener('install', event => {
    self.skipWaiting();
});

self.addEventListener('activate', event => {
    event.waitUntil(clients.claim());
});

self.addEventListener('fetch', event => {
    // Network-only strategy untuk menghindari konflik dengan Laravel Livewire
    // Browser butuh ada fetch event agar tombol Install PWA muncul
    return;
});
