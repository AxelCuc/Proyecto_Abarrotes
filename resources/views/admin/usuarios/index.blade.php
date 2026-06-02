<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios y Roles - Abarrotes Central</title>
    @vite(['resources/css/app.css', 'resources/js/admin/usuarios.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>

<body 
    class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800"
    x-data="usuariosHandler()"
>

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col h-full shrink-0 z-20">
        <div class="p-6 border-b border-gray-50">
            <h1 class="text-xl font-bold text-[#0f763e] leading-tight">Abarrotes Central</h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-4 space-y-1.5 custom-scrollbar">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Panel de Control
            </a>
            <a href="{{ route('admin.productos.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Inventario
            </a>
            <a href="{{ route('admin.ventas.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Ventas
            </a>
            <a href="{{ route('admin.reportes.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Reportes
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="flex items-center gap-3 px-4 py-3 bg-[#0f763e] text-white rounded-xl font-medium transition-colors shadow-md shadow-green-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios & Roles
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100 space-y-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden">
        
        <header class="bg-[#f8fafc] h-[72px] px-8 flex justify-between items-center shrink-0 border-b border-gray-100">
            <h2 class="text-2xl font-black text-gray-800 tracking-tight hidden md:block">Administrador</h2>
            
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden lg:block">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 italic">{{ Auth::user()->rol->nombre ?? 'Store Manager' }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#0f763e] flex items-center justify-center text-white font-bold uppercase shadow-md border-2 border-white">
                        {{ substr(Auth::user()->nombre ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 pt-4 custom-scrollbar">
            
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-black text-gray-800 tracking-tight">Gestión de Usuarios & Roles</h1>
                    <p class="text-gray-500 font-medium mt-1">Administra los accesos y permisos del personal de la tienda.</p>
                </div>
                <button @click="openCreateModal = true" class="bg-[#f97316] hover:bg-[#ea580c] text-white px-6 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow-md transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    Nuevo Usuario
                </button>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col">
                
                <div class="p-5 border-b border-gray-100 flex items-center justify-between">
    <form method="GET" action="{{ route('admin.usuarios.index') }}" class="relative w-full max-w-sm">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </span>
        <input type="text" name="search" value="{{ request('search') }}"
               class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl text-sm
                      placeholder-gray-400 focus:outline-none focus:border-[#0f763e]
                      focus:ring-1 focus:ring-[#0f763e] transition-colors"
               placeholder="Buscar por nombre o email...">
    </form>
</div>


                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Rol Asignado</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            
                            @foreach($usuarios as $usuario)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        @php
                                            $colors = ['bg-green-100 text-green-700', 'bg-orange-100 text-orange-700', 'bg-blue-100 text-blue-700', 'bg-purple-100 text-purple-700'];
                                            $colorClass = $colors[$usuario->id % 4];
                                            $words = explode(" ", $usuario->nombre);
                                            $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                                        @endphp
                                        <div class="w-10 h-10 rounded-full {{ $colorClass }} flex items-center justify-center font-bold text-sm shrink-0">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">{{ $usuario->nombre }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5">ID: {{ str_pad($usuario->id, 6, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm text-gray-600 font-medium">{{ $usuario->email }}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $rolNombre = $usuario->rol->nombre ?? 'N/A';
                                        $rolLower = strtolower($rolNombre);
                                        $badgeClass = 'bg-gray-100 text-gray-600 border border-gray-200'; // Default Cajero/Otros
                                        
                                        if($rolLower === 'administrador' || $rolLower === 'admin') {
                                            $badgeClass = 'bg-[#0284c7] text-white border-transparent';
                                        } elseif($rolLower === 'inventario') {
                                            $badgeClass = 'bg-purple-100 text-purple-700 border-transparent';
                                        }
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider {{ $badgeClass }}">
                                        {{ $rolNombre }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-2 h-2 rounded-full {{ $usuario->activo ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                        <span class="text-sm font-medium text-gray-700">{{ $usuario->activo ? 'Activo' : 'Inactivo' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <button @click="editUser({{ $usuario->id }}, '{{ addslashes($usuario->nombre) }}', '{{ $usuario->email }}', '{{ $rolNombre }}')" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Editar Usuario">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                        <button 
    @click="deleteUser({{ $usuario->id }}, '{{ addslashes($usuario->nombre) }}')" 
    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" 
    title="Eliminar Usuario">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
    </svg>
</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t border-gray-100 bg-white">
                    {{ $usuarios->links() }}
                </div>

            </div>
        </div>
    </main>

    @include('admin.usuarios.partials.modal-create')
    @include('admin.usuarios.partials.modal-edit')
    @include('admin.usuarios.partials.modal-delete')

</body>
</html>