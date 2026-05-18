<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta - Abarrotes Central</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-full shrink-0">
        <div>
            <div class="p-6 pb-8 border-b border-gray-50 flex items-center justify-center flex-col text-center">
                <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-[#0f763e] mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-[#0f763e] leading-tight">Abarrotes Central</h1>
                <p class="text-xs text-gray-400 font-medium mt-1">Terminal #01</p>
            </div>

            <nav class="p-4 space-y-1.5">
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Inicio
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-green-50 text-[#0f763e] rounded-xl font-bold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Registrar Venta
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Inventario
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Mis Ventas
                </a>
            </nav>
        </div>

        <div class="p-6 border-t border-gray-100 space-y-4">
            <button class="w-full bg-[#0f763e] text-white py-3 rounded-xl font-bold hover:bg-[#0c6132] transition-colors shadow-md shadow-green-100 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Registrar Venta
            </button>

            <form method="POST" action="{{ route('logout') ?? '#' }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar Turno
                </button>
            </form>
        </div>
    </aside>

    <div class="w-60 bg-white border-r border-gray-200 flex flex-col h-full shrink-0">
        <div class="p-6 pb-2">
            <h2 class="text-xl font-bold text-gray-900">Categorías</h2>
        </div>
        <nav class="flex-1 overflow-y-auto p-4 space-y-1">
            <a href="#" class="flex items-center justify-between px-4 py-2.5 bg-[#0f763e] text-white rounded-lg font-semibold shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"></path></svg>
                    Todos
                </div>
                <span class="bg-white text-[#0f763e] text-[10px] font-black px-2 py-0.5 rounded-full">142</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                Alimentos
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Bebidas
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                Higiene
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                Limpieza
            </a>
        </nav>
    </div>

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-[#f8fafc]">
        
        <header class="bg-white border-b border-gray-200 h-[72px] px-8 flex justify-end items-center shrink-0">
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-800 leading-tight">Juan Pérez</p>
                    <p class="text-xs text-gray-500">Caja 01</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold border border-gray-200">
                    JP
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Todos los productos</h2>
                <div class="text-sm text-gray-500 flex items-center gap-2 cursor-pointer hover:text-gray-700">
                    Ordenar por: <span class="font-bold text-gray-800">Nombre</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="relative h-40 bg-gray-100 flex items-center justify-center p-4">
                        <span class="absolute top-2 left-2 bg-[#0f763e] text-white text-[10px] font-bold px-2 py-1 rounded">FRESCO</span>
                        <div class="w-24 h-24 bg-green-200 rounded-full opacity-50"></div>
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <p class="text-xs text-gray-400 mb-1">Alimentos</p>
                        <h3 class="text-sm font-bold text-gray-800 leading-tight mb-2">Aguacate Hass Malla 1kg</h3>
                        
                        <div class="mt-auto">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-black text-[#0f763e]">$45.00</span>
                                <span class="text-xs font-medium text-green-600 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Stock: 24
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-2 py-1.5">
                                    <button class="text-gray-400 hover:text-gray-700 w-6 h-6 flex items-center justify-center font-bold">-</button>
                                    <span class="font-bold text-gray-800 text-sm">1</span>
                                    <button class="text-gray-400 hover:text-gray-700 w-6 h-6 flex items-center justify-center font-bold">+</button>
                                </div>
                                <button class="w-10 h-10 bg-[#f26522] text-white rounded-xl flex items-center justify-center hover:bg-orange-600 transition-colors shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="relative h-40 bg-gray-50 flex items-center justify-center p-4">
                        <div class="w-16 h-24 bg-blue-100 rounded-lg opacity-50"></div>
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <p class="text-xs text-gray-400 mb-1">Bebidas</p>
                        <h3 class="text-sm font-bold text-gray-800 leading-tight mb-2">Leche Entera Lala 1L</h3>
                        
                        <div class="mt-auto">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-black text-[#0f763e]">$24.50</span>
                                <span class="text-xs font-medium text-green-600 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Stock: 15
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-2 py-1.5">
                                    <button class="text-gray-400 hover:text-gray-700 w-6 h-6 flex items-center justify-center font-bold">-</button>
                                    <span class="font-bold text-gray-800 text-sm">1</span>
                                    <button class="text-gray-400 hover:text-gray-700 w-6 h-6 flex items-center justify-center font-bold">+</button>
                                </div>
                                <button class="w-10 h-10 bg-[#f26522] text-white rounded-xl flex items-center justify-center hover:bg-orange-600 transition-colors shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="relative h-40 bg-gray-50 flex items-center justify-center p-4">
                        <div class="w-20 h-20 bg-gray-200 rounded-lg opacity-50"></div>
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <p class="text-xs text-gray-400 mb-1">Higiene</p>
                        <h3 class="text-sm font-bold text-gray-800 leading-tight mb-2">Papel Higiénico Pétalo 4pz</h3>
                        
                        <div class="mt-auto">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-black text-[#0f763e]">$32.00</span>
                                <span class="text-xs font-bold text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Stock: 3 (Bajo)
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-2 py-1.5">
                                    <button class="text-gray-400 hover:text-gray-700 w-6 h-6 flex items-center justify-center font-bold">-</button>
                                    <span class="font-bold text-gray-800 text-sm">1</span>
                                    <button class="text-gray-400 hover:text-gray-700 w-6 h-6 flex items-center justify-center font-bold">+</button>
                                </div>
                                <button class="w-10 h-10 bg-[#f26522] text-white rounded-xl flex items-center justify-center hover:bg-orange-600 transition-colors shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="relative h-40 bg-gray-50 flex items-center justify-center p-4">
                        <span class="absolute top-2 left-2 bg-[#f26522] text-white text-[10px] font-bold px-2 py-1 rounded">OFERTA</span>
                        <div class="w-12 h-24 bg-red-900 rounded-md opacity-30"></div>
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <p class="text-xs text-gray-400 mb-1">Bebidas</p>
                        <h3 class="text-sm font-bold text-gray-800 leading-tight mb-2">Coca-Cola Retornable 2.5L</h3>
                        
                        <div class="mt-auto">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <span class="text-lg font-black text-[#0f763e]">$38.00</span>
                                    <span class="text-xs text-gray-400 line-through ml-1">$42.00</span>
                                </div>
                                <span class="text-xs font-medium text-green-600 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Stock: 45
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-2 py-1.5">
                                    <button class="text-gray-400 hover:text-gray-700 w-6 h-6 flex items-center justify-center font-bold">-</button>
                                    <span class="font-bold text-gray-800 text-sm">1</span>
                                    <button class="text-gray-400 hover:text-gray-700 w-6 h-6 flex items-center justify-center font-bold">+</button>
                                </div>
                                <button class="w-10 h-10 bg-[#f26522] text-white rounded-xl flex items-center justify-center hover:bg-orange-600 transition-colors shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>