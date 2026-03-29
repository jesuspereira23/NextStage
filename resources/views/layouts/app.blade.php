<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NextStage</title>
    <link rel="icon" href="{{ asset('favicons/icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#050505] text-white overflow-x-hidden font-sans antialiased">

    <div class="flex flex-col h-[full]">

        <header class="bg-[#050505] h-16 px-6 flex items-center justify-between border-b border-white/5 z-50">
            <div class="flex items-center">
                <a href="/dashboard" class="flex items-center group">
                    <img src="/images/Lgo_next-removebg-preview.png" class="ml-6 h-10 w-auto object-contain"
                        alt="NextStage">
                </a>
            </div>

            <div class="flex items-center">
                <a href="/profile"
                    class="text-[10px] font-black text-[#CAFF00] tracking-[0.2em] uppercase italic hover:opacity-70 transition-all">
                    Meu Perfil
                </a>
            </div>
        </header>

        <nav
            class="bg-[#111111] border-b border-[#CAFF00]/50 h-12 px-6 flex items-center justify-center z-40 shadow-lg">
            <div class="flex items-center gap-10 ">

                <a href="/dashboard"
                    class="flex items-center gap-2 group {{ request()->is('dashboard') ? 'text-[#CAFF00]' : 'text-gray-400 hover:text-white' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-[0.15em] whitespace-nowrap">Dashboard</span>
                </a>

                <a href="/workouts"
                    class="flex items-center gap-2 group {{ request()->is('subjects*') ? 'text-[#CAFF00]' : 'text-gray-400 hover:text-white' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-[0.15em] whitespace-nowrap">Treinos</span>
                </a>

                <a href="/objectives"
                    class="flex items-center gap-2 group {{ request()->is('objectives*') ? 'text-[#CAFF00]' : 'text-gray-400 hover:text-white' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-[0.15em] whitespace-nowrap">Objetivos</span>
                </a>

                <a href="/exercises"
                    class="flex items-center gap-2 group {{ request()->is('exercises*') ? 'text-[#CAFF00]' : 'text-gray-400 hover:text-white' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-[0.15em] whitespace-nowrap">Exercicos </span>
                </a>

                <a href="/guias"
                    class="flex items-center gap-2 group {{ request()->is('horary*') ? 'text-[#CAFF00]' : 'text-gray-400 hover:text-white' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-[0.15em] whitespace-nowrap">Guias </span>
                </a>

                <a href="/exams"
                    class="flex items-center gap-2 group {{ request()->is('exams*') ? 'text-[#CAFF00]' : 'text-gray-400 hover:text-white' }} transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-[0.15em] whitespace-nowrap">Performance</span>
                </a>

            </div>
        </nav>

        <main class="flex-1 overflow-y-auto p-6 bg-[#050505]">
            <div class="max-w-5xl mx-auto w-full">
                @yield('content')
            </div>
        </main>

    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>