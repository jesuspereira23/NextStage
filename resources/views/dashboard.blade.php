@extends('layouts.app')

@section('content')

    <div class="min-h-screen">

        {{-- ── TOP BAR ── --}}
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-3">
                <div
                    class="w-11 h-11 rounded-full bg-[#CAFF00]/10 border-2 border-[#CAFF00] flex items-center justify-center font-black text-[#CAFF00] text-base shrink-0">
                    U
                </div>
                <div>
                    <p class="text-[10px] text-zinc-500 font-bold tracking-widest uppercase">Bem-vindo de volta</p>
                    <p class="font-black text-xl leading-tight text-white">Atleta</p>
                </div>
            </div>
            <div class="text-right">
                <p id="clock" class="font-black text-2xl text-[#CAFF00] leading-none tabular-nums"></p>
                <p class="text-[10px] text-zinc-500 mt-0.5 uppercase tracking-widest"></p>
            </div>
        </div>

        {{-- ── STATS ROW ── --}}
        <div class="grid grid-cols-3 gap-3 mb-6">
            <div class="bg-[#161616] border border-white/[.06] rounded-2xl p-4 flex flex-col gap-1">
                <p class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold">Treinos</p>
                <p class="font-black text-2xl text-white leading-none" id="statWorkouts">—</p>
                <p class="text-[10px] text-zinc-600">esta semana</p>
            </div>
            <div class="bg-[#161616] border border-white/[.06] rounded-2xl p-4 flex flex-col gap-1">
                <p class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold">Objetivos</p>
                <p class="font-black text-2xl text-white leading-none" id="statObjectives">—</p>
                <p class="text-[10px] text-zinc-600">ativos</p>
            </div>
            <div class="bg-[#161616] border border-white/[.06] rounded-2xl p-4 flex flex-col gap-1">
                <p class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold">Evolução</p>
                <p class="font-black text-2xl text-[#CAFF00] leading-none" id="statLogs">—</p>
                <p class="text-[10px] text-zinc-600">registros</p>
            </div>
        </div>

        {{-- ── HERO CARD ── --}}
        <div class="relative w-full h-44 rounded-2xl overflow-hidden mb-4 cursor-pointer group">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&q=80&w=900"
                class="w-full h-full object-cover opacity-30 group-hover:opacity-40 group-hover:scale-105 transition-all duration-500"
                alt="Treino">
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent flex items-center px-6 gap-5">
                <div
                    class="w-14 h-14 bg-[#CAFF00] rounded-full flex items-center justify-center shadow-[0_0_28px_rgba(202,255,0,0.5)] group-hover:scale-110 transition-all duration-200 shrink-0">
                    <a href="/workouts">
                        <svg class="w-6 h-6 text-black ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </a>
                </div>
                <div>
                    <p class="text-[10px] text-[#CAFF00] font-bold uppercase tracking-widest mb-0.5">Treino do dia</p>
                    <p class="font-black text-xl text-white leading-tight" id="workoutTitle">Nenhum treino hoje</p>
                    <p class="text-xs text-zinc-400 mt-0.5" id="workoutMeta">Crie seu primeiro treino</p>
                </div>
            </div>
        </div>

        {{-- ── CTA ── --}}
        <a href="/workouts" id="workoutCta"
            class="flex items-center justify-center gap-2 w-full py-3.5 bg-[#CAFF00] hover:bg-[#b3e600] text-black font-black text-sm rounded-2xl transition-all mb-6 shadow-[0_4px_22px_rgba(202,255,0,0.25)] hover:shadow-[0_6px_32px_rgba(202,255,0,0.4)] active:scale-[.98]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Ver meus treinos
        </a>

        {{-- ── MAIN GRID ── --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Objetivos recentes --}}
            <div class="bg-[#161616] border border-white/[.06] rounded-2xl p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-black text-sm text-white uppercase tracking-wide">Meus Objetivos</h3>
                    <a href="/objectives"
                        class="text-[10px] text-[#CAFF00] font-bold uppercase tracking-widest hover:opacity-70 transition-opacity">Ver
                        todos</a>
                </div>
                <div id="objectivesList">
                    <div class="flex flex-col items-center justify-center py-6 text-zinc-600">
                        <div class="w-5 h-5 border-2 border-zinc-700 border-t-[#CAFF00] rounded-full animate-spin mb-3">
                        </div>
                        <p class="text-xs">Carregando...</p>
                    </div>
                </div>
            </div>

            {{-- Evolução --}}
            <div class="bg-[#161616] border border-white/[.06] rounded-2xl p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-black text-sm text-white uppercase tracking-wide">Evolução</h3>
                    <a href="/evolution-logs"
                        class="text-[10px] text-[#CAFF00] font-bold uppercase tracking-widest hover:opacity-70 transition-opacity">Ver
                        todos</a>
                </div>
                <div id="evolutionContent">
                    <div class="flex flex-col items-center justify-center py-6 text-zinc-600">
                        <div class="w-5 h-5 border-2 border-zinc-700 border-t-[#CAFF00] rounded-full animate-spin mb-3">
                        </div>
                        <p class="text-xs">Carregando...</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── GESTÃO ── --}}
        <div class="mt-6">
            <p class="text-[10px] text-zinc-600 font-bold uppercase tracking-widest mb-3">Gestão</p>
            <div class="grid grid-cols-4 gap-3">

                <a href="/objectives"
                    class="group bg-[#161616] border border-white/[.06] hover:border-[#CAFF00]/40 rounded-2xl p-4 flex flex-col items-center gap-2 transition-all hover:-translate-y-0.5">
                    <div
                        class="w-10 h-10 rounded-xl bg-[#CAFF00]/10 flex items-center justify-center text-[#CAFF00] group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span
                        class="font-bold text-[10px] uppercase tracking-wide text-zinc-400 group-hover:text-white transition-colors">Objetivos</span>
                </a>

                <a href="/workouts"
                    class="group bg-[#161616] border border-white/[.06] hover:border-[#CAFF00]/40 rounded-2xl p-4 flex flex-col items-center gap-2 transition-all hover:-translate-y-0.5">
                    <div
                        class="w-10 h-10 rounded-xl bg-[#CAFF00]/10 flex items-center justify-center text-[#CAFF00] group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                    </div>
                    <span
                        class="font-bold text-[10px] uppercase tracking-wide text-zinc-400 group-hover:text-white transition-colors">Treinos</span>
                </a>

                <a href="/exercises"
                    class="group bg-[#161616] border border-white/[.06] hover:border-[#CAFF00]/40 rounded-2xl p-4 flex flex-col items-center gap-2 transition-all hover:-translate-y-0.5">
                    <div
                        class="w-10 h-10 rounded-xl bg-[#CAFF00]/10 flex items-center justify-center text-[#CAFF00] group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                    <span
                        class="font-bold text-[10px] uppercase tracking-wide text-zinc-400 group-hover:text-white transition-colors">Exercícios</span>
                </a>

                <a href="/evolution-logs"
                    class="group bg-[#161616] border border-white/[.06] hover:border-[#CAFF00]/40 rounded-2xl p-4 flex flex-col items-center gap-2 transition-all hover:-translate-y-0.5">
                    <div
                        class="w-10 h-10 rounded-xl bg-[#CAFF00]/10 flex items-center justify-center text-[#CAFF00] group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <span
                        class="font-bold text-[10px] uppercase tracking-wide text-zinc-400 group-hover:text-white transition-colors">Evolução</span>
                </a>

            </div>
        </div>

    </div>

@endsection