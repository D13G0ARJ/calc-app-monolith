<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculator API | Backend Service</title>
    <!-- Tailwind CSS via CDN -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .gradient-text {
            background: linear-gradient(to right, #60a5fa, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-slate-900 text-white min-h-screen flex items-center justify-center overflow-hidden relative">

    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-500/10 rounded-full blur-[100px] animate-float"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-500/10 rounded-full blur-[100px] animate-float" style="animation-delay: 2s;"></div>
    </div>

    <!-- Main Card -->
    <div class="relative z-10 max-w-4xl w-full p-8 mx-4">
        <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700 rounded-3xl p-12 shadow-2xl text-center">
            
            <!-- Icon/Logo -->
            <div class="w-24 h-24 bg-gradient-to-tr from-blue-500 to-purple-600 rounded-2xl mx-auto flex items-center justify-center mb-8 shadow-lg shadow-blue-500/30 transform rotate-3 hover:rotate-6 transition-transform duration-500">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>

            <!-- Title -->
            <h1 class="text-5xl font-bold mb-4 tracking-tight">
                Calculator <span class="gradient-text">API Service</span>
            </h1>
            
            <p class="text-slate-400 text-lg mb-10 max-w-lg mx-auto leading-relaxed">
                Este es el backend oficial. Procesando operaciones matemáticas complejas con precisión y velocidad.
            </p>

            <!-- Status Indicators -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-slate-700/30 p-4 rounded-xl border border-slate-700 hover:bg-slate-700/50 transition-colors">
                    <div class="text-blue-400 font-bold text-xl mb-1">Laravel 10</div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider">Framework</div>
                </div>
                <div class="bg-slate-700/30 p-4 rounded-xl border border-slate-700 hover:bg-slate-700/50 transition-colors">
                    <div class="text-green-400 font-bold text-xl mb-1">Activo</div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider">Estado del Sistema</div>
                </div>
                <div class="bg-slate-700/30 p-4 rounded-xl border border-slate-700 hover:bg-slate-700/50 transition-colors">
                    <div class="text-purple-400 font-bold text-xl mb-1">REST API</div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider">Arquitectura</div>
                </div>
            </div>

            <!-- Action -->
            <div class="flex items-center justify-center gap-4 text-sm text-slate-500">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    Servidor en ejecución en puerto 8000
                </span>
            </div>

        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-center text-slate-600 text-sm">
            &copy; 2026 Calculator Project. All systems nominal.
        </div>
    </div>

</body>
</html>
