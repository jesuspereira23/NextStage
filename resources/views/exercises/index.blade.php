@extends('layouts.app')
@section('content')

    <div class="bg-[#08090D] min-h-screen text-white font-sans selection:bg-[#CAFF00] selection:text-black">

        <div
            class="fixed left-0 top-[70px] bottom-0 w-[3px] bg-[#CAFF00] z-10 hidden md:block shadow-[0_0_15px_rgba(202,255,0,0.3)]">
        </div>

        <div class="pt-[70px] md:pl-[3px]">

            <div
                class="px-6 md:px-16 pt-16 pb-12 border-b border-white/[0.03] bg-gradient-to-b from-white/[0.02] to-transparent">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="w-8 h-[2px] bg-[#CAFF00]"></span>
                            <span class="text-[11px] font-black tracking-[0.4em] text-[#CAFF00] uppercase italic">Biblioteca
                                Técnica</span>
                        </div>
                        <h1 class="font-black uppercase text-white leading-[0.85] tracking-tighter italic"
                            style="font-size:clamp(45px,7vw,90px)">
                            MEUS <span class="text-[#CAFF00] drop-shadow-[0_0_15px_rgba(202,255,0,0.2)]">EXERCÍCIOS</span>
                        </h1>
                        <p class="text-zinc-500 text-sm mt-4 max-w-md font-medium uppercase tracking-tight">Catálogo de
                            movimentos e protocolos de carga por grupamento.</p>
                    </div>
                    <button id="btn-new"
                        class="group flex items-center gap-3 bg-[#CAFF00] text-black font-black text-[13px] tracking-[0.1em] uppercase px-8 py-5 hover:shadow-[0_0_30px_rgba(202,255,0,0.3)] hover:-translate-y-1 transition-all duration-300 self-start italic">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                        </svg>
                        NOVO EXERCÍCIO
                    </button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-1 mt-14 max-w-3xl bg-white/[0.05] p-[1px] rounded-sm">
                    <div class="bg-[#0e0f14] p-6">
                        <div id="stat-total" class="font-black text-[#CAFF00] text-4xl italic leading-none">0</div>
                        <div class="text-zinc-600 text-[10px] uppercase font-bold tracking-[0.2em] mt-2">Exercícios</div>
                    </div>
                    <div class="bg-[#0e0f14] p-6">
                        <div id="stat-avg-sets" class="font-black text-white text-4xl italic leading-none">—</div>
                        <div class="text-zinc-600 text-[10px] uppercase font-bold tracking-[0.2em] mt-2">Média Séries</div>
                    </div>
                    <div class="bg-[#0e0f14] p-6">
                        <div id="stat-avg-reps" class="font-black text-[#CAFF00] text-4xl italic leading-none">—</div>
                        <div class="text-zinc-600 text-[10px] uppercase font-bold tracking-[0.2em] mt-2">Média Reps</div>
                    </div>
                    <div class="bg-[#0e0f14] p-6">
                        <div id="stat-workouts" class="font-black text-white text-4xl italic leading-none">0</div>
                        <div class="text-zinc-600 text-[10px] uppercase font-bold tracking-[0.2em] mt-2">Treinos</div>
                    </div>
                </div>
            </div>

            <div class="px-6 md:px-16 py-6 border-b border-white/[0.03] flex flex-col lg:flex-row gap-6 bg-[#0c0d12]">
                <div class="relative flex-1 max-w-xl group">
                    <div
                        class="absolute inset-y-0 left-4 flex items-center pointer-events-none transition-colors group-focus-within:text-[#CAFF00]">
                        <svg class="w-4 h-4 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input id="search-input" type="text" placeholder="FILTRAR POR NOME DO EXERCÍCIO..."
                        class="w-full bg-white/[0.02] border border-white/5 text-white text-[11px] font-black tracking-widest pl-12 pr-4 py-4 outline-none focus:border-[#CAFF00]/50 focus:bg-white/[0.04] transition-all placeholder-zinc-800" />
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-[10px] text-zinc-600 font-black uppercase tracking-widest mr-2">Organizar:</span>
                    <select id="workout-filter"
                        class="bg-[#0e0f14] border border-white/5 text-zinc-400 text-[10px] font-black uppercase tracking-widest px-6 py-4 outline-none focus:border-[#CAFF00] cursor-pointer hover:bg-zinc-900 transition-colors">
                        <option value="">Filtrar por Treino</option>
                    </select>
                    <select id="sort-select"
                        class="bg-[#0e0f14] border border-white/5 text-zinc-400 text-[10px] font-black uppercase tracking-widest px-6 py-4 outline-none focus:border-[#CAFF00] cursor-pointer hover:bg-zinc-900 transition-colors">
                        <option value="name">Nome A-Z</option>
                        <option value="sets">Volume (Séries)</option>
                        <option value="reps">Repetições</option>
                        <option value="newest">Recentes</option>
                    </select>
                </div>
            </div>

            <div class="px-6 md:px-16 py-12">

                <div id="loading-state" class="flex items-center justify-center py-40">
                    <div class="flex gap-2">
                        <div class="w-3 h-3 bg-[#CAFF00] animate-[bounce_1s_infinite_0ms]"></div>
                        <div class="w-3 h-3 bg-[#CAFF00] animate-[bounce_1s_infinite_200ms]"></div>
                        <div class="w-3 h-3 bg-[#CAFF00] animate-[bounce_1s_infinite_400ms]"></div>
                    </div>
                </div>

                <div id="table-header" class="hidden lg:grid grid-cols-[2fr_1fr_100px_100px_100px_80px] gap-6 px-6 mb-4">
                    <span
                        class="text-[10px] text-zinc-600 uppercase tracking-[0.3em] font-black italic">Identificação</span>
                    <span class="text-[10px] text-zinc-600 uppercase tracking-[0.3em] font-black italic">Vínculo</span>
                    <span
                        class="text-[10px] text-zinc-600 uppercase tracking-[0.3em] font-black italic text-center">Séries</span>
                    <span
                        class="text-[10px] text-zinc-600 uppercase tracking-[0.3em] font-black italic text-center">Reps</span>
                    <span
                        class="text-[10px] text-zinc-600 uppercase tracking-[0.3em] font-black italic text-center">Rest</span>
                    <span></span>
                </div>

                <div id="exercises-list" class="flex flex-col gap-2 hidden"></div>

                <div id="empty-state"
                    class="hidden flex-col items-center justify-center py-40 text-center border-2 border-dashed border-white/5 bg-white/[0.01]">
                    <div
                        class="w-24 h-24 bg-zinc-900 flex items-center justify-center rounded-full mb-8 border border-white/5">
                        <svg class="w-10 h-10 text-zinc-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="font-black text-2xl text-zinc-700 uppercase italic">Biblioteca Vazia</h3>
                    <p
                        class="text-zinc-600 text-[11px] font-bold uppercase tracking-widest mt-2 mb-10 max-w-xs leading-relaxed">
                        Sua infraestrutura de treino ainda não possui movimentos registrados.</p>
                    <button onclick="document.getElementById('btn-new').click()"
                        class="bg-zinc-800 text-white font-black text-[11px] uppercase tracking-[0.2em] px-10 py-5 hover:bg-[#CAFF00] hover:text-black transition-all italic shadow-xl">
                        ADICIONAR PRIMEIRO MOVIMENTO
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── Modal Criar / Editar ──────────────────────────────── --}}
    {{-- IMPORTANTE: modal-box NÃO tem opacity-0 nem scale-95 — o JS controla a visibilidade --}}
    <div id="modal-overlay" class="fixed inset-0 bg-black/95 backdrop-blur-md z-50 hidden items-center justify-center p-4">
        <div id="modal-box"
            class="bg-[#0e0f14] border border-white/10 w-full max-w-xl relative shadow-[0_0_80px_rgba(0,0,0,0.6)]">

            <div
                class="flex items-center justify-between px-10 py-8 border-b border-white/5 bg-gradient-to-r from-[#CAFF00]/5 to-transparent">
                <div>
                    <span class="text-[10px] text-[#CAFF00] uppercase tracking-[0.4em] font-black block mb-1">Configuração
                        de Carga</span>
                    <h2 id="modal-title"
                        class="font-black text-white text-3xl uppercase italic leading-none tracking-tighter">Novo Exercício
                    </h2>
                </div>
                <button id="btn-close"
                    class="w-10 h-10 bg-white/5 flex items-center justify-center text-zinc-500 hover:text-[#CAFF00] transition-all rounded-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-10 py-10 flex flex-col gap-8">
                <input type="hidden" id="exercise-id">

                <div class="space-y-3">
                    <label class="text-[11px] text-zinc-500 uppercase tracking-[0.2em] font-black block">Treino Designado
                        *</label>
                    <div class="relative">
                        <select id="field-workout"
                            class="w-full bg-zinc-900 border border-white/10 text-white text-[11px] font-black uppercase tracking-widest p-4 outline-none focus:border-[#CAFF00] appearance-none cursor-pointer">
                            <option value="">Selecione um treino</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-zinc-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[11px] text-zinc-500 uppercase tracking-[0.2em] font-black block">Nomenclatura
                        Técnica *</label>
                    <input id="field-name" type="text" placeholder="Ex: AGACHAMENTO SUMÔ C/ KETTLEBELL"
                        class="w-full bg-white/[0.03] border-b-2 border-white/10 text-white text-lg px-0 py-4 outline-none focus:border-[#CAFF00] transition-all placeholder-zinc-800 font-bold uppercase tracking-tight" />
                </div>

                <div class="grid grid-cols-3 gap-6">
                    <div class="space-y-3">
                        <label class="text-[11px] text-zinc-500 uppercase tracking-[0.2em] font-black block">Séries</label>
                        <input id="field-sets" type="number" placeholder="4"
                            class="w-full bg-zinc-900 border border-white/10 text-[#CAFF00] text-sm font-black p-4 outline-none focus:border-[#CAFF00] transition-all" />
                    </div>
                    <div class="space-y-3">
                        <label class="text-[11px] text-zinc-500 uppercase tracking-[0.2em] font-black block">Reps</label>
                        <input id="field-reps" type="number" placeholder="12"
                            class="w-full bg-zinc-900 border border-white/10 text-white text-sm font-black p-4 outline-none focus:border-[#CAFF00] transition-all" />
                    </div>
                    <div class="space-y-3">
                        <label class="text-[11px] text-zinc-500 uppercase tracking-[0.2em] font-black block">Rest
                            (s)</label>
                        <input id="field-rest" type="number" placeholder="60"
                            class="w-full bg-zinc-900 border border-white/10 text-white text-sm font-black p-4 outline-none focus:border-[#CAFF00] transition-all" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-3">
                        <label
                            class="text-[11px] text-zinc-500 uppercase tracking-[0.2em] font-black block">Sequência</label>
                        <input id="field-order" type="number" placeholder="0"
                            class="w-full bg-zinc-900 border border-white/10 text-white text-sm font-black p-4 outline-none focus:border-[#CAFF00] transition-all" />
                    </div>
                    <div class="md:col-span-3 space-y-3">
                        <label class="text-[11px] text-zinc-500 uppercase tracking-[0.2em] font-black block">Observações
                            Técnicas</label>
                        <input id="field-notes" type="text" placeholder="Execução, cadência ou equipamento..."
                            class="w-full bg-zinc-900 border border-white/10 text-zinc-400 text-xs p-4 outline-none focus:border-[#CAFF00] transition-all font-medium" />
                    </div>
                </div>

                <div id="form-error"
                    class="hidden text-[10px] font-black uppercase tracking-widest text-red-400 bg-red-900/10 border border-red-500/20 px-6 py-4 italic">
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button id="btn-submit"
                        class="flex-1 bg-[#CAFF00] text-black font-black text-sm tracking-[0.15em] uppercase px-8 py-5 hover:shadow-[0_0_40px_rgba(202,255,0,0.3)] transition-all flex items-center justify-center gap-3 italic active:scale-95">
                        <span id="btn-submit-text">ADICIONAR</span>
                        <i id="btn-submit-icon" class="fas fa-plus text-xs"></i>
                    </button>
                    <button id="btn-cancel"
                        class="px-8 py-5 border border-white/10 text-zinc-500 font-black text-[11px] uppercase tracking-[0.2em] hover:border-white hover:text-white transition-all italic">
                        CANCELAR
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── Modal Deletar ─────────────────────────────────────── --}}
    <div id="delete-overlay" class="fixed inset-0 bg-black/98 backdrop-blur-lg z-50 hidden items-center justify-center p-4">
        <div
            class="bg-[#0e0f14] border border-red-900/30 w-full max-w-sm p-10 text-center shadow-[0_0_80px_rgba(220,38,38,0.1)]">
            <div
                class="w-20 h-20 bg-red-900/10 flex items-center justify-center mx-auto mb-8 rounded-full border border-red-900/20">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <h3 class="font-black text-2xl text-white uppercase italic mb-3">Expurgar Registro?</h3>
            <p class="text-zinc-500 text-[11px] font-bold uppercase tracking-widest mb-10 leading-relaxed">Esta operação
                removerá o exercício permanentemente da sua biblioteca.</p>
            <div class="grid grid-cols-2 gap-4">
                <button id="btn-confirm-delete"
                    class="bg-red-600 hover:bg-red-700 text-white font-black text-[11px] uppercase tracking-widest py-5 transition-all italic">EXCLUIR</button>
                <button id="btn-cancel-delete"
                    class="border border-white/10 text-zinc-600 font-black text-[11px] uppercase tracking-widest py-5 hover:text-white hover:border-white transition-all italic">MANTER</button>
            </div>
        </div>
    </div>

    {{-- ─── Toast ─────────────────────────────────────────────── --}}
    <div id="toast"
        class="fixed bottom-10 right-10 z-[100] translate-y-6 opacity-0 transition-all duration-500 pointer-events-none">
        <div
            class="flex items-center gap-4 px-8 py-5 bg-[#0e0f14] border-l-4 border-[#CAFF00] shadow-[0_25px_60px_rgba(0,0,0,0.6)]">
            <div class="bg-[#CAFF00]/10 p-2 rounded-full">
                <i id="toast-icon" class="fas fa-check text-[#CAFF00] text-sm"></i>
            </div>
            <span id="toast-msg" class="text-white text-[11px] font-black uppercase tracking-[0.2em] italic"></span>
        </div>
    </div>

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <script src="{{ asset('js/auth.js') }}"></script>
    <script src="{{ asset('js/exercises.js') }}"></script>

@endsection