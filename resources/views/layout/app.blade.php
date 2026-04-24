<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-white h-screen flex flex-col">
    <x-navbar />
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex-1 overflow-y-auto h-full">
        @yield('content')
    </main>
    <x-footer />
    @stack('js')
</body>
</html>