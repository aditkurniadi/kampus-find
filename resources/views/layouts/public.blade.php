<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Kampus - Find' }}</title>

    @include('partials.head')
    {{-- @tailwindplus/elements --}}

    @livewireStyles
</head>

<body class="h-full">

    @include('partials.header')
    <main>
        {{ $slot }}
    </main>
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    @livewireScripts
</body>

</html>
