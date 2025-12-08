<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Tintas - Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-slate-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-lg shrink-0">
            <div class="h-16 flex items-center px-6 bg-slate-950 border-b border-slate-800">
                <div class="w-8 h-8 rounded bg-cyan-600 flex items-center justify-center mr-3">
                    <i data-lucide="droplet" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-lg font-bold tracking-wide">InkSystem</span>
            </div>

            <nav class="flex-1 py-6 px-3 space-y-1">
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium bg-cyan-600 text-white rounded-md shadow-sm">
                    <i data-lucide="layout-grid" class="w-5 h-5"></i>
                    Panel Principal
                </a>

                <p class="px-3 mt-6 mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Operaciones</p>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 rounded-md transition-colors">
                    <i data-lucide="flask-conical" class="w-5 h-5"></i>
                    Fórmulas
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 rounded-md transition-colors">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                    Lotes de Producción
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 rounded-md transition-colors">
                    <i data-lucide="package-search" class="w-5 h-5"></i>
                    Inventario MP
                </a>

                <p class="px-3 mt-6 mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Administración
                </p>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 rounded-md transition-colors">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Clientes
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 rounded-md transition-colors">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    Configuración
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">

            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8">
                <h2 class="text-xl font-semibold text-slate-800">Panel de Control</h2>
                <div class="flex items-center gap-4">
                    <button class="text-sm text-slate-500 hover:text-slate-700">Ayuda</button>
                    <div class="w-px h-6 bg-gray-300"></div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-slate-700">Admin</span>
                        <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 bg-gray-50">

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900">Bienvenido a InkSystem</h1>
                    <p class="text-slate-500 mt-1">Tu sistema de gestión está listo. Comienza agregando tu primera orden
                        de producción o registrando materias primas.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                    <button
                        class="group flex flex-col items-center justify-center h-48 border-2 border-dashed border-slate-300 rounded-xl bg-white hover:border-cyan-500 hover:bg-cyan-50 transition-all cursor-pointer">
                        <div
                            class="w-12 h-12 rounded-full bg-slate-100 group-hover:bg-cyan-100 flex items-center justify-center mb-3 transition-colors">
                            <i data-lucide="plus" class="w-6 h-6 text-slate-400 group-hover:text-cyan-600"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-700 group-hover:text-cyan-700">Crear Nuevo Lote</h3>
                        <p class="text-xs text-slate-400 mt-1">Iniciar una orden de fabricación</p>
                    </button>

                    <button
                        class="group flex flex-col items-center justify-center h-48 border-2 border-dashed border-slate-300 rounded-xl bg-white hover:border-blue-500 hover:bg-blue-50 transition-all cursor-pointer">
                        <div
                            class="w-12 h-12 rounded-full bg-slate-100 group-hover:bg-blue-100 flex items-center justify-center mb-3 transition-colors">
                            <i data-lucide="package-plus" class="w-6 h-6 text-slate-400 group-hover:text-blue-600"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-700 group-hover:text-blue-700">Registrar Materia
                            Prima</h3>
                        <p class="text-xs text-slate-400 mt-1">Ingresar pigmentos o solventes</p>
                    </button>

                    <button
                        class="group flex flex-col items-center justify-center h-48 border-2 border-dashed border-slate-300 rounded-xl bg-white hover:border-purple-500 hover:bg-purple-50 transition-all cursor-pointer">
                        <div
                            class="w-12 h-12 rounded-full bg-slate-100 group-hover:bg-purple-100 flex items-center justify-center mb-3 transition-colors">
                            <i data-lucide="file-plus" class="w-6 h-6 text-slate-400 group-hover:text-purple-600"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-700 group-hover:text-purple-700">Nueva Fórmula</h3>
                        <p class="text-xs text-slate-400 mt-1">Definir composición de tinta</p>
                    </button>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-semibold text-slate-800">Producción Reciente</h3>
                        <div class="flex gap-2">
                            <span class="w-3 h-3 rounded-full bg-gray-200"></span>
                            <span class="w-3 h-3 rounded-full bg-gray-200"></span>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                            <i data-lucide="clipboard-list" class="w-8 h-8 text-slate-300"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-900">No hay lotes activos</h4>
                        <p class="text-slate-500 max-w-sm mt-2 text-sm">
                            Actualmente no hay órdenes de producción en curso. Crea una nueva orden para visualizar el
                            seguimiento aquí.
                        </p>
                        <button
                            class="mt-6 px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition-colors shadow-sm">
                            Comenzar Producción
                        </button>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>