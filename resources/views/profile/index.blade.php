@extends('layouts.app')
@section('content')
  @php
    $user = auth()->user();
    $userName = $user?->name ?? 'Atleta';
    $userEmail = $user?->email ?? '';
    $userInitial = strtoupper(substr($userName, 0, 1));
    $userSince = $user?->created_at ? $user->created_at->format('Y') : '2024';
    $userSinceDay = $user?->created_at ? $user->created_at->format('d/m/Y') : '—';
    $userLastSeen = $user?->updated_at ? $user->updated_at->diffForHumans() : '—';
    $userAvatar = $user?->avatar ?? null;
  @endphp

  <div class="bg-[#08090D] min-h-screen text-white font-sans selection:bg-[#CAFF00] selection:text-black">

    <!-- Barra lateral verde -->
    <div
      class="fixed left-0 top-[70px] bottom-0 w-[3px] bg-[#CAFF00] z-10 hidden md:block shadow-[0_0_15px_rgba(202,255,0,0.3)]">
    </div>

    <div class="pt-[70px] md:pl-[3px]">

      <!-- ─── HERO DO PERFIL ──────────────────────────────────── -->
      <div class="relative overflow-hidden border-b border-white/[0.03]">

        <!-- Grade diagonal decorativa -->
        <div class="absolute inset-0 opacity-[0.03]"
          style="background-image: repeating-linear-gradient(45deg, #CAFF00 0, #CAFF00 1px, transparent 0, transparent 50%); background-size: 20px 20px;">
        </div>

        <!-- Luz verde radial -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full opacity-[0.04]"
          style="background: radial-gradient(circle, #CAFF00 0%, transparent 70%);"></div>

        <div class="relative px-6 md:px-16 pt-16 pb-0">

          <!-- Tag de seção -->
          <div class="flex items-center gap-3 mb-8">
            <span class="w-8 h-[2px] bg-[#CAFF00]"></span>
            <span class="text-[11px] font-black tracking-[0.4em] text-[#CAFF00] uppercase italic">Identidade do
              Atleta</span>
          </div>

          <div class="flex flex-col lg:flex-row lg:items-end gap-10">

            <!-- Avatar + Info -->
            <div class="flex flex-col sm:flex-row items-start sm:items-end gap-8">

              <!-- Avatar -->
              <div class="relative flex-shrink-0">
                <div class="absolute -inset-[3px] bg-[#CAFF00] opacity-20"></div>
                <div class="absolute -inset-[6px] border border-[#CAFF00]/10"></div>
                <div
                  class="relative w-32 h-32 bg-[#0e0f14] border-2 border-[#CAFF00]/30 flex items-center justify-center overflow-hidden">
                  @if($userAvatar)
                    <img src="{{ $userAvatar }}" alt="Avatar" class="w-full h-full object-cover">
                  @else
                    <span
                      class="font-['Barlow_Condensed',sans-serif] font-black text-[#CAFF00] text-5xl italic leading-none select-none">
                      {{ $userInitial }}
                    </span>
                  @endif
                  <!-- Badge online -->
                  <div
                    class="absolute bottom-2 right-2 w-3 h-3 bg-[#CAFF00] rounded-full shadow-[0_0_8px_rgba(202,255,0,0.8)]">
                  </div>
                </div>
              </div>

              <!-- Nome e dados -->
              <div class="pb-1">
                <div class="text-[10px] text-zinc-600 font-black uppercase tracking-[0.3em] mb-2">
                  Atleta desde {{ $userSince }}
                </div>
                <h1
                  class="font-['Barlow_Condensed',sans-serif] font-black uppercase text-white leading-[0.85] tracking-tighter italic"
                  style="font-size: clamp(36px, 5vw, 72px)">
                  {{ $userName }}
                </h1>
                <div class="flex items-center gap-3 mt-3">
                  <span class="text-[10px] text-zinc-500 font-black uppercase tracking-widest">
                    {{ $userEmail }}
                  </span>
                </div>
              </div>
            </div>

            <div class="flex-1"></div>

            <!-- Botão editar -->
            <div class="pb-1">
              <button id="btn-edit-profile"
                class="flex items-center gap-3 border-2 border-[#CAFF00] text-[#CAFF00] font-black text-[11px] tracking-[0.2em] uppercase px-8 py-4 hover:bg-[#CAFF00] hover:text-black transition-all duration-300 italic">
                <i class="fas fa-pen text-xs"></i>
                EDITAR PERFIL
              </button>
            </div>
          </div>

          <!-- Stats bar -->
          <div class="grid grid-cols-2 md:grid-cols-4 mt-12 border-t border-white/[0.05]">
            <div class="py-6 pr-8 border-r border-white/[0.05]">
              <div id="stat-exercises"
                class="font-['Barlow_Condensed',sans-serif] font-black text-[#CAFF00] text-4xl italic leading-none">—
              </div>
              <div class="text-zinc-600 text-[10px] uppercase font-bold tracking-[0.2em] mt-2">Exercícios</div>
            </div>
            <div class="py-6 px-8 border-r border-white/[0.05]">
              <div id="stat-workouts"
                class="font-['Barlow_Condensed',sans-serif] font-black text-white text-4xl italic leading-none">—</div>
              <div class="text-zinc-600 text-[10px] uppercase font-bold tracking-[0.2em] mt-2">Treinos</div>
            </div>
            <div class="py-6 px-8 border-r border-white/[0.05]">
              <div id="stat-objectives"
                class="font-['Barlow_Condensed',sans-serif] font-black text-[#CAFF00] text-4xl italic leading-none">—
              </div>
              <div class="text-zinc-600 text-[10px] uppercase font-bold tracking-[0.2em] mt-2">Objetivos</div>
            </div>
            <div class="py-6 pl-8">
              <div id="stat-done"
                class="font-['Barlow_Condensed',sans-serif] font-black text-white text-4xl italic leading-none">—%</div>
              <div class="text-zinc-600 text-[10px] uppercase font-bold tracking-[0.2em] mt-2">Concluídos</div>
            </div>
          </div>
        </div>
      </div>

      <!-- ─── CORPO ────────────────────────────────────────────── -->
      <div class="px-6 md:px-16 py-12 grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-8">

        <!-- Coluna esquerda -->
        <div class="flex flex-col gap-6">

          <!-- Card: Dados da conta -->
          <div class="bg-[#0e0f14] border border-white/[0.04]">
            <div class="flex items-center justify-between px-8 py-5 border-b border-white/[0.04]">
              <div class="flex items-center gap-3">
                <div
                  class="w-6 h-6 bg-[rgba(202,255,0,0.08)] border border-[rgba(202,255,0,0.15)] flex items-center justify-center">
                  <i class="fas fa-user text-[#CAFF00] text-[9px]"></i>
                </div>
                <span class="text-[11px] font-black uppercase tracking-[0.25em] text-zinc-400">Dados da Conta</span>
              </div>
              <button id="btn-edit-info"
                class="text-[10px] font-black uppercase tracking-widest text-zinc-600 hover:text-[#CAFF00] transition-colors flex items-center gap-2">
                <i class="fas fa-pen text-[9px]"></i> ALTERAR
              </button>
            </div>

            <!-- View -->
            <div id="info-view" class="px-8 py-6 grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <div class="text-[10px] text-zinc-600 font-black uppercase tracking-widest mb-1">Nome</div>
                <div class="text-white font-bold text-base">{{ $userName }}</div>
              </div>
              <div>
                <div class="text-[10px] text-zinc-600 font-black uppercase tracking-widest mb-1">E-mail</div>
                <div class="text-white font-bold text-base">{{ $userEmail }}</div>
              </div>
              <div>
                <div class="text-[10px] text-zinc-600 font-black uppercase tracking-widest mb-1">Membro desde</div>
                <div class="text-white font-bold text-base">{{ $userSinceDay }}</div>
              </div>
              <div>
                <div class="text-[10px] text-zinc-600 font-black uppercase tracking-widest mb-1">Último acesso</div>
                <div class="text-white font-bold text-base">{{ $userLastSeen }}</div>
              </div>
            </div>

            <!-- Edit -->
            <form id="info-form" class="hidden px-8 py-6" method="POST" action="/profile/update">
              @csrf
              @method('PUT')
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="text-[10px] text-zinc-500 font-black uppercase tracking-widest block">Nome</label>
                  <input type="text" name="name" value="{{ $userName }}"
                    class="w-full bg-zinc-900 border border-white/10 text-white text-sm font-bold p-3 outline-none focus:border-[#CAFF00] transition-all" />
                </div>
                <div class="space-y-2">
                  <label class="text-[10px] text-zinc-500 font-black uppercase tracking-widest block">E-mail</label>
                  <input type="email" name="email" value="{{ $userEmail }}"
                    class="w-full bg-zinc-900 border border-white/10 text-white text-sm font-bold p-3 outline-none focus:border-[#CAFF00] transition-all" />
                </div>
              </div>
              <div class="flex gap-3 mt-6">
                <button type="submit"
                  class="bg-[#CAFF00] text-black font-black text-[11px] uppercase tracking-widest px-8 py-3 hover:shadow-[0_0_20px_rgba(202,255,0,0.3)] transition-all italic">
                  SALVAR
                </button>
                <button type="button" id="btn-cancel-info"
                  class="border border-white/10 text-zinc-500 font-black text-[11px] uppercase tracking-widest px-6 py-3 hover:text-white hover:border-white transition-all italic">
                  CANCELAR
                </button>
              </div>
            </form>
          </div>

          <!-- Card: Segurança -->
          <div class="bg-[#0e0f14] border border-white/[0.04]">
            <div class="flex items-center justify-between px-8 py-5 border-b border-white/[0.04]">
              <div class="flex items-center gap-3">
                <div
                  class="w-6 h-6 bg-[rgba(202,255,0,0.08)] border border-[rgba(202,255,0,0.15)] flex items-center justify-center">
                  <i class="fas fa-lock text-[#CAFF00] text-[9px]"></i>
                </div>
                <span class="text-[11px] font-black uppercase tracking-[0.25em] text-zinc-400">Segurança</span>
              </div>
              <button id="btn-edit-password"
                class="text-[10px] font-black uppercase tracking-widest text-zinc-600 hover:text-[#CAFF00] transition-colors flex items-center gap-2">
                <i class="fas fa-pen text-[9px]"></i> ALTERAR
              </button>
            </div>

            <!-- View -->
            <div id="password-view" class="px-8 py-6">
              <div class="flex items-center gap-4">
                <div class="flex gap-1">
                  @for($i = 0; $i < 12; $i++)
                    <div class="w-2 h-2 bg-zinc-700 rounded-full"></div>
                  @endfor
                </div>
                <span class="text-zinc-600 text-[11px] font-bold uppercase tracking-widest">Senha definida</span>
              </div>
            </div>

            <!-- Edit -->
            <form id="password-form" class="hidden px-8 py-6" method="POST" action="/profile/password">
              @csrf
              @method('PUT')
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                  <label class="text-[10px] text-zinc-500 font-black uppercase tracking-widest block">Senha Atual</label>
                  <input type="password" name="current_password"
                    class="w-full bg-zinc-900 border border-white/10 text-white text-sm font-bold p-3 outline-none focus:border-[#CAFF00] transition-all" />
                </div>
                <div class="space-y-2">
                  <label class="text-[10px] text-zinc-500 font-black uppercase tracking-widest block">Nova Senha</label>
                  <input type="password" name="password"
                    class="w-full bg-zinc-900 border border-white/10 text-white text-sm font-bold p-3 outline-none focus:border-[#CAFF00] transition-all" />
                </div>
                <div class="space-y-2">
                  <label class="text-[10px] text-zinc-500 font-black uppercase tracking-widest block">Confirmar</label>
                  <input type="password" name="password_confirmation"
                    class="w-full bg-zinc-900 border border-white/10 text-white text-sm font-bold p-3 outline-none focus:border-[#CAFF00] transition-all" />
                </div>
              </div>
              <div class="flex gap-3 mt-6">
                <button type="submit"
                  class="bg-[#CAFF00] text-black font-black text-[11px] uppercase tracking-widest px-8 py-3 hover:shadow-[0_0_20px_rgba(202,255,0,0.3)] transition-all italic">
                  ATUALIZAR SENHA
                </button>
                <button type="button" id="btn-cancel-password"
                  class="border border-white/10 text-zinc-500 font-black text-[11px] uppercase tracking-widest px-6 py-3 hover:text-white hover:border-white transition-all italic">
                  CANCELAR
                </button>
              </div>
            </form>
          </div>

          <!-- Card: Zona de perigo -->
          <div class="bg-[#0e0f14] border border-red-900/20">
            <div class="flex items-center gap-3 px-8 py-5 border-b border-red-900/20">
              <div class="w-6 h-6 bg-red-900/20 border border-red-900/30 flex items-center justify-center">
                <i class="fas fa-triangle-exclamation text-red-500 text-[9px]"></i>
              </div>
              <span class="text-[11px] font-black uppercase tracking-[0.25em] text-red-500/70">Zona de Perigo</span>
            </div>
            <div class="px-8 py-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
              <div>
                <div class="text-white font-black text-sm uppercase">Excluir Conta</div>
                <div class="text-zinc-600 text-[11px] font-bold mt-1 max-w-sm">Esta ação é permanente e removerá todos os
                  seus dados, treinos e objetivos.</div>
              </div>
              <button id="btn-delete-account"
                class="flex-shrink-0 border border-red-500/40 text-red-500 font-black text-[10px] uppercase tracking-widest px-6 py-3 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all italic">
                <i class="fas fa-trash text-[9px] mr-2"></i> EXCLUIR CONTA
              </button>
            </div>
          </div>

        </div>

        <!-- Coluna direita -->
        <div class="flex flex-col gap-6">

          <!-- Card: Progresso -->
          <div class="bg-[#0e0f14] border border-white/[0.04]">
            <div class="flex items-center gap-3 px-6 py-5 border-b border-white/[0.04]">
              <div
                class="w-6 h-6 bg-[rgba(202,255,0,0.08)] border border-[rgba(202,255,0,0.15)] flex items-center justify-center">
                <i class="fas fa-chart-line text-[#CAFF00] text-[9px]"></i>
              </div>
              <span class="text-[11px] font-black uppercase tracking-[0.25em] text-zinc-400">Progresso Semanal</span>
            </div>
            <div class="px-6 py-6">
              <div class="mb-6">
                <div class="flex justify-between items-baseline mb-2">
                  <span class="text-[10px] text-zinc-600 font-black uppercase tracking-widest">Objetivos concluídos</span>
                  <span id="pct-objectives"
                    class="font-['Barlow_Condensed',sans-serif] font-black text-[#CAFF00] text-xl italic">—%</span>
                </div>
                <div class="h-[3px] bg-white/[0.05] w-full">
                  <div id="bar-objectives" class="h-full bg-[#CAFF00] transition-all duration-700" style="width:0%"></div>
                </div>
              </div>

              <!-- Dias da semana (decorativo) -->
              <div class="mt-4">
                <div class="text-[10px] text-zinc-600 font-black uppercase tracking-widest mb-4">Atividade da Semana</div>
                <div class="flex gap-2 items-end" style="height:64px">
                  @php
                    $days = ['S', 'T', 'Q', 'Q', 'S', 'S', 'D'];
                    $heights = [60, 100, 40, 80, 100, 30, 0];
                    $todayIndex = now()->dayOfWeek === 0 ? 6 : now()->dayOfWeek - 1;
                  @endphp
                  @foreach($days as $i => $day)
                    @php
                      $h = $heights[$i];
                      $isToday = ($i === $todayIndex);
                      $bg = $h > 0 ? ($isToday ? '#CAFF00' : 'rgba(202,255,0,0.2)') : 'rgba(255,255,255,0.04)';
                    @endphp
                    <div class="flex-1 flex flex-col items-center gap-2" style="height:100%">
                      <div style="width:100%; height:{{ $h }}%; background:{{ $bg }}; margin-top:auto;"></div>
                      <span
                        style="font-size:9px; font-weight:900; text-transform:uppercase; color:{{ $isToday ? '#CAFF00' : '#3f3f46' }}">{{ $day }}</span>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <!-- Card: Acesso rápido -->
          <div class="bg-[#0e0f14] border border-white/[0.04]">
            <div class="flex items-center gap-3 px-6 py-5 border-b border-white/[0.04]">
              <div
                class="w-6 h-6 bg-[rgba(202,255,0,0.08)] border border-[rgba(202,255,0,0.15)] flex items-center justify-center">
                <i class="fas fa-bolt text-[#CAFF00] text-[9px]"></i>
              </div>
              <span class="text-[11px] font-black uppercase tracking-[0.25em] text-zinc-400">Acesso Rápido</span>
            </div>
            <div class="p-3">
              @php
                $links = [
                  ['href' => '/dashboard', 'icon' => 'fa-gauge', 'label' => 'Dashboard', 'sub' => 'Visão geral'],
                  ['href' => '/workouts', 'icon' => 'fa-dumbbell', 'label' => 'Treinos', 'sub' => 'Gerenciar treinos'],
                  ['href' => '/exercises', 'icon' => 'fa-list-check', 'label' => 'Exercícios', 'sub' => 'Biblioteca técnica'],
                  ['href' => '/objectives', 'icon' => 'fa-bullseye', 'label' => 'Objetivos', 'sub' => 'Metas da semana'],
                ];
              @endphp
              @foreach($links as $link)
                <a href="{{ $link['href'] }}"
                  class="flex items-center gap-4 px-4 py-3 hover:bg-white/[0.03] border-l-2 border-transparent hover:border-[#CAFF00] transition-all group no-underline">
                  <div
                    class="w-8 h-8 bg-white/[0.03] border border-white/[0.06] flex items-center justify-center flex-shrink-0 group-hover:border-[#CAFF00]/30 transition-all">
                    <i
                      class="fas {{ $link['icon'] }} text-zinc-600 group-hover:text-[#CAFF00] text-[11px] transition-colors"></i>
                  </div>
                  <div>
                    <div
                      class="text-white font-black text-[12px] uppercase tracking-wide group-hover:text-[#CAFF00] transition-colors">
                      {{ $link['label'] }}
                    </div>
                    <div class="text-zinc-700 text-[10px] font-bold uppercase tracking-widest">{{ $link['sub'] }}</div>
                  </div>
                  <div class="ml-auto">
                    <i
                      class="fas fa-chevron-right text-[8px] text-zinc-700 group-hover:text-[#CAFF00] transition-colors"></i>
                  </div>
                </a>
              @endforeach
            </div>
          </div>

          <!-- Logout -->
          <form method="POST" action="/logout">
            @csrf
            <button type="submit"
              class="w-full flex items-center justify-center gap-3 border border-white/[0.06] text-zinc-600 font-black text-[11px] uppercase tracking-[0.2em] px-6 py-4 hover:border-red-500/40 hover:text-red-500 transition-all italic">
              <i class="fas fa-right-from-bracket text-xs"></i>
              ENCERRAR SESSÃO
            </button>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- ─── Modal: Excluir Conta ─────────────────────────────── -->
  <div id="delete-account-overlay"
    class="fixed inset-0 bg-black/98 backdrop-blur-lg z-50 hidden items-center justify-center p-4">
    <div
      class="bg-[#0e0f14] border border-red-900/30 w-full max-w-sm p-10 text-center shadow-[0_0_80px_rgba(220,38,38,0.1)]">
      <div
        class="w-20 h-20 bg-red-900/10 flex items-center justify-center mx-auto mb-8 rounded-full border border-red-900/20">
        <i class="fas fa-triangle-exclamation text-red-500 text-2xl"></i>
      </div>
      <h3 class="font-['Barlow_Condensed',sans-serif] font-black text-2xl text-white uppercase italic mb-2">Excluir Conta?
      </h3>
      <p class="text-zinc-500 text-[11px] font-bold uppercase tracking-widest mb-8 leading-relaxed">
        Todos os seus dados serão permanentemente removidos. Esta ação não pode ser desfeita.
      </p>
      <div class="space-y-2 mb-8">
        <label class="text-[10px] text-zinc-600 font-black uppercase tracking-widest block text-left">Digite sua senha
          para confirmar</label>
        <input type="password" id="delete-password-confirm"
          class="w-full bg-zinc-900 border border-red-900/30 text-white text-sm p-3 outline-none focus:border-red-500 transition-all" />
      </div>
      <div class="grid grid-cols-2 gap-3">
        <form method="POST" action="/profile/delete">
          @csrf
          @method('DELETE')
          <input type="hidden" name="password" id="delete-password-input">
          <button type="submit"
            onclick="document.getElementById('delete-password-input').value = document.getElementById('delete-password-confirm').value"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-black text-[11px] uppercase tracking-widest py-4 transition-all italic">
            CONFIRMAR
          </button>
        </form>
        <button id="btn-cancel-delete-account"
          class="border border-white/10 text-zinc-600 font-black text-[11px] uppercase tracking-widest py-4 hover:text-white hover:border-white transition-all italic">
          CANCELAR
        </button>
      </div>
    </div>
  </div>

  <!-- ─── Toast ─────────────────────────────────────────────── -->
  <div id="toast"
    class="fixed bottom-10 right-10 z-[100] translate-y-6 opacity-0 transition-all duration-500 pointer-events-none">
    <div
      class="flex items-center gap-4 px-8 py-5 bg-[#0e0f14] border-l-4 border-[#CAFF00] shadow-[0_25px_60px_rgba(0,0,0,0.6)]">
      <div class="bg-[#CAFF00]/10 p-2">
        <i id="toast-icon" class="fas fa-check text-[#CAFF00] text-sm"></i>
      </div>
      <span id="toast-msg" class="text-white text-[11px] font-black uppercase tracking-[0.2em] italic"></span>
    </div>
  </div>
  <script src="{{ asset('js/profile.js') }}"></script>
@endsection