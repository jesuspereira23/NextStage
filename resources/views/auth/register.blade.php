<!DOCTYPE html>
<html lang="pt-BR" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Criar Conta | NextStage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('favicons/icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body class="h-full bg-[#050505] text-slate-200 overflow-hidden font-sans antialiased">
    <div class="fixed pointer-events-none -top-24 -left-32 w-[440px] h-[440px] rounded-full blur-[120px] opacity-10"
        style="background:#CAFF00"></div>

    <main class="relative z-10 h-full flex">
        <div class="hidden lg:flex flex-1 relative items-center justify-center overflow-hidden">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop"
                    class="w-full h-full object-cover opacity-30 grayscale">
                <div class="absolute inset-0 bg-gradient-to-r from-[#050505]/40 via-transparent to-[#050505]"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-transparent"></div>
            </div>
            <div class="relative z-10 max-w-2xl px-12">
                <h1 class="text-[70px] font-black text-white leading-[0.85] mb-6 uppercase italic">
                    A SUA MELHOR <br><span style="color:#CAFF00">VERSÃO</span> COMEÇA<br>AGORA.
                </h1>
                <p class="text-xl text-slate-400 max-w-md border-l-4 pl-4" style="border-color:#CAFF00">
                    Junte-se ao ecossistema que transforma dados brutos em pódios e recordes pessoais.
                </p>
            </div>
        </div>

        <div
            class="w-full lg:w-[550px] shrink-0 bg-[#0A0A0A] border-l border-white/5 flex items-center justify-center px-8 lg:px-16 relative z-20">
            <div class="w-full max-w-sm py-12">
                <div class="mb-8">
                    <h2 class="text-4xl font-black text-white uppercase italic leading-none">Criar Conta</h2>
                    <p class="text-slate-500 mt-2">Inicie seu protocolo de alta performance.</p>
                </div>

                <form id="registerForm" class="space-y-4">
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2">Nome</label>
                        <input id="nameInput" type="text" placeholder="Como quer ser chamado?"
                            class="w-full bg-[#121212] border border-white/10 rounded-xl px-4 py-4 text-sm text-white placeholder:text-slate-700 outline-none focus:border-[#CAFF00] transition-all">
                    </div>
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2">E-mail</label>
                        <input id="emailInput" type="email" placeholder="atleta@dominio.com"
                            class="w-full bg-[#121212] border border-white/10 rounded-xl px-4 py-4 text-sm text-white placeholder:text-slate-700 outline-none focus:border-[#CAFF00] transition-all">
                    </div>
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2">Senha</label>
                        <div class="relative">
                            <input id="passwordInput" type="password" placeholder="••••••••"
                                class="w-full bg-[#121212] border border-white/10 rounded-xl px-4 py-4 pr-12 text-sm text-white placeholder:text-slate-700 outline-none focus:border-[#CAFF00] transition-all">
                            <button type="button" id="togglePwd"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-600 hover:text-[#CAFF00]">
                                <i class="fas fa-eye text-sm" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div id="errorMsg" class="hidden text-red-500 text-xs text-center font-bold"></div>

                    <button type="submit"
                        class="w-full text-black font-black py-5 rounded-xl transition-all transform hover:-translate-y-1 active:scale-[0.98] uppercase italic flex items-center justify-center gap-3 mt-4"
                        style="background:#CAFF00">
                        <span id="btnText">Finalizar Inscrição</span>
                        <i id="btnIcon" class="fas fa-bolt"></i>
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-slate-500">
                    Já é do time? <a href="/login" style="color:#CAFF00" class="font-bold hover:underline ml-1">Fazer
                        Login</a>
                </p>
            </div>
        </div>
    </main>

    <script>
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

        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const errEl = document.getElementById('errorMsg');
            const btnTxt = document.getElementById('btnText');
            const btnIco = document.getElementById('btnIcon');
            errEl.classList.add('hidden');
            btnTxt.innerText = 'Processando...';
            btnIco.className = 'fas fa-spinner fa-spin';

            try {
                const res = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        name: document.getElementById('nameInput').value,
                        email: document.getElementById('emailInput').value,
                        password: pw.value,
                        password_confirmation: pw.value
                    })
                });
                const data = await res.json();
                if (res.ok) {
                    localStorage.setItem('auth_token', data.token);
                    window.location.href = '/dashboard';
                } else {
                    errEl.innerText = data.message || 'Erro ao cadastrar. Tente novamente.';
                    errEl.classList.remove('hidden');
                }
            } catch {
                errEl.innerText = 'Erro de conexão.';
                errEl.classList.remove('hidden');
            } finally {
                btnTxt.innerText = 'Finalizar Inscrição';
                btnIco.className = 'fas fa-bolt';
            }
        });
    </script>
</body>

</html>