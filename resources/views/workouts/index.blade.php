@extends('layouts.app')

@section('content')
    <style>
        /* Estilos para o Layout e Botões */
        .sport-opt.active {
            border-color: #CAFF00 !important;
            background: rgba(202, 255, 0, 0.06);
        }

        .active-sport {
            border-color: #CAFF00 !important;
            color: #CAFF00 !important;
            background: rgba(202, 255, 0, 0.05);
        }

        /* Scrollbar Custom */
        #modal-box::-webkit-scrollbar {
            width: 4px;
        }

        #modal-box::-webkit-scrollbar-track {
            background: #08090D;
        }

        #modal-box::-webkit-scrollbar-thumb {
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
                                class="text-[11px] font-bold tracking-[0.35em] text-[#CAFF00] uppercase font-['Barlow_Condensed',sans-serif]">Planos
                                de Treino</span>
                        </div>
                        <h1 class="font-['Barlow_Condensed',sans-serif] font-black uppercase text-white leading-[0.9]"
                            style="font-size:clamp(40px,6vw,80px)">
                            MEUS <span class="text-[#CAFF00]">TREINOS</span>
                        </h1>
                    </div>
                    <button id="btn-new-workout"
                        class="flex items-center gap-3 bg-[#CAFF00] text-black font-['Barlow_Condensed',sans-serif] font-black text-[13px] tracking-[0.15em] uppercase px-6 py-4 hover:shadow-[0_0_30px_rgba(202,255,0,0.3)] transition-all">
                        <i class="fas fa-plus text-xs"></i> NOVO TREINO
                    </button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-10 max-w-2xl">
                    <div class="bg-[#0e0f14] border border-white/5 p-4">
                        <div id="stat-total" class="font-black text-[#CAFF00] text-4xl font-['Barlow_Condensed']">0</div>
                        <div class="text-[#555] text-[10px] uppercase tracking-widest mt-1">Treinos</div>
                    </div>
                    <div class="bg-[#0e0f14] border border-white/5 p-4">
                        <div id="stat-esportes" class="font-black text-white text-4xl font-['Barlow_Condensed']">0</div>
                        <div class="text-[#555] text-[10px] uppercase tracking-widest mt-1">Esportes</div>
                    </div>
                    <div class="bg-[#0e0f14] border border-white/5 p-4">
                        <div id="stat-exercises" class="font-black text-white text-4xl font-['Barlow_Condensed']">0</div>
                        <div class="text-[#555] text-[10px] uppercase tracking-widest mt-1">Exercícios</div>
                    </div>
                </div>
            </div>

            <div class="px-6 md:px-16 py-8 flex flex-wrap gap-3" id="sport-filters">
                <button data-sport="all"
                    class="sport-filter-btn active-sport font-black text-[10px] uppercase px-4 py-2 border border-[#CAFF00] text-[#CAFF00]">TODOS</button>
            </div>

            <div class="px-6 md:px-16 pb-20">
                <div id="loading-state" class="py-20 text-center"><i
                        class="fas fa-spinner fa-spin text-[#CAFF00] text-3xl"></i></div>
                <div id="workouts-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 hidden">
                </div>
                <div id="empty-state"
                    class="hidden flex flex-col items-center justify-center py-20 border border-dashed border-white/5">
                    <h3 class="text-white font-black uppercase">Nenhum treino encontrado</h3>
                    <button id="btn-empty-new"
                        class="mt-4 bg-[#CAFF00] text-black font-black text-[10px] px-6 py-3 uppercase">CRIAR AGORA</button>
                </div>
            </div>
        </div>

        <div id="modal-overlay"
            class="fixed inset-0 bg-black/90 backdrop-blur-md z-[100] hidden items-center justify-center p-4">
            <div id="modal-box"
                class="bg-[#0e0f14] border border-white/10 w-full max-w-2xl max-h-[90vh] overflow-y-auto p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 id="modal-title" class="font-black text-2xl text-white uppercase italic">NOVO TREINO</h2>
                    <button id="btn-close-modal" class="text-[#555] hover:text-white"><i class="fas fa-times"></i></button>
                </div>

                <div class="space-y-6">
                    <input type="hidden" id="workout-id">
                    <div>
                        <label class="block text-[10px] text-[#555] uppercase font-bold mb-2 tracking-widest">Nome do Treino
                            *</label>
                        <input type="text" id="field-title"
                            class="w-full bg-white/5 border border-white/10 p-3 text-white outline-none focus:border-[#CAFF00]">
                    </div>
                    <div>
                        <label class="block text-[10px] text-[#555] uppercase font-bold mb-2 tracking-widest">Esporte
                            *</label>
                        <div id="sport-picker" class="grid grid-cols-3 sm:grid-cols-6 gap-2"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-[10px] text-[#555] uppercase font-bold mb-2 tracking-widest">Dificuldade</label>
                            <select id="field-difficulty"
                                class="w-full bg-white/5 border border-white/10 p-3 text-white outline-none appearance-none focus:border-[#CAFF00]">
                                <option value="iniciante">Iniciante</option>
                                <option value="intermediario">Intermediário</option>
                                <option value="avancado">Avançado</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] text-[#555] uppercase font-bold mb-2 tracking-widest">Duração
                                (min)</label>
                            <input type="number" id="field-duration"
                                class="w-full bg-white/5 border border-white/10 p-3 text-white outline-none focus:border-[#CAFF00]">
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <label class="text-[10px] text-[#555] uppercase font-bold tracking-widest">Exercícios</label>
                            <button id="btn-add-exercise"
                                class="text-[#CAFF00] text-[10px] font-black uppercase hover:underline">+ Adicionar</button>
                        </div>
                        <div id="exercises-list" class="space-y-3"></div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-white/5">
                    <button id="btn-cancel" class="text-[#555] uppercase font-black text-[11px]">Cancelar</button>
                    <button id="btn-submit"
                        class="bg-[#CAFF00] text-black px-8 py-3 font-black text-[11px] uppercase flex items-center gap-2">
                        Salvar <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="delete-overlay" class="fixed inset-0 bg-black/95 z-[110] hidden items-center justify-center p-4">
            <div class="bg-[#0e0f14] border border-red-500/30 p-8 max-w-sm text-center">
                <h3 class="text-white font-black mb-2 uppercase italic">Remover Treino?</h3>
                <div class="flex gap-4 mt-6">
                    <button id="btn-cancel-delete" class="flex-1 text-[#555] font-bold text-[10px] uppercase">Sair</button>
                    <button id="btn-confirm-delete"
                        class="flex-1 bg-red-600 text-white font-bold text-[10px] py-3 uppercase">Excluir</button>
                </div>
            </div>
        </div>

        <div id="toast"
            class="fixed bottom-8 right-8 z-[200] flex items-center gap-4 bg-[#0e0f14] border border-white/10 p-4 translate-y-4 opacity-0 transition-all duration-300">
            <div id="toast-msg" class="text-[10px] font-black uppercase tracking-widest text-white"></div>
        </div>
        <script src="{{ asset('js/workouts.js') }}"></script>


    </body>
@endsection