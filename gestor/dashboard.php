<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Profesional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col">
            <div class="p-6 flex items-center gap-2">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">D
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">DashBoard</span>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1">
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium bg-indigo-50 text-indigo-700 rounded-lg">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Vista General
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="pie-chart" class="w-5 h-5"></i>
                    Analíticas
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Clientes
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    Configuración
                </a>
            </nav>

            <div class="p-4 border-t border-slate-200">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=random"
                        class="w-9 h-9 rounded-full" alt="Avatar">
                    <div class="text-sm">
                        <p class="font-medium text-slate-900">Usuario Admin</p>
                        <p class="text-slate-500 text-xs">admin@empresa.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8">
                <h2 class="text-xl font-semibold text-slate-800">Resumen Ejecutivo</h2>
                <div class="flex items-center gap-4">
                    <button class="p-2 text-slate-500 hover:text-slate-700 relative">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        + Nuevo Reporte
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div
                        class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Ingresos Totales</p>
                                <h3 class="text-2xl font-bold text-slate-900 mt-1">$124,500</h3>
                            </div>
                            <span class="p-2 bg-green-100 text-green-600 rounded-lg">
                                <i data-lucide="dollar-sign" class="w-5 h-5"></i>
                            </span>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-green-600 font-medium flex items-center gap-1">
                                <i data-lucide="trending-up" class="w-4 h-4"></i> 12.5%
                            </span>
                            <span class="text-slate-400 ml-2">vs mes anterior</span>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Usuarios Activos</p>
                                <h3 class="text-2xl font-bold text-slate-900 mt-1">8,234</h3>
                            </div>
                            <span class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </span>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-green-600 font-medium flex items-center gap-1">
                                <i data-lucide="trending-up" class="w-4 h-4"></i> 5.2%
                            </span>
                            <span class="text-slate-400 ml-2">vs mes anterior</span>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Tasa de Rebote</p>
                                <h3 class="text-2xl font-bold text-slate-900 mt-1">42.3%</h3>
                            </div>
                            <span class="p-2 bg-orange-100 text-orange-600 rounded-lg">
                                <i data-lucide="activity" class="w-5 h-5"></i>
                            </span>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-red-500 font-medium flex items-center gap-1">
                                <i data-lucide="trending-down" class="w-4 h-4"></i> 2.1%
                            </span>
                            <span class="text-slate-400 ml-2">vs mes anterior</span>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Tareas Pendientes</p>
                                <h3 class="text-2xl font-bold text-slate-900 mt-1">12</h3>
                            </div>
                            <span class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                                <i data-lucide="list-todo" class="w-5 h-5"></i>
                            </span>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-slate-400">4 urgentes</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4">Rendimiento de Ventas</h3>
                        <div
                            class="h-64 bg-slate-50 rounded-lg flex items-center justify-center border border-dashed border-slate-300">
                            <p class="text-slate-400">Área del Gráfico (Integrar Chart.js o Recharts aquí)</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4">Actividad Reciente</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-900">Nueva venta #3402</p>
                                    <p class="text-xs text-slate-500">Hace 5 minutos</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-900">Usuario registrado</p>
                                    <p class="text-xs text-slate-500">Hace 2 horas</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-900">Servidor reiniciado</p>
                                    <p class="text-xs text-slate-500">Hace 5 horas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-800">Transacciones Recientes</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50 text-slate-900 font-medium">
                                <tr>
                                    <th class="px-6 py-3">ID</th>
                                    <th class="px-6 py-3">Cliente</th>
                                    <th class="px-6 py-3">Estado</th>
                                    <th class="px-6 py-3">Monto</th>
                                    <th class="px-6 py-3">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4">#TR-8832</td>
                                    <td class="px-6 py-4 font-medium text-slate-900">Spotify Inc.</td>
                                    <td class="px-6 py-4"><span
                                            class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Completado</span>
                                    </td>
                                    <td class="px-6 py-4">$4,200.00</td>
                                    <td class="px-6 py-4">Oct 24, 2023</td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4">#TR-8833</td>
                                    <td class="px-6 py-4 font-medium text-slate-900">Netflix Corp</td>
                                    <td class="px-6 py-4"><span
                                            class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">Pendiente</span>
                                    </td>
                                    <td class="px-6 py-4">$1,200.00</td>
                                    <td class="px-6 py-4">Oct 25, 2023</td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4">#TR-8834</td>
                                    <td class="px-6 py-4 font-medium text-slate-900">Adobe Systems</td>
                                    <td class="px-6 py-4"><span
                                            class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Completado</span>
                                    </td>
                                    <td class="px-6 py-4">$850.00</td>
                                    <td class="px-6 py-4">Oct 26, 2023</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>