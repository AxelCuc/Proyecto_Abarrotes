<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrador - Abarrotes Don Pepe</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#e9f2ee] min-h-screen flex items-center justify-center font-sans p-4 relative overflow-hidden">

    <div class="absolute bg-[#d5e5df] w-[500px] h-[600px] rounded-[100px] rotate-12 -z-10"></div>

    <div class="bg-white w-full max-w-[480px] rounded-[40px] shadow-2xl p-8 md:p-12">
        
        <div class="flex justify-center mb-6">
            <div class="bg-orange-500 p-4 rounded-2xl shadow-lg shadow-orange-200">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
        </div>

        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Panel de Control</h1>
            <p class="text-gray-500 font-medium">Inicia sesión para gestionar inventario y reportes.</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo Electrónico</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </span>
                    <input type="email" name="email" id="email" required
                        class="block w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder:text-gray-300"
                        placeholder="admin@donpepe.com" value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <label for="password" class="text-sm font-semibold text-gray-700">Contraseña</label>
                    <a href="#" class="text-sm font-medium text-gray-400 hover:text-green-600 transition-colors">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" required
                        class="block w-full pl-12 pr-12 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder:text-gray-300"
                        placeholder="••••••••••••">
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" 
                    class="w-5 h-5 text-green-600 border-gray-200 rounded focus:ring-green-500">
                <label for="remember" class="ml-3 text-sm font-medium text-gray-500">Mantener sesión iniciada</label>
            </div>

            <button type="submit" 
                class="w-full bg-[#005a32] text-white py-4 rounded-2xl font-bold flex items-center justify-center gap-3 hover:bg-[#004a29] transition-all shadow-xl shadow-green-100 group">
                Entrar al Panel
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </button>
        </form>

        <div class="mt-12 flex justify-center items-center gap-2 text-gray-400 font-medium text-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            Acceso Administrativo Seguro
        </div>
    </div>

</body>
</html>