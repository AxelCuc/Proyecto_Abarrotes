<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navegación -->
    @include('layouts.navigation')

    <!-- Contenido principal -->
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
