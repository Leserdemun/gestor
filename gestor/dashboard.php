<?php
session_start();


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");


$timeout = 1800;


if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {


    session_unset();
    session_destroy();
    header("Location: index.php?expired=1");
    exit;
}

$_SESSION['LAST_ACTIVITY'] = time();

if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 300) {
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}
?>





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

            --sidebar-bg: #251ef9ff;
            --sidebar-header: #1e4df9ff;


            --main-bg: #cdcdcdff;
            --header-border: #070707ff;
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


        .custom-main-bg {
            background-color: var(--main-bg);
        }



        .custom-border-bottom {
            border-bottom-color: var(--header-border) !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-slate-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 custom-sidebar text-white flex flex-col shadow-lg shrink-0 transition-colors duration-300">

            <div class="h-16 flex items-center px-6 custom-sidebar-header border-b border-white/10">

                <div class="w-8 h-8 rounded custom-logo-box flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title xmlns="">buy-me-a-coffee-twotone</title>
                        <defs>
                            <mask id="SVGDJAMvcLZ">
                                <path fill="#fff"
                                    d="M5 6C5 4 7 6 11.5 6C16 6 19 4 19 6L19 7C19 8.5 17 9 12.5 9C8 9 5 9 5 7L5 6Z" />
                            </mask>
                            <mask id="SVGkAcgscvZ">
                                <path fill="#fff"
                                    d="M10.125 18.15C10.04 17.29 9.4 11.98 9.4 11.98C9.4 11.98 11.34 12.31 12.5 11.73C13.66 11.16 14.98 11 14.98 11C14.98 11 14.4 17.96 14.35 18.46C14.3 18.96 13.45 19.3 12.95 19.3L11.23 19.3C10.73 19.3 10.21 19 10.125 18.15Z" />
                            </mask>
                        </defs>
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2">
                            <path stroke-dasharray="32" stroke-dashoffset="32"
                                d="M7.5 10.5c0 0 0.83 6.93 1 8.5c0.17 1.57 1.5 2 2.5 2l2 0c1.5 0 2.88 -1.14 3 -2c0.13 -0.86 1 -12 1 -12">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="32;0" />
                            </path>
                            <path stroke-dasharray="12" stroke-dashoffset="12"
                                d="M8 4c1.1 -0.57 2 -1 4 -1c2 0 4.5 0.5 4.5 3">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s" dur="0.2s"
                                    values="12;0" />
                            </path>
                        </g>
                        <rect width="16" height="5" x="20" y="4" fill="currentColor" mask="url(#SVGDJAMvcLZ)">
                            <animate fill="freeze" attributeName="x" begin="0.4s" dur="0.4s" values="20;4" />
                        </rect>
                        <rect width="8" height="10" x="8" y="20" fill="currentColor" fill-opacity=".3"
                            mask="url(#SVGkAcgscvZ)">
                            <animate fill="freeze" attributeName="y" begin="1s" dur="0.4s" values="20;10" />
                        </rect>
                    </svg>
                </div>
                <span class="text-lg font-bold tracking-wide">Todo en Color</span>
            </div>

            <nav class="flex-1 py-6 px-3 space-y-1">
                <a href="dashboard.php"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium bg-white/10 text-white rounded-md shadow-sm border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title xmlns="">home-twotone</title>
                        <path fill="currentColor" fill-opacity="0"
                            d="M5 8.5l7 -5.5l7 5.5v12.5h-4v-8l-1 -1h-4l-1 1v8h-4v-12.5Z">
                            <animate fill="freeze" attributeName="fill-opacity" begin="1.1s" dur="0.15s"
                                values="0;0.3" />
                        </path>
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2">
                            <path stroke-dasharray="16" stroke-dashoffset="16" d="M4.5 21.5h15">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="16;0" />
                            </path>
                            <path stroke-dasharray="16" stroke-dashoffset="16" d="M4.5 21.5v-13.5M19.5 21.5v-13.5">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s"
                                    values="16;0" />
                            </path>
                            <path stroke-dasharray="28" stroke-dashoffset="28" d="M2 10l10 -8l10 8">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.4s"
                                    values="28;0" />
                            </path>
                            <path stroke-dasharray="24" stroke-dashoffset="24" d="M9.5 21.5v-9h5v9">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.7s" dur="0.4s"
                                    values="24;0" />
                            </path>
                        </g>
                    </svg>
                    Menu Principal
                </a>


                <p class="px-3 mt-6 mb-2 text-xs font-semibold text-white/50 uppercase tracking-wider">Operaciones</p>


                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title xmlns="">file-document</title>
                        <g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path stroke-dasharray="64" stroke-dashoffset="64"
                                d="M13.5 3l5.5 5.5v11.5c0 0.55 -0.45 1 -1 1h-12c-0.55 0 -1 -0.45 -1 -1v-16c0 -0.55 0.45 -1 1 -1Z">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0" />
                            </path>
                            <path d="M14.5 3.5l2.25 2.25l2.25 2.25z" opacity="0">
                                <animate fill="freeze" attributeName="d" begin="0.6s" dur="0.2s"
                                    values="M14.5 3.5l2.25 2.25l2.25 2.25z;M14.5 3.5l0 4.5l4.5 0z" />
                                <set fill="freeze" attributeName="opacity" begin="0.6s" to="1" />
                            </path>
                            <path stroke-dasharray="8" stroke-dashoffset="8" d="M9 13h6">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s" dur="0.2s"
                                    values="8;0" />
                            </path>
                            <path stroke-dasharray="4" stroke-dashoffset="4" d="M9 17h3">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1s" dur="0.2s"
                                    values="4;0" />
                            </path>
                        </g>
                    </svg>
                    Reportes
                </a>

                <a href="./users/provedores.php"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title xmlns="">clipboard-list</title>
                        <g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path stroke-dasharray="72" stroke-dashoffset="72" d="M12 3h7v18h-14v-18h7Z">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="72;0" />
                            </path>
                            <path stroke-dasharray="12" stroke-dashoffset="12" stroke-width="1" d="M14.5 3.5v3h-5v-3">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.7s" dur="0.2s"
                                    values="12;0" />
                            </path>
                            <path stroke-dasharray="4" stroke-dashoffset="4" d="M9 10h3">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.9s" dur="0.2s"
                                    values="4;0" />
                            </path>
                            <path stroke-dasharray="6" stroke-dashoffset="6" d="M9 13h5">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.1s" dur="0.2s"
                                    values="6;0" />
                            </path>
                            <path stroke-dasharray="8" stroke-dashoffset="8" d="M9 16h6">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.3s" dur="0.2s"
                                    values="8;0" />
                            </path>
                        </g>
                    </svg>
                    Provedores
                </a>

                <a href="./users/clientes.php"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title xmlns="">clipboard-list</title>
                        <g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path stroke-dasharray="72" stroke-dashoffset="72" d="M12 3h7v18h-14v-18h7Z">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="72;0" />
                            </path>
                            <path stroke-dasharray="12" stroke-dashoffset="12" stroke-width="1" d="M14.5 3.5v3h-5v-3">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.7s" dur="0.2s"
                                    values="12;0" />
                            </path>
                            <path stroke-dasharray="4" stroke-dashoffset="4" d="M9 10h3">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.9s" dur="0.2s"
                                    values="4;0" />
                            </path>
                            <path stroke-dasharray="6" stroke-dashoffset="6" d="M9 13h5">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.1s" dur="0.2s"
                                    values="6;0" />
                            </path>
                            <path stroke-dasharray="8" stroke-dashoffset="8" d="M9 16h6">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.3s" dur="0.2s"
                                    values="8;0" />
                            </path>
                        </g>
                    </svg>
                    Clientes
                </a>

                <a href="./src/productos.php"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title xmlns="">beer-twotone-loop</title>
                        <mask id="SVG5fE0HcGe">
                            <path fill="none" stroke="#fff" stroke-width="2"
                                d="M18 7c-2 0 -3 2 -5 2c-2 0 -3 -2 -5 -2c-2 0 -3 2 -5 2c-2 0 -3 -2 -5 -2c-2 0 -3 2 -5 2"
                                opacity="0">
                                <animateMotion calcMode="linear" dur="3s" path="M0 0h10" repeatCount="indefinite" />
                                <animate fill="freeze" attributeName="opacity" begin="0.7s" dur="0.4s" values="0;1" />
                            </path>
                        </mask>
                        <path fill="currentColor" fill-opacity="0" d="M17 8L16 21H7L6 8z">
                            <animate fill="freeze" attributeName="fill-opacity" begin="1.1s" dur="0.15s"
                                values="0;0.3" />
                        </path>
                        <path fill="none" stroke="currentColor" stroke-dasharray="64" stroke-dashoffset="64"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 3l-2 18h-9l-2 -18Z">
                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0" />
                        </path>
                        <path fill="currentColor" d="M18 3l-2 18h-9l-2 -18Z" mask="url(#SVG5fE0HcGe)" />
                    </svg>
                    Productos
                </a>



                <p class="px-3 mt-6 mb-2 text-xs font-semibold text-white/50 uppercase tracking-wider">Opciones de
                    Administración
                </p>

                <a href="./admin/listado_usuarios.php"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title xmlns="">person-twotone</title>
                        <g fill="currentColor" fill-opacity="0" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                            <path stroke-dasharray="20" stroke-dashoffset="20"
                                d="M12 5c1.66 0 3 1.34 3 3c0 1.66 -1.34 3 -3 3c-1.66 0 -3 -1.34 -3 -3c0 -1.66 1.34 -3 3 -3Z">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="20;0" />
                            </path>
                            <path stroke-dasharray="36" stroke-dashoffset="36"
                                d="M12 14c4 0 7 2 7 3v2h-14v-2c0 -1 3 -3 7 -3Z">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.5s"
                                    values="36;0" />
                            </path>
                            <animate fill="freeze" attributeName="fill-opacity" begin="1.1s" dur="0.15s"
                                values="0;0.3" />
                        </g>
                    </svg>
                    Usuarios
                </a>

                <a href="./src/movimientos.php"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title xmlns="">monitor-arrow-down-twotone</title>
                        <path fill="#ffffff" d="M10 16h4v0h-4z">
                            <animate fill="freeze" attributeName="d" begin="0.6s" dur="0.2s"
                                values="M10 16h4v0h-4z;M10 16h4v6h-4z" />
                        </path>
                        <g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path fill="#ffffff" fill-opacity="0" stroke-dasharray="72" stroke-dashoffset="72"
                                d="M12 17h-10v-14h20v14Z">
                                <animate fill="freeze" attributeName="fill-opacity" begin="1.1s" dur="0.15s"
                                    values="0;0.3" />
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="72;0" />
                            </path>
                            <path stroke-dasharray="4" stroke-dashoffset="4" d="M12 21h3M12 21h-3">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s" dur="0.2s"
                                    values="4;0" />
                            </path>
                            <path stroke-dasharray="8" stroke-dashoffset="8" d="M12 7v6">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.25s" dur="0.2s"
                                    values="8;0" />
                            </path>
                            <path stroke-dasharray="6" stroke-dashoffset="6" d="M12 13l3 -3M12 13l-3 -3">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.45s" dur="0.2s"
                                    values="6;0" />
                            </path>
                        </g>
                    </svg>
                    Movimientos
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <title xmlns="">folder-arrow-down</title>
                        <mask id="SVGqrcpvbJg">
                            <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2">
                                <path stroke-dasharray="64" stroke-dashoffset="64"
                                    d="M12 7h8c0.55 0 1 0.45 1 1v10c0 0.55 -0.45 1 -1 1h-16c-0.55 0 -1 -0.45 -1 -1v-11Z">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0" />
                                </path>
                                <path d="M12 7h-9v0c0 0 0.45 0 1 0h6z" opacity="0">
                                    <animate fill="freeze" attributeName="d" begin="0.6s" dur="0.2s"
                                        values="M12 7h-9v0c0 0 0.45 0 1 0h6z;M12 7h-9v-1c0 -0.55 0.45 -1 1 -1h6z" />
                                    <set fill="freeze" attributeName="opacity" begin="0.6s" to="1" />
                                </path>
                                <path fill="#000" fill-opacity="0" stroke="none"
                                    d="M19 13c3.31 0 6 2.69 6 6c0 3.31 -2.69 6 -6 6c-3.31 0 -6 -2.69 -6 -6c0 -3.31 2.69 -6 6 -6Z">
                                    <set fill="freeze" attributeName="fill-opacity" begin="0.8s" to="1" />
                                </path>
                                <path stroke-dasharray="6" stroke-dashoffset="6" d="M19 16v5">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s" dur="0.2s"
                                        values="6;0" />
                                </path>
                                <path stroke-dasharray="4" stroke-dashoffset="4" d="M19 21l2 -2M19 21l-2 -2">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="1s" dur="0.2s"
                                        values="4;0" />
                                </path>
                            </g>
                        </mask>
                        <rect width="24" height="24" fill="currentColor" mask="url(#SVGqrcpvbJg)" />
                    </svg>
                    Listado de Facturas
                </a>


            </nav>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden custom-main-bg">

            <header class="h-16 custom-main-bg border-b custom-border-bottom flex items-center justify-between px-8">
                <h2 class="text-xl font-semibold text-slate-800">Panel de Control</h2>

                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">


                        <div class="flex flex-col leading-tight text-right">
                            <span class="text-sm font-semibold text-slate-800">
                                <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                            </span>
                            <span class="text-xs text-slate-500 -mt-0.5">
                                <?php echo htmlspecialchars($_SESSION['rol']); ?>
                            </span>
                        </div>

                        <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                <title>account</title>
                                <g fill="none" stroke="currentColor" stroke-dasharray="28" stroke-dashoffset="28"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M4 21v-1c0 -3.31 2.69 -6 6 -6h4c3.31 0 6 2.69 6 6v1">
                                        <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s"
                                            values="28;0" />
                                    </path>
                                    <path
                                        d="M12 11c-2.21 0 -4 -1.79 -4 -4c0 -2.21 1.79 -4 4 -4c2.21 0 4 1.79 4 4c0 2.21 -1.79 4 -4 4Z">
                                        <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.4s"
                                            values="28;0" />
                                    </path>
                                </g>
                            </svg>
                        </div>
                    </div>

                    <button onclick="openLogoutModal()"
                        class="text-sm font-medium text-red-600 hover:text-red-700 hover:underline decoration-2 underline-offset-4 transition">
                        Cerrar sesión
                    </button>
                </div>
            </header>




            <div class="flex-1 overflow-y-auto p-8 custom-main-bg">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900">Bienvenido a Todo en Color</h1>
                    <p class="text-slate-500 mt-1">Tu sistema de gestión está listo. Agrega tus categorias o añade tus
                        productos nuevos.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                </div>
            </div>

            <div class="relative z-10 text-xs text-slate-600 font-medium p-8 custom-main-bg">
                &copy; S.I.G.E.T 2025 - Sistema de Inventario y Gestión de Tintas.
            </div>

        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>

    <script>
        function openLogoutModal() {
            document.getElementById("logoutModal").classList.remove("hidden");
        }

        function closeLogoutModal() {
            document.getElementById("logoutModal").classList.add("hidden");
        }

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeLogoutModal();
        });
    </script>


    <!-- MODAL LOGOUT -->
    <div id="logoutModal"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden">

        <div
            class="bg-white dark:bg-slate-900 w-full max-w-sm p-6 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 animate-[scaleUp_0.25s_ease-out]">

            <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-3 text-center">
                ¿Cerrar sesión?
            </h2>

            <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 text-center">
                Tu sesión se cerrará y volverás a la pantalla de inicio.
            </p>

            <div class="flex gap-3">
                <button onclick="closeLogoutModal()"
                    class="flex-1 py-2 bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-300 dark:hover:bg-slate-700 transition">
                    Cancelar
                </button>

                <button onclick="window.location.href='logout.php'"
                    class="flex-1 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Sí, salir
                </button>
            </div>

        </div>
    </div>

    <style>
        @keyframes scaleUp {
            from {
                transform: scale(0.92);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

</body>

</html>