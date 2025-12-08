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
        :root {

            --sidebar-bg: #504a4fff;


            --sidebar-header: #504a4fff;


            --logo-bg: #504a4fff;
        }

        body {
            font-family: 'Inter', sans-serif;
        }


        .custom-sidebar {
            background-color: var(--sidebar-bg);
        }

        .custom-sidebar-header {
            background-color: var(--sidebar-header);
        }

        .custom-logo-box {
            background-color: var(--logo-bg);
        }
    </style>
</head>

<body class="bg-gray-50 text-slate-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 custom-sidebar text-white flex flex-col shadow-lg shrink-0 transition-colors duration-300">

            <div class="h-16 flex items-center px-6 custom-sidebar-header border-b border-white/10">

                <div class="w-8 h-8 rounded custom-logo-box flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" viewBox="0 0 24 24">
                        <title>paint-bucket</title>
                        <path fill="#ffffff"
                            d="M8 3h8v2H8zm0 2H6v4H4v12h16V9h-2V5h-2v4H8zm8 6h2v8H6v-8h2v6h2v-4h2v2h2v-2h2z" />
                    </svg>
                </div>
                <span class="text-lg font-bold tracking-wide">Todo en Color</span>
            </div>

            <nav class="flex-1 py-6 px-3 space-y-1">
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium bg-white/10 text-white rounded-md shadow-sm border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title>home</title>
                        <path fill="currentColor"
                            d="M14 2h-4v2H8v2H6v2H4v2H2v2h2v10h7v-6h2v6h7V12h2v-2h-2V8h-2V6h-2V4h-2zm0 2v2h2v2h2v2h2v2h-2v8h-3v-6H9v6H6v-8H4v-2h2V8h2V6h2V4z" />
                    </svg>
                    Menu Principal
                </a>


                <p class="px-3 mt-6 mb-2 text-xs font-semibold text-white/50 uppercase tracking-wider">Operaciones</p>


                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title>script-text</title>
                        <path fill="currentColor"
                            d="M6 3h14v2h2v6h-2v8h-2V5H6zm8 14v-2H6V5H4v10H2v4h2v2h14v-2h-2v-2zm0 0v2H4v-2zM8 7h8v2H8zm8 4H8v2h8z" />
                    </svg>
                    Reportes
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title>inbox-all</title>
                        <path fill="currentColor"
                            d="M3 2h18v20H3zm2 2v4h4v2h6V8h4V4zm14 6h-2v2H7v-2H5v4h14zm0 6h-2v2H7v-2H5v4h14z" />
                    </svg>
                    Categorías
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title>fill-half</title>
                        <path fill="currentColor"
                            d="M9 2h2v2H9zm4 4V4h-2v2H9v2H7v2H5v2H3v2h2v2h2v2h2v2h2v2h2v-2h2v-2h2v-2h2v6h2V12h-2v-2h-2V8h-2V6zm0 0v2h2v2h2v2h2v2H5v-2h2v-2h2V8h2V6z" />
                    </svg>
                    Productos
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title>folder-x</title>
                        <path fill="currentColor"
                            d="M12 4H2v16h20V6H12zm-2 4h10v10H4V6h6zm6 4h-2v-2h-2v2h2v2h-2v2h2v-2h2v2h2v-2h-2zm0 0h2v-2h-2z" />
                    </svg>
                    Inventario
                </a>

                <p class="px-3 mt-6 mb-2 text-xs font-semibold text-white/50 uppercase tracking-wider">Opciones de
                    Administración
                </p>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title>human-height</title>
                        <path fill="currentColor"
                            d="M6 2h4v4H6zM3 7h10v9h-2v6H9v-6H7v6H5v-6H3zm18-4h-6v2h6zm-4 4h4v2h-4zm4 4h-6v2h6zm-6 8h6v2h-6zm6-4h-4v2h4z" />
                    </svg>
                    Usuarios
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title>trending</title>
                        <path fill="currentColor"
                            d="M3 4h2v14h16v2H3zm6 10H7v2h2zm2-2v2H9v-2zm2 0v-2h-2v2zm2 0h-2v2h2zm2-2h-2v2h2zm2-2v2h-2V8zm0 0V6h2v2z" />
                    </svg>
                    Movimientos
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title>reciept-alt</title>
                        <path fill="currentColor"
                            d="M5 2H3v20h2v-2h2v2h2v-2h2v2h2v-2h2v2h2v-2h2v2h2V2h-2v2h-2V2h-2v2h-2V2h-2v2H9V2H7v2H5zm2 2h2v2h2V4h2v2h2V4h2v2h2v12h-2v2h-2v-2h-2v2h-2v-2H9v2H7v-2H5V6h2zm0 4h10v2H7zm10 4H7v2h10z" />
                    </svg>
                    Listado de Facturas
                </a>


            </nav>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">

            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8">
                <h2 class="text-xl font-semibold text-slate-800">Panel de Control</h2>
                <div class="flex items-center gap-4">

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-slate-700">Admin</span>
                        <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                <title>github</title>
                                <path fill="currentColor"
                                    d="M5 2h4v2H7v2H5zm0 10H3V6h2zm2 2H5v-2h2zm2 2v-2H7v2H3v-2H1v2h2v2h4v4h2v-4h2v-2zm0 0v2H7v-2zm6-12v2H9V4zm4 2h-2V4h-2V2h4zm0 6V6h2v6zm-2 2v-2h2v2zm-2 2v-2h2v2zm0 2h-2v-2h2zm0 0h2v4h-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 bg-gray-50">

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900">Bienvenido a Todo en Color</h1>
                    <p class="text-slate-500 mt-1">Tu sistema de gestión está listo. Agrega
                        tus categorias o añade tus productos nuevos.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">


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