<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-900 dark">

<head>
    @include('partials.head')
</head>

<body class="h-full">

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
</body>

</html>
