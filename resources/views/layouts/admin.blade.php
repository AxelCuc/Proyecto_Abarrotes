<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-green-700 text-white p-4">
            <h1 class="text-xl font-bold">Panel de Administración</h1>
        </header>

        <!-- Contenido principal -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 text-center p-4 text-sm text-gray-600">
            © {{ date('Y') }} Punto de Venta
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
