<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-battambang antialiased">
    <div class="min-h-screen bg-white">
        <livewire:layout.navigation />
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white flex justify-center items-center max-w-3xl mx-auto p-4">
                <div class=" flex px-4 sm:px-6 lg:px-8 justify-between w-full" x-data="{ back() { window.history.back(); } }">
                    {{-- back to previous --}}
                    <x-back click="back()" />
                    {{-- header title --}}
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $header }}
                    </h2>
                    {{-- hidden --}}
                    <div class="opacity-0">
                        ត្រឡប់ក្រោយ
                    </div>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="px-4">
            {{ $slot }}
        </main>
        @isset($buttom)
            {{ $buttom }}
        @endisset

    </div>
</body>

</html>
