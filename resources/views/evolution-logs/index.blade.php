@extends('layouts.app')

@section('content')
<body class="bg-[#08090D] min-h-screen font-['Barlow',sans-serif] text-white">

    <div class="pt-[70px] md:pl-[3px] px-6 md:px-16">
        <!-- Cabeçalho -->
        <div class="flex items-center gap-2 mb-6">
            <span class="w-6 h-[2px] bg-[#CAFF00] block"></span>
            <span class="text-[11px] font-bold tracking-[0.35em] text-[#CAFF00] uppercase font-['Barlow_Condensed',sans-serif]">
                Relatório
            </span>
        </div>

        <h1 class="font-['Barlow_Condensed',sans-serif] font-black uppercase text-white leading-[0.9]"
            style="font-size: clamp(40px, 6vw, 80px)">
            Minha <span class="text-[#CAFF00]">Performance</span>
        </h1>

        <!-- Estatísticas principais -->
        <div class="grid grid-cols-3 gap-6 mt-10">
            <div class="bg-[#0e0f14] border border-white/5 p-6 text-center">
                <div id="perf-total" class="text-4xl font-black text-[#CAFF00]">0</div>
                <p class="text-xs text-[#555] uppercase tracking-widest mt-2">Objetivos Totais</p>
            </div>
            <div class="bg-[#0e0f14] border border-white/5 p-6 text-center">
                <div id="perf-done" class="text-4xl font-black text-white">0</div>
                <p class="text-xs text-[#555] uppercase tracking-widest mt-2">Concluídos</p>
            </div>
            <div class="bg-[#0e0f14] border border-white/5 p-6 text-center">
                <div id="perf-progress" class="text-4xl font-black text-[#CAFF00]">0%</div>
                <p class="text-xs text-[#555] uppercase tracking-widest mt-2">Progresso</p>
            </div>
        </div>

        <!-- Gráfico -->
        <div class="mt-12 bg-[#0e0f14] border border-white/5 p-8">
            <canvas id="performanceChart"></canvas>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/performance.js') }}"></script>
</body>
@endsection
