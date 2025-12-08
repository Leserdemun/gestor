<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chromatica Inks - Acceso Corporativo</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        ink: {
                            cyan: '#06b6d4',
                            magenta: '#d946ef',
                            yellow: '#eab308',
                            black: '#0f172a',
                        }
                    },
                    animation: {
                        'blob': 'blob 10s infinite',
                        'fade-in': 'fadeIn 0.3s ease-out forwards',
                        'scale-up': 'scaleUp 0.3s ease-out forwards',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        scaleUp: {
                            '0%': { transform: 'scale(0.95)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .bg-noise {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
        }

        /* Efecto Cristal */
        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="bg-slate-950 h-screen w-full flex overflow-hidden font-sans text-slate-200 relative">

    <div id="accessModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm animate-fade-in" onclick="closeModal()"></div>

        <div
            class="relative bg-slate-900 border border-slate-700 w-full max-w-md p-8 rounded-2xl shadow-2xl animate-scale-up m-4">
            <div
                class="w-16 h-16 mx-auto bg-slate-800 rounded-full flex items-center justify-center mb-6 border border-slate-700 relative">
                <i class="fa-solid fa-user-lock text-3xl text-ink-cyan"></i>
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-ink-magenta rounded-full border-2 border-slate-900">
                </div>
            </div>

            <div class="text-center">
                <h3 class="font-display text-2xl font-bold text-white mb-3">Acceso Restringido</h3>
                <p class="text-slate-400 mb-6 leading-relaxed">
                    Por motivos de seguridad y control de calidad, el registro de nuevas cuentas está gestionado
                    exclusivamente por el departamento de administración.
                </p>

                <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/50 mb-6 text-sm text-slate-300">
                    <p><i class="fa-solid fa-circle-info text-ink-yellow mr-2"></i>Contacta a tu proveedor o
                        administrador de sistema para solicitar credenciales.</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="closeModal()"
                        class="flex-1 py-2.5 bg-slate-800 hover:bg-slate-700 text-white rounded-lg transition border border-slate-700 font-medium">
                        Entendido
                    </button>
                    <a href="mailto:soporte@chromatica.com"
                        class="flex-1 py-2.5 bg-ink-cyan/10 hover:bg-ink-cyan/20 text-ink-cyan rounded-lg transition border border-ink-cyan/20 font-medium flex items-center justify-center gap-2">
                        <i class="fa-regular fa-envelope"></i> Contactar Soporte
                    </a>
                </div>
            </div>

            <button onclick="closeModal()" class="absolute top-4 right-4 text-slate-500 hover:text-white transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
    </div>

    <div
        class="hidden lg:flex w-1/2 relative flex-col justify-between p-12 overflow-hidden bg-slate-900 border-r border-white/5">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?q=80&w=2070&auto=format&fit=crop"
                class="w-full h-full object-cover opacity-60 mix-blend-overlay" alt="Ink texture">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-slate-900/40"></div>
        </div>

        <div
            class="absolute top-1/4 left-1/4 w-96 h-96 bg-ink-cyan/20 rounded-full mix-blend-screen filter blur-[60px] opacity-40 animate-blob">
        </div>
        <div
            class="absolute top-1/3 right-1/4 w-80 h-80 bg-ink-magenta/20 rounded-full mix-blend-screen filter blur-[60px] opacity-40 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute bottom-1/4 left-1/3 w-72 h-72 bg-ink-yellow/10 rounded-full mix-blend-screen filter blur-[50px] opacity-30 animate-blob animation-delay-4000">
        </div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-6">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-ink-cyan via-blue-500 to-ink-magenta flex items-center justify-center text-white shadow-lg shadow-cyan-500/20 border border-white/10">
                    <i class="fa-solid fa-droplet text-xl"></i>
                </div>
                <div>
                    <span
                        class="font-display font-bold text-3xl tracking-wide text-white block leading-none">Chromatica</span>
                    <span class="text-xs text-ink-cyan tracking-[0.3em] uppercase">Chemical Group</span>
                </div>
            </div>
        </div>

        <div class="relative z-10 max-w-lg">
            <h2
                class="font-display text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 mb-6 leading-tight">
                Precisión en <br>cada gota.
            </h2>
            <p class="text-slate-400 text-lg leading-relaxed">
                Plataforma integral para la gestión de formulaciones de tinta, control de viscosidad e inventario de
                pigmentos en tiempo real.
            </p>

            <div class="flex gap-4 mt-10">
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3 h-3 rounded-full bg-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.8)]"></div>
                    <span class="text-[10px] text-slate-600 font-bold">C</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3 h-3 rounded-full bg-fuchsia-500 shadow-[0_0_15px_rgba(217,70,239,0.8)]"></div>
                    <span class="text-[10px] text-slate-600 font-bold">M</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3 h-3 rounded-full bg-yellow-400 shadow-[0_0_15px_rgba(234,179,8,0.8)]"></div>
                    <span class="text-[10px] text-slate-600 font-bold">Y</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3 h-3 rounded-full bg-black border border-slate-600"></div>
                    <span class="text-[10px] text-slate-600 font-bold">K</span>
                </div>
            </div>
        </div>

        <div class="relative z-10 text-xs text-slate-600 font-medium">
            &copy; 2024 Chromatica Chemical Group. Sistema v2.4
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-4 relative bg-noise">

        <div class="w-full max-w-md glass-card p-10 rounded-2xl relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-ink-cyan via-ink-magenta to-ink-yellow">
            </div>

            <div class="lg:hidden flex justify-center mb-8">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-ink-cyan to-ink-magenta flex items-center justify-center text-white text-xl shadow-lg">
                    <i class="fa-solid fa-droplet"></i>
                </div>
            </div>

            <div class="text-center mb-8">
                <h1 class="font-display text-3xl font-bold text-white mb-2">Panel de Control</h1>
                <p class="text-slate-400 text-sm">Ingresa tus credenciales autorizadas.</p>
            </div>

            <form class="space-y-5" onsubmit="event.preventDefault();">

                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-bold text-slate-400 ml-1 uppercase tracking-wider">ID Usuario
                        / Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i
                                class="fa-regular fa-envelope text-slate-500 group-focus-within:text-ink-cyan transition-colors"></i>
                        </div>
                        <input type="email" id="email"
                            class="block w-full pl-11 pr-4 py-3 bg-slate-950/50 border border-slate-700/50 rounded-xl text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-1 focus:ring-ink-cyan focus:border-ink-cyan transition-all shadow-inner"
                            placeholder="user@chromatica.com">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <div class="flex justify-between items-center ml-1">
                        <label for="password"
                            class="text-xs font-bold text-slate-400 uppercase tracking-wider">Contraseña</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i
                                class="fa-solid fa-lock text-slate-500 group-focus-within:text-ink-cyan transition-colors"></i>
                        </div>
                        <input type="password" id="password"
                            class="block w-full pl-11 pr-12 py-3 bg-slate-950/50 border border-slate-700/50 rounded-xl text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-1 focus:ring-ink-cyan focus:border-ink-cyan transition-all shadow-inner"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-slate-300 cursor-pointer transition">
                            <i id="eyeIcon" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                    <div class="flex justify-end mt-1">
                        <a href="#" class="text-xs font-medium text-slate-500 hover:text-ink-cyan transition">Recuperar
                            contraseña</a>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3.5 px-4 mt-4 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-bold rounded-xl shadow-lg shadow-cyan-900/40 transform transition hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2 group border border-white/10">
                    <span>Acceder al Sistema</span>
                    <i
                        class="fa-solid fa-arrow-right text-sm opacity-70 group-hover:translate-x-1 transition-transform"></i>
                </button>

                <div class="pt-6 mt-6 border-t border-slate-800 text-center">
                    <p class="text-slate-500 text-sm">
                        ¿No tienes una cuenta?
                        <button type="button" onclick="openModal()"
                            class="text-ink-magenta hover:text-pink-400 font-semibold hover:underline decoration-2 underline-offset-4 ml-1 transition">
                            Solicitar Acceso
                        </button>
                    </p>
                </div>

            </form>
        </div>

        <div class="absolute bottom-6 text-[10px] text-slate-600">
            <i class="fa-solid fa-lock mr-1"></i> Conexión Segura TLS 1.3
        </div>
    </div>

    <script>
        // Lógica para mostrar/ocultar contraseña
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Lógica del Modal
        const modal = document.getElementById('accessModal');

        function openModal() {
            modal.classList.remove('hidden');
        }

        function closeModal() {
            // Añadir animación de salida si se desea, por ahora simple ocultación
            modal.classList.add('hidden');
        }

        // Cerrar modal con tecla ESC
        document.addEventListener('keydown', function (event) {
            if (event.key === "Escape" && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
</body>

</html>