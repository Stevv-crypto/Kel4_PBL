<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    @stack('styles')
    @livewireStyles

    <title>@yield('title', 'E-TechnoCart')</title>
</head>

<body class="font-sans bg-white">
    <div class="relative">
        @if(!isset($noHeader))
            @include('components.pembeli.header')
        @endif

        <div class="container mx-auto px-4 py-8">
            {{ $slot ?? '' }}

            @yield('content')
        </div>

        @include('components.pembeli.footer')
    </div>

    @stack('scripts')
    @livewireScripts

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>