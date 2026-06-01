<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cajero Login - Abarrotes Don Pepe</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f0f4f8] min-h-screen flex items-center justify-center font-sans p-4 relative overflow-hidden">

    <div class="absolute bg-[#d1e3f0] w-[500px] h-[600px] rounded-[100px] -rotate-12 -z-10 -left-10"></div>

    <div class="bg-white w-full max-w-[480px] rounded-[40px] shadow-2xl p-8 md:p-12 border border-blue-50">
        
        <div class="flex justify-center mb-6">
            <div class="bg-blue-600 p-4 rounded-2xl shadow-lg shadow-blue-200">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>

        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Punto de Venta</h1>
            <p class="text-gray-500 font-medium">Acceso para Cajeros y Atención al Cliente</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo del Cajero</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </span>
                    <input type="email" name="email" id="email" required
                        class="block w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-gray-300"
                        placeholder="cajero@donpepe.com" value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <label for="password" class="text-sm font-semibold text-gray-700">Contraseña</label>
                    <a href="#" class="text-sm font-medium text-gray-400 hover:text-blue-600 transition-colors">¿Olvidaste?</a>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" required
                        class="block w-full pl-12 pr-12 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-gray-300"
                        placeholder="••••••••••••">
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" 
                    class="w-5 h-5 text-blue-600 border-gray-200 rounded focus:ring-blue-500">
                <label for="remember" class="ml-3 text-sm font-medium text-gray-500">Recordar mi sesión</label>
            </div>

            <button type="submit" 
                class="w-full bg-[#1e40af] text-white py-4 rounded-2xl font-bold flex items-center justify-center gap-3 hover:bg-[#1e3a8a] transition-all shadow-xl shadow-blue-100 group">
                Abrir Caja
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </button>
        </form>

        <div class="mt-12 flex justify-center items-center gap-2 text-gray-400 font-medium text-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Módulo de Ventas Protegido
        </div>
    </div>

</body>
</html>