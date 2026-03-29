<!DOCTYPE html>
<html lang="pt-BR" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | NextStage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('favicons/icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="h-full bg-[#050505] text-slate-200 overflow-hidden font-sans">
    <div class="flex h-full">
        <div class="hidden lg:flex flex-1 relative items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://imgs.search.brave.com/PhqNId2pVsOwkiZw4zwD4mc6fbGtNZjsQPkuoePigoE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtZ3JhdGlz/L3JldHJhdG8tZW0t/cHJldG8tZS1icmFu/Y28tZGUtdW0tYXRs/ZXRhLWNvbXBldGlu/ZG8tbm9zLWpvZ29z/LWRvLWNhbXBlb25h/dG8tcGFyYWxpbXBp/Y29fMjMtMjE1MTQ5/MjY5OC5qcGc_c2Vt/dD1haXNfaHlicmlk/Jnc9NzQwJnE9ODA"
                    class="w-full h-full object-cover opacity-40" alt="">
                <div class="absolute inset-0 bg-gradient-to-r from-[#050505]/20 via-transparent to-[#050505]"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-transparent"></div>
            </div>
            <div class="relative z-10 max-w-2xl animate-fade">
                <img src="{{ asset('images/Lgo_next-removebg-preview.png') }}" alt="Logo NextStage" class="w-40">
                <h1 class="text-6xl font-black text-white leading-[0.9] mb-6 uppercase italic">
                    SUPERE SEUS <br><span style="color:#CAFF00">LIMITES HOJE.</span>
                </h1>
                <p class="text-xl text-slate-300 max-w-md border-l-4 pl-4" style="border-color:#CAFF00">
                    Acesse seu painel de performance, planos de treino e guias táticos.
                </p>
            </div>
        </div>

        <div
            class="w-full lg:w-[550px] bg-[#0A0A0A] border-l border-white/5 flex flex-col items-center justify-center p-8 lg:p-20 relative">
            <div class="w-full max-w-sm">
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-4xl font-black text-white uppercase italic">Acesso Atleta</h2>
                    <p class="text-slate-500 mt-2">Pronto para entrar em campo?</p>
                </div>

                <form id="loginForm" class="space-y-6">
                    <div>
                        <label
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">E-mail</label>
                        <input id="emailInput" type="email" placeholder="exemplo@performance.com"
                            class="w-full bg-[#121212] border border-white/10 rounded-xl py-4 px-4 text-white placeholder:text-slate-700 focus:outline-none focus:border-[#CAFF00] transition-all">
                    </div>
                    <div>
                        <label
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Senha</label>
                        <div class="relative">
                            <input id="passwordInput" type="password" placeholder="••••••••"
                                class="w-full bg-[#121212] border border-white/10 rounded-xl py-4 px-4 pr-12 text-white placeholder:text-slate-700 focus:outline-none focus:border-[#CAFF00] transition-all">
                            <button type="button" id="togglePwd"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-600 hover:text-[#CAFF00]">
                                <i id="eyeIcon" class="fas fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div id="errorMsg" class="hidden text-red-500 text-xs text-center font-bold"></div>

                    <button type="submit"
                        class="w-full text-black font-black py-5 rounded-xl transition-all transform hover:-translate-y-1 active:scale-[0.98] uppercase italic flex items-center justify-center gap-3"
                        style="background:#CAFF00">
                        <span id="btnText">Entrar no Sistema</span>
                        <i id="btnIcon" class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <p class="mt-10 text-center text-sm text-slate-500">
                    Novo no time? <a href="/register" style="color:#CAFF00" class="font-bold hover:underline">Crie sua
                        conta atleta</a>
                </p>
            </div>
            <div class="absolute bottom-6 text-[10px] text-slate-700 uppercase tracking-[3px]">High Performance
                Experience © 2026</div>
        </div>
    </div>

    <script>
        // Toggle senha
        const tog = document.getElementById('togglePwd');
        const pw = document.getElementById('passwordInput');
        const eye = document.getElementById('eyeIcon');
        tog.addEventListener('click', () => {
            const show = pw.type === 'password';
            pw.type = show ? 'text' : 'password';
            eye.className = show ? 'fas fa-eye-slash text-sm' : 'fas fa-eye text-sm';
        });

        // Se já logado, vai direto pro dashboard
        if (localStorage.getItem('auth_token')) {
            window.location.href = '/dashboard';
        }

        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const errEl = document.getElementById('errorMsg');
            const btnTxt = document.getElementById('btnText');
            const btnIco = document.getElementById('btnIcon');
            errEl.classList.add('hidden');
            btnTxt.innerText = 'Autenticando...';
            btnIco.className = 'fas fa-spinner fa-spin';

            try {
                const res = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email: document.getElementById('emailInput').value,
                        password: pw.value
                    })
                });
                const data = await res.json();
                if (res.ok) {
                    localStorage.setItem('auth_token', data.token);
                    window.location.href = '/dashboard';
                } else {
                    errEl.innerText = data.message || 'E-mail ou senha incorretos.';
                    errEl.classList.remove('hidden');
                }
            } catch {
                errEl.innerText = 'Erro de conexão.';
                errEl.classList.remove('hidden');
            } finally {
                btnTxt.innerText = 'Entrar no Sistema';
                btnIco.className = 'fas fa-arrow-right';
            }
        });
    </script>
</body>

</html>