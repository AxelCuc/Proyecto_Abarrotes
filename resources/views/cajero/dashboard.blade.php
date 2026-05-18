<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Abarrotes Central</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden font-sans text-gray-800">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-full shrink-0">
        <div>
            <div class="p-6 pb-8">
                <h1 class="text-xl font-bold text-[#0f763e]">Abarrotes Central</h1>
                <p class="text-xs text-gray-400 font-medium">Terminal #01</p>
            </div>

            <nav class="px-4 space-y-2">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-[#f26522] text-white rounded-xl font-semibold shadow-sm shadow-orange-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Inicio
                </a>

                <a href="{{ route('cajero.ventas.create') }}" 
   class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
    </svg>
    Registrar Venta
</a>


                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Inventario
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Mis Ventas
                </a>
            </nav>
        </div>

        <div class="p-6 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
        class="w-full bg-[#0f763e] text-white py-3.5 rounded-xl font-bold hover:bg-[#0c6132] transition-colors shadow-md shadow-green-100">
        Cerrar Turno
    </button>
</form>

        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-y-auto">
        
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shrink-0">
            <div>
                <h2 class="text-base font-bold text-[#0f763e]">Terminal #01</h2>
                <p class="text-xs text-gray-400">Cajero: Juan Pérez</p>
            </div>
            <div></div>
        </header>

        <div class="p-8 max-w-6xl w-full space-y-8">
            
            <div>
                <h2 class="text-3xl font-bold text-gray-900">¡Buen día, Juan!</h2>
                <p class="text-gray-500 mt-1 font-medium">¿Qué vamos a despachar hoy?</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 bg-[#0f763e] rounded-[32px] p-10 text-white relative overflow-hidden flex flex-col justify-center shadow-sm">
                    <div class="absolute -right-8 -bottom-8 opacity-20">
                        <svg class="w-64 h-64" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>

                    <div class="relative z-10 max-w-xs">
                        <svg class="w-10 h-10 mb-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-3xl font-bold mb-2">Registrar Venta</h3>
                        <p class="text-green-100 mb-8 text-sm leading-relaxed">Inicia una nueva transacción de forma rápida y sencilla.</p>
                        
                        <a href="#" class="inline-flex items-center gap-2 font-bold hover:text-green-200 transition-colors">
                            Empezar ahora
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <a href="#" class="bg-gray-100 hover:bg-gray-200 transition-colors rounded-[32px] flex-1 flex flex-col items-center justify-center p-6 text-gray-900 font-bold text-xl gap-4">
                        <svg class="w-8 h-8 text-[#f26522]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Inventario
                    </a>
                    <a href="#" class="bg-gray-100 hover:bg-gray-200 transition-colors rounded-[32px] flex-1 flex flex-col items-center justify-center p-6 text-gray-900 font-bold text-xl gap-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Mis Ventas
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <div class="bg-white rounded-[32px] p-8 shadow-sm border border-gray-100 flex items-center gap-6">
                    <div class="w-20 h-20 rounded-full bg-orange-50 flex items-center justify-center shrink-0">
                        <svg class="w-10 h-10 text-[#f26522]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Resumen: Ventas del día</p>
                        <div class="flex items-baseline gap-3 mb-1">
                            <h3 class="text-4xl font-black text-gray-900">$4,250.00</h3>
                            <span class="text-xs font-bold text-[#0f763e]">+12% vs ayer</span>
                        </div>
                        <p class="text-sm text-gray-500 font-medium">34 transacciones completadas hoy</p>
                    </div>
                </div>

                <div class="bg-white rounded-[32px] p-8 shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            Stock Bajo
                        </h3>
                        <a href="#" class="text-sm font-bold text-[#0f763e] hover:underline">Ver todo</a>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-4 rounded-2xl border-l-4 border-l-red-500 border border-gray-100 bg-red-50/20">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-red-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    </svg>
                                </div>
                                <span class="font-bold text-gray-800">Leche Entera 1L</span>
                            </div>
                            <span class="bg-red-500 text-white text-[10px] font-black px-3 py-1.5 rounded-full tracking-wide">5 PZS</span>
                        </div>
                        
                        <div class="flex justify-between items-center p-4 rounded-2xl border-l-4 border-l-red-500 border border-gray-100 bg-red-50/20">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-red-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                    </svg>
                                </div>
                                <span class="font-bold text-gray-800">Frijol Negro 1kg</span>
                            </div>
                            <span class="bg-red-500 text-white text-[10px] font-black px-3 py-1.5 rounded-full tracking-wide">2 PZS</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>