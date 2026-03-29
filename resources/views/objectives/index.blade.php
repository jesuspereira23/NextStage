@extends('layouts.app')

@section('content')
    <style>
        /* Estilização para o checkbox customizado */
        .custom-checkbox:checked+div {
            background-color: #CAFF00;
            border-color: #CAFF00;
        }

        /* Scrollbar estilizada para o tema dark */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #08090D;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #CAFF00;
        }
    </style>

    <body class="bg-[#08090D] min-h-screen font-['Barlow',sans-serif] text-white">

        <div class="fixed left-0 top-[70px] bottom-0 w-[3px] bg-[#CAFF00] z-10 hidden md:block"></div>

        <div class="pt-[70px] md:pl-[3px]">

            <div class="px-6 md:px-16 pt-14 pb-10 border-b border-[rgba(255,255,255,0.04)]">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-6 h-[2px] bg-[#CAFF00] block"></span>
                            <span
                                class="text-[11px] font-bold tracking-[0.35em] text-[#CAFF00] uppercase font-['Barlow_Condensed',sans-serif]">Semana
                                Atual</span>
                        </div>
                        <h1 class="font-['Barlow_Condensed',sans-serif] font-black uppercase text-white leading-[0.9]"
                            style="font-size: clamp(40px, 6vw, 80px)">
                            MEUS <span class="text-[#CAFF00]">OBJETIVOS</span>
                        </h1>
                    </div>
                    <button id="btn-new-objective"
                        class="flex items-center gap-3 bg-[#CAFF00] text-black font-['Barlow_Condensed',sans-serif] font-black text-[13px] tracking-[0.15em] uppercase px-8 py-4 hover:shadow-[0_0_30px_rgba(202,255,0,0.3)] transition-all duration-300">
                        <i class="fas fa-plus"></i> NOVO OBJETIVO
                    </button>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-10 max-w-lg">
                    <div class="bg-[#0e0f14] border border-white/5 p-4">
                        <div id="stat-total" class="font-black text-[#CAFF00] text-4xl font-['Barlow_Condensed']">0</div>
                        <div class="text-[#555] text-[10px] uppercase tracking-widest mt-1 font-bold">Total</div>
                    </div>
                    <div class="bg-[#0e0f14] border border-white/5 p-4">
                        <div id="stat-done" class="font-black text-white text-4xl font-['Barlow_Condensed']">0</div>
                        <div class="text-[#555] text-[10px] uppercase tracking-widest mt-1 font-bold">Feitos</div>
                    </div>
                    <div class="bg-[#0e0f14] border border-white/5 p-4">
                        <div id="stat-pct" class="font-black text-[#CAFF00] text-4xl font-['Barlow_Condensed']">0%</div>
                        <div class="text-[#555] text-[10px] uppercase tracking-widest mt-1 font-bold">Progresso</div>
                    </div>
                </div>
            </div>

            <div class="px-6 md:px-16 py-12">
                <div class="flex gap-4 mb-8">
                    <button data-filter="all"
                        class="filter-btn text-[#CAFF00] border-b-2 border-[#CAFF00] pb-2 text-xs font-bold uppercase tracking-widest">Todos</button>
                    <button data-filter="pending"
                        class="filter-btn text-[#555] pb-2 text-xs font-bold uppercase tracking-widest hover:text-white">Pendentes</button>
                    <button data-filter="done"
                        class="filter-btn text-[#555] pb-2 text-xs font-bold uppercase tracking-widest hover:text-white">Concluídos</button>
                </div>

                <div id="objectives-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                </div>

                <div id="loading-state" class="py-20 text-center">
                    <div
                        class="inline-block w-8 h-8 border-4 border-[#CAFF00] border-t-transparent rounded-full animate-spin">
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-overlay"
            class="fixed inset-0 bg-black/90 backdrop-blur-md z-50 hidden items-center justify-center p-4">
            <div class="bg-[#0e0f14] border border-[#CAFF00]/20 w-full max-w-md p-8 shadow-2xl">
                <h2 id="modal-title" class="font-['Barlow_Condensed'] font-black text-2xl text-white uppercase mb-6">NOVO
                    OBJETIVO</h2>
                <form id="objective-form" class="space-y-5">
                    <input type="hidden" id="objective-id">
                    <div>
                        <label class="text-[10px] text-[#CAFF00] font-bold uppercase block mb-1">Título</label>
                        <input id="field-title" required type="text"
                            class="w-full bg-white/5 border border-white/10 p-3 text-white outline-none focus:border-[#CAFF00]">
                    </div>
                    <div>
                        <label class="text-[10px] text-[#CAFF00] font-bold uppercase block mb-1">Descrição</label>
                        <textarea id="field-description" rows="2"
                            class="w-full bg-white/5 border border-white/10 p-3 text-white outline-none focus:border-[#CAFF00]"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] text-[#CAFF00] font-bold uppercase block mb-1">Categoria</label>
                            <select id="field-category"
                                class="w-full bg-white/5 border border-white/10 p-3 text-white outline-none">
                                <option value="treino">🏋️ Treino</option>
                                <option value="nutricao">🥗 Nutrição</option>
                                <option value="mental">🧠 Mental</option>
                                <option value="outro">🎯 Outro</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] text-[#CAFF00] font-bold uppercase block mb-1">Prioridade</label>
                            <select id="field-priority"
                                class="w-full bg-white/5 border border-white/10 p-3 text-white outline-none">
                                <option value="alta">🔴 Alta</option>
                                <option value="media">🟡 Média</option>
                                <option value="baixa">🟢 Baixa</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 bg-[#CAFF00] text-black font-black py-4 uppercase text-xs">Salvar
                            Objetivo</button>
                        <button type="button" onclick="closeModal()"
                            class="px-6 border border-white/10 text-white font-black py-4 uppercase text-xs">Sair</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="delete-overlay" class="fixed inset-0 bg-black/90 z-[60] hidden items-center justify-center">
            <div class="bg-[#0e0f14] border border-red-500/30 p-8 text-center max-w-xs">
                <i class="fas fa-trash text-red-500 text-3xl mb-4"></i>
                <h3 class="text-white font-black uppercase mb-6">Excluir Objetivo?</h3>
                <div class="flex gap-3">
                    <button id="btn-confirm-delete"
                        class="flex-1 bg-red-600 text-white font-black py-3 uppercase text-xs">Sim, Remover</button>
                    <button onclick="closeDeleteModal()"
                        class="flex-1 border border-white/10 text-white py-3 uppercase text-xs">Não</button>
                </div>
            </div>
        </div>

        <div id="toast" class="fixed bottom-8 right-8 z-[100] opacity-0 translate-y-4 transition-all duration-300">
            <div
                class="bg-white text-black px-6 py-4 font-black uppercase text-xs tracking-widest shadow-2xl flex items-center gap-3">
                <i class="fas fa-check text-green-600"></i>
                <span id="toast-msg">Sucesso!</span>
            </div>
        </div>
        <script src="{{ asset('js/objectives.js') }}"></script>
    </body>
@endsection