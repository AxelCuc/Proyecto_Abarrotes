<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - Abarrotes Central</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-full shrink-0">
        <div>
            <div class="p-6 pb-8 border-b border-gray-100">
                <h1 class="text-xl font-bold text-[#0f763e] leading-tight">Abarrotes Central</h1>
                <p class="text-xs text-gray-400 font-medium mt-1">Panel de Administrador</p>
            </div>

            <nav class="p-4 space-y-1.5">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-[#0f763e] text-white rounded-xl font-semibold shadow-sm shadow-green-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Inventario
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-green-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Ventas
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-green-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Reportes
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-green-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Usuarios y Roles
                </a>
            </nav>
        </div>

        <div class="p-6 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') ?? '#' }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-y-auto">
        
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-end items-center shrink-0 gap-6">
            <div class="flex items-center gap-4">
                <button class="relative text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                </button>
            </div>
            
            <div class="flex items-center gap-3 pl-6 border-l border-gray-200">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-800 leading-tight">Admin User</p>
                    <p class="text-xs text-gray-500">Store Manager</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-[#0f763e] font-bold border-2 border-white shadow-sm">
                    AU
                </div>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto w-full space-y-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Bienvenido, Administrador</h2>
                    <p class="text-gray-500 mt-1 font-medium">Hoy es Martes, 24 de Octubre de 2023</p>
                </div>
                <div class="bg-[#0f763e] text-white px-5 py-2.5 rounded-lg font-bold text-sm shadow-md flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Sucursal Centro Abierta
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-[#0f763e] mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Gestión de Inventario</h3>
                    <p class="text-sm text-gray-500">Controla existencias y nuevos ingresos.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-[#f26522] mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Panel de Ventas</h3>
                    <p class="text-sm text-gray-500">Visualiza transacciones en tiempo real.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Reportes Analíticos</h3>
                    <p class="text-sm text-gray-500">Análisis detallado de rendimiento.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Usuarios y Roles</h3>
                    <p class="text-sm text-gray-500">Administra permisos del personal.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="bg-[#0f763e] rounded-2xl p-6 text-white shadow-lg relative overflow-hidden flex flex-col justify-between">
                    <div>
                        <p class="text-green-100 font-medium mb-1">Ventas del Día</p>
                        <h3 class="text-4xl font-black mb-3">$12,450.30</h3>
                        <span class="inline-flex items-center gap-1 bg-white/20 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            +8% vs ayer
                        </span>
                    </div>
                    
                    <div class="flex items-end gap-2 mt-8 h-24 opacity-90">
                        <div class="w-1/6 bg-white rounded-t-sm h-3/5"></div>
                        <div class="w-1/6 bg-white rounded-t-sm h-4/5"></div>
                        <div class="w-1/6 bg-white rounded-t-sm h-full"></div>
                        <div class="w-1/6 bg-white/50 rounded-t-sm h-2/5"></div>
                        <div class="w-1/6 bg-white/50 rounded-t-sm h-3/5"></div>
                        <div class="w-1/6 bg-white/50 rounded-t-sm h-1/5"></div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Alertas de Stock</h3>
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 rounded-xl border border-red-100 bg-red-50/50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-red-400 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Leche Entera 1L</p>
                                    <p class="text-xs text-red-500 font-medium">5 UNIDADES</p>
                                </div>
                            </div>
                            <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded">URGENTE</span>
                        </div>

                        <div class="flex items-center justify-between p-3 rounded-xl border border-red-100 bg-red-50/50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-red-400 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Huevo Rojo 30pcs</p>
                                    <p class="text-xs text-red-500 font-medium">2 UNIDADES</p>
                                </div>
                            </div>
                            <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded">URGENTE</span>
                        </div>

                        <div class="flex items-center justify-between p-3 rounded-xl border border-orange-100 bg-orange-50/50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-orange-400 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Pan Dulce Variado</p>
                                    <p class="text-xs text-orange-500 font-medium">12 UNIDADES</p>
                                </div>
                            </div>
                            <span class="bg-orange-500 text-white text-[10px] font-bold px-2 py-1 rounded">BAJO</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Actividad Reciente</h3>
                    
                    <div class="relative pl-4 border-l-2 border-gray-100 space-y-6">
                        
                        <div class="relative">
                            <div class="absolute -left-[25px] bg-green-500 rounded-full p-1.5 border-4 border-white shadow-sm">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            </div>
                            <div class="pl-4">
                                <p class="text-sm text-gray-800">Nuevo cajero registrado: <span class="font-bold">Carlos Ruiz</span></p>
                                <p class="text-xs text-gray-400 mt-0.5">Hace 15 minutos</p>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="absolute -left-[25px] bg-blue-500 rounded-full p-1.5 border-4 border-white shadow-sm">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div class="pl-4">
                                <p class="text-sm text-gray-800">Cierre de caja exitoso - <span class="font-bold">Caja 02</span></p>
                                <p class="text-xs text-gray-400 mt-0.5">Hace 1 hora</p>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="absolute -left-[25px] bg-orange-500 rounded-full p-1.5 border-4 border-white shadow-sm">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </div>
                            <div class="pl-4">
                                <p class="text-sm text-gray-800">Actualización masiva de precios completada</p>
                                <p class="text-xs text-gray-400 mt-0.5">Hace 3 horas</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>