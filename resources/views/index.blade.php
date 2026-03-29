<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NextStage — Live Your Game</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('favicons/icon.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,700;0,900;1,900&family=Barlow:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>

    <!-- NAV -->
    <nav
        class="fixed top-0 left-0 w-full z-50 px-10 flex items-center justify-between h-[70px] bg-[rgba(8,9,13,0.92)] backdrop-blur-xl border-b border-[rgba(202,255,0,0.08)]">
        <a href="#"
            class="font-condensed font-black italic text-[26px] tracking-tight text-white no-underline flex items-center gap-2">
            <img src="{{ asset('images/Lgo_next-removebg-preview.png')}}" alt="" class="w-28">
        </a>
        <ul class="hidden md:flex gap-9 list-none">
            <li><a href="#treino"
                    class="text-[11px] font-bold tracking-[0.2em] uppercase text-[#aaa] no-underline hover:text-[#CAFF00] transition-colors">Treino</a>
            </li>
            <li><a href="#vida"
                    class="text-[11px] font-bold tracking-[0.2em] uppercase text-[#aaa] no-underline hover:text-[#CAFF00] transition-colors">Pilares</a>
            </li>
            <li><a href="#guias"
                    class="text-[11px] font-bold tracking-[0.2em] uppercase text-[#aaa] no-underline hover:text-[#CAFF00] transition-colors">Esportes</a>
            </li>
            <li><a href="#comunidade"
                    class="text-[11px] font-bold tracking-[0.2em] uppercase text-[#aaa] no-underline hover:text-[#CAFF00] transition-colors">Guias</a>
            </li>
            <li><a href="#"
                    class="text-[11px] font-bold tracking-[0.2em] uppercase text-[#aaa] no-underline hover:text-[#CAFF00] transition-colors">Comunidade</a>
            </li>
        </ul>
        <a href="/login"
            style="background:#CAFF00;color:#000;font-weight:900;font-size:12px;letter-spacing:0.15em;text-transform:uppercase;padding:10px 24px;border-radius:3px;border:none;cursor:pointer;text-decoration:none;font-family:'Barlow Condensed',sans-serif;transition:box-shadow 0.3s,transform 0.3s;"
            onmouseover="this.style.boxShadow='0 0 24px rgba(202,255,0,0.25)';this.style.transform='translateY(-2px)'"
            onmouseout="this.style.boxShadow='none';this.style.transform='none'">Montar Plano</a>
    </nav>

    <!-- HERO: FULL BLEED B&W -->
    <section class="relative min-h-screen flex items-end pt-[70px] overflow-hidden">
        <img src="https://img.freepik.com/fotos-gratis/retrato-em-preto-e-branco-de-um-atleta-competindo-nos-jogos-do-campeonato-paralimpico_23-2151492708.jpg?semt=ais_hybrid&w=740&q=80"
            alt="Atleta" class="hero-photo" />
        <div class="hero-overlay-l"></div>
        <div class="hero-overlay-b"></div>

        <!-- Lime vertical bar (left edge) -->
        <div class="absolute left-0 top-[70px] bottom-0 w-[3px] bg-[#CAFF00] z-10 hidden md:block"></div>

        <!-- Content -->
        <div class="relative z-10 w-full mt-10 max-w-[660px] px-8 md:pl-16 md:pr-8 pb-12 md:pb-32">

            <div class="sr flex items-center gap-2 mb-4">
                <span class="w-8 h-[2px] bg-[#CAFF00] block"></span>
                <span class="text-[11px] font-bold tracking-[0.35em] text-[#CAFF00] uppercase font-condensed">Guia de
                    Vida Esportiva</span>
            </div>

            <h1 class="sr font-condensed font-black uppercase text-white leading-[0.87] mb-8 text-[120px]">
                VIVA O SEU<br><em class="not-italic" style="color:#CAFF00">MELHOR JOGO.</em>
            </h1>

            <p class="sr text-[15px] text-[#999] leading-[1.75] max-w-[400px] mb-10" style="transition-delay:0.3s">
                Mais que placares. Transforme seu corpo, mente e rotina com o ecossistema NextStage — nutrição, treino,
                mental e comunidade em um só lugar.
            </p>

            <div class="sr flex flex-wrap gap-4 mb-14" style="transition-delay:0.45s">
                <a href="/login" class="btn-p">MONTAR MEU PLANO <i class="fas fa-chevron-right text-xs"></i></a>
                <a href="#guias" class="btn-g">VER ESPORTES</a>
            </div>
        </div>

        <!-- Scroll hint -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 hidden md:flex flex-col items-center gap-2">
            <span class="text-[9px] text-[#444] tracking-[0.3em] uppercase font-condensed">Scroll</span>
            <div class="w-[1px] h-8 bg-gradient-to-b from-[#CAFF00] to-transparent"></div>
        </div>
    </section>

    <!-- TICKER -->
    <div class="bg-[#CAFF00] overflow-hidden py-[14px] whitespace-nowrap">
        <div class="ticker-inner">
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">FUTEBOL</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">BASQUETE</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">NATAÇÃO</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">CICLISMO</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">TÊNIS</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">MMA</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">VÔLEI</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">CORRIDA</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">CROSSFIT</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">SURF</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">BOXE</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">ATLETISMO</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">FUTEBOL</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">BASQUETE</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">NATAÇÃO</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">CICLISMO</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">TÊNIS</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">MMA</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">VÔLEI</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">CORRIDA</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">CROSSFIT</span>
            <span
                class="font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8 inline-flex items-center gap-4 after:content-['✦']">SURF</span>
        </div>
    </div>

    <!-- PILARES -->
    <section id="vida" class="py-28 px-6 md:px-16">
        <div class="text-center mb-16 sr">
            <span class="text-[11px] font-bold tracking-[0.35em] text-[#CAFF00] uppercase block mb-4 font-condensed">Os
                4 Pilares</span>
            <h2 class="font-condensed font-black text-white" style="font-size:clamp(36px,5vw,64px)">ALTO <span
                    style="color:#CAFF00">RENDIMENTO</span><br>COMEÇA AQUI</h2>
            <div class="w-12 h-[3px] mx-auto mt-5" style="background:#CAFF00"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-[2px]">
            <div class="pillar sr" style="transition-delay:0.1s">
                <div class="pnum">01</div><i class="fas fa-apple-whole text-3xl block mb-5" style="color:#CAFF00"></i>
                <h3 class="font-condensed font-black text-white text-2xl mb-4">Nutrição Tática</h3>
                <p class="text-sm text-[#666] leading-[1.8]">Cardápios personalizados por esporte, foco em recuperação
                    muscular, energia de longa duração e composição corporal ideal para seu tipo de atleta.</p>
            </div>
            <div class="pillar sr" style="transition-delay:0.2s">
                <div class="pnum">02</div><i class="fas fa-brain text-3xl block mb-5" style="color:#CAFF00"></i>
                <h3 class="font-condensed font-black text-white text-2xl mb-4">Mentalidade Elite</h3>
                <p class="text-sm text-[#666] leading-[1.8]">Técnicas de foco e visualização, controle de ansiedade
                    pré-jogo e resiliência psicológica usadas por campeões olímpicos e atletas de elite mundial.</p>
            </div>
            <div class="pillar sr" style="transition-delay:0.3s">
                <div class="pnum">03</div><i class="fas fa-dumbbell text-3xl block mb-5" style="color:#CAFF00"></i>
                <h3 class="font-condensed font-black text-white text-2xl mb-4">Treino Híbrido</h3>
                <p class="text-sm text-[#666] leading-[1.8]">Planilhas que combinam força, explosão, mobilidade e
                    recuperação — periodizadas para você evoluir sem platôs e sem lesões.</p>
            </div>
            <div class="pillar sr" style="transition-delay:0.4s">
                <div class="pnum">04</div><i class="fas fa-users text-3xl block mb-5" style="color:#CAFF00"></i>
                <h3 class="font-condensed font-black text-white text-2xl mb-4">Comunidade Ativa</h3>
                <p class="text-sm text-[#666] leading-[1.8]">Conecte-se com milhares de atletas que compartilham metas,
                    resultados e motivação. Desafios semanais, rankings e parceiros de treino.</p>
            </div>
            <div class="pillar sr" style="transition-delay:0.5s">
                <div class="pnum">05</div><i class="fas fa-moon text-3xl block mb-5" style="color:#CAFF00"></i>
                <h3 class="font-condensed font-black text-white text-2xl mb-4">Recuperação & Sono</h3>
                <p class="text-sm text-[#666] leading-[1.8]">Protocolos de recuperação ativa, crioterapia, alongamentos
                    pós-treino e guias de sono profundo para maximizar cada sessão de treinamento.</p>
            </div>
            <div class="pillar sr" style="transition-delay:0.6s">
                <div class="pnum">06</div><i class="fas fa-chart-line text-3xl block mb-5" style="color:#CAFF00"></i>
                <h3 class="font-condensed font-black text-white text-2xl mb-4">Métricas & Evolução</h3>
                <p class="text-sm text-[#666] leading-[1.8]">Acompanhe seu progresso com dashboards de performance,
                    análise de carga de treino e relatórios mensais de evolução corporal e técnica.</p>
            </div>
        </div>
    </section>

    <!-- SPORTS SHOWCASE -->
    <section id="guias" class="pb-24 bg-[#0e0f14]">
        <div class="px-6 md:px-16 pt-24 pb-14 flex justify-between items-end">
            <h2 class="font-condensed font-black sr" style="font-size:clamp(36px,5vw,60px)">EXPLORE <span
                    style="color:#CAFF00">ESPORTES</span></h2>
            <span class="sr text-[#333] font-bold text-[12px] tracking-[0.2em] font-condensed">+ DE 15
                MODALIDADES</span>
        </div>
        <div class="px-[4px] gap-[4px]"
            style="display:grid;grid-template-columns:repeat(6,1fr);grid-template-rows:260px 200px 240px;gap:4px;">
            <div class="sc sr" style="grid-column:span 2;transition-delay:0.1s"><img
                    src="https://imgs.search.brave.com/Kk7G_8lwdvE0cChTdp3IR9qGpfL9_YCIWTNlnMWtt9g/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtcHJlbWl1/bS9qb2dvLWRlLWZ1/dGVib2xfMTEyODYy/MC03LmpwZz9zZW10/PWFpc19oeWJyaWQm/dz03NDA"
                    alt="Futebol">
                <div class="sc-label"><span
                        class="font-condensed font-black text-white text-xl uppercase">Futebol</span><span
                        class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">32 GUIAS</span></div>
            </div>
            <div class="sc sr" style="grid-column:span 2;transition-delay:0.15s"><img
                    src="https://imgs.search.brave.com/zIJHvvLGvxggEcgUPSGiSnGTnsqLFLFzV6ScTHA5gcE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtZ3JhdGlz/L3JldHJhdG8tZW0t/cHJldG8tZS1icmFu/Y28tZGUtdW0tYXRs/ZXRhLWNvbXBldGlu/ZG8tbm9zLWpvZ29z/LWRvLWNhbXBlb25h/dG8tcGFyYWxpbXBp/Y29fMjMtMjE1MTQ5/MjY3MC5qcGc_c2Vt/dD1haXNfaHlicmlk/Jnc9NzQwJnE9ODA"
                    alt="Basquete">
                <div class="sc-label"><span
                        class="font-condensed font-black text-white text-xl uppercase">Basquete</span><span
                        class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">18 GUIAS</span></div>
            </div>
            <div class="sc sr" style="grid-column:span 2;transition-delay:0.2s"><img
                    src="https://imgs.search.brave.com/MliHIYgBzw6t2aySYASRqr6A1gsvzh5ke0AiEUZdXtQ/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtZ3JhdGlz/L3JldHJhdG8tbW9u/b2Nyb21hdGljby1k/ZS11bS1hdGxldGEt/Y29tcGV0aW5kby1u/by1jYW1wZW9uYXRv/LWRvcy1qb2dvcy1w/YXJhbGltcGljb3Nf/MjMtMjE1MTQ5Mjc2/NC5qcGc_c2VtdD1h/aXNfaHlicmlkJnc9/NzQwJnE9ODA"
                    alt="Natação">
                <div class="sc-label"><span
                        class="font-condensed font-black text-white text-xl uppercase">Natação</span><span
                        class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">24 GUIAS</span></div>
            </div>
            <div class="sc sr" style="grid-column:span 1;transition-delay:0.25s"><img
                    src="https://imgs.search.brave.com/4_qzJ-_0OQ8BZzkD4sfM7LD707Is1aywEeXd3W9Kwas/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtZ3JhdGlz/L3JldHJhdG8tbW9u/b2Nyb21hdGljby1k/ZS11bS1hdGxldGEt/Y29tcGV0aW5kby1u/by1jYW1wZW9uYXRv/LWRvcy1qb2dvcy1v/bGltcGljb3NfMjMt/MjE1MTUwMDU5MC5q/cGc_c2VtdD1haXNf/aHlicmlkJnc9NzQw/JnE9ODA"
                    alt="Ciclismo">
                <div class="sc-label"><span
                        class="font-condensed font-black text-white text-xl uppercase">Ciclismo</span><span
                        class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">15</span></div>
            </div>
            <div class="sc sr" style="grid-column:span 1;transition-delay:0.3s"><img
                    src="https://imgs.search.brave.com/HRSocY5RFq1FgxTS1gpLQdLF2JrKZ7xkXdF-LFzbEao/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtZ3JhdGlz/L3JldHJhdG8tZW0t/cHJldG8tZS1icmFu/Y28tZGUtdW0tYXRs/ZXRhLWNvbXBldGlu/ZG8tbm9zLWpvZ29z/LWRvLWNhbXBlb25h/dG8tcGFyYWxpbXBp/Y29fMjMtMjE1MTQ5/MjY2OS5qcGc_c2Vt/dD1haXNfaHlicmlk/Jnc9NzQwJnE9ODA"
                    alt="Corrida">
                <div class="sc-label"><span
                        class="font-condensed font-black text-white text-xl uppercase">Corrida</span><span
                        class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">27</span></div>
            </div>
            <div class="sc sr" style="grid-column:span 1;transition-delay:0.35s"><img
                    src="https://imgs.search.brave.com/E8c1MMjPvXlvaUkgCWP6QTGJYO4o9FvkVN22loZ2Vjk/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtZ3JhdGlz/L3JldHJhdG8tZW0t/cHJldG8tZS1icmFu/Y28tZGUtdW0tYXRs/ZXRhLXBhcnRpY2lw/YW5kby1kb3MtZXNw/b3J0ZXMtZG8tY2Ft/cGVvbmF0by1vbGlt/cGljb18yMy0yMTUx/NTAwNTcxLmpwZz9z/ZW10PWFpc19oeWJy/aWQmdz03NDAmcT04/MA"
                    alt="Tênis">
                <div class="sc-label"><span
                        class="font-condensed font-black text-white text-xl uppercase">Tênis</span><span
                        class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">12</span></div>
            </div>
            <div class="sc sr" style="grid-column:span 3;transition-delay:0.4s"><img
                    src="https://imgs.search.brave.com/Ka7x5AJa3OAws9QuxktCl_oJsi9ZZsNh-sLGT_z64u0/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly91cy4x/MjNyZi5jb20vNDUw/d20vbmlja3AzNy9u/aWNrcDM3MTAxMC9u/aWNrcDM3MTAxMDAw/MDc3Lzc5NjE5MDct/bW1hLWFydGlzdGFz/LW1hcmNpYWlzLW1p/c3Rvcy1sdXRhbmRv/LWNodXRhbmRvLmpw/Zz92ZXI9Ng"
                    alt="MMA">
                <div class="sc-label"><span class="font-condensed font-black text-white text-xl uppercase">MMA /
                        Combate</span><span class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">19 GUIAS</span></div>
            </div>
            <div class="sc sr" style="grid-column:span 1;transition-delay:0.45s"><img
                    src="https://imgs.search.brave.com/jFzV6AP21TKBUFwRjdWhDvBc3X7YMQH7bX2OkHINZoE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtZ3JhdGlz/L3ZvbGVpYm9sLWNv/bS1qb2dhZG9yYS1l/LWJvbGFfMjMtMjE1/MDk5NTQ1OS5qcGc_/c2VtdD1haXNfaHli/cmlkJnc9NzQwJnE9/ODA"
                    alt="Vôlei">
                <div class="sc-label"><span
                        class="font-condensed font-black text-white text-xl uppercase">Vôlei</span><span
                        class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">11</span></div>
            </div>
            <div class="sc sr" style="grid-column:span 1;transition-delay:0.5s"><img
                    src="https://images.unsplash.com/photo-1554284126-aa88f22d8b74?w=600&q=80" alt="Crossfit">
                <div class="sc-label"><span
                        class="font-condensed font-black text-white text-xl uppercase">Crossfit</span><span
                        class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">20</span></div>
            </div>
            <div class="sc sr" style="grid-column:span 1;transition-delay:0.55s"><img
                    src="https://imgs.search.brave.com/xu0A3wzol3E57PewUx1EfqD0fyb1hVB3tRQOrVQhFnA/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/c2hvcGlmeS5jb20v/cy9maWxlcy8xLzA3/MTMvMTEyMi85MjE1/L2ZpbGVzL0NhcHR1/cmFfZGVfdGVsYV8y/MDI1LTAxLTA3XzEw/MTIxMl82MDB4NjAw/LnBuZz92PTE3MzYy/NTU2MTI"
                    alt="Surf">
                <div class="sc-label"><span
                        class="font-condensed font-black text-white text-xl uppercase">Surf</span><span
                        class="text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1"
                        style="background:#CAFF00">8</span></div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="treino" class="py-28 px-6 md:px-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
            <div class="sr relative">
                <img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?w=800&q=80" alt="Atleta"
                    class="w-full object-cover rounded-[4px]" style="height:600px" />
                <div class="absolute bottom-[-20px] left-[-20px] w-44 h-44 rounded-[4px]"
                    style="border:3px solid #CAFF00;z-index:-1"></div>
                <div class="absolute top-8 right-[-20px] font-condensed font-black text-[13px] tracking-[0.1em] px-5 py-3 z-10"
                    style="background:#CAFF00;color:#000">PLANOS PERSONALIZADOS</div>
            </div>
            <div class="sr" style="transition-delay:0.2s">
                <span class="text-[11px] font-bold tracking-[0.35em] uppercase block mb-4 font-condensed"
                    style="color:#CAFF00">Como Funciona</span>
                <h2 class="font-condensed font-black text-white" style="font-size:clamp(38px,5vw,64px)">SEU
                    TREINO,<br>SUAS <span style="color:#CAFF00">REGRAS.</span></h2>
                <p class="text-[14px] text-[#666] leading-[1.8] max-w-[420px] mt-6">Respondemos um questionário rápido
                    sobre seu esporte, nível atual e objetivos. O NextStage gera um plano completo — treino, nutrição e
                    rotina de recuperação.</p>
                <ul class="flex flex-col gap-8 mt-12 list-none">
                    <li class="flex gap-5 items-start">
                        <div class="fi"><i class="fas fa-sliders"></i></div>
                        <div>
                            <h4 class="font-condensed font-black text-white text-lg mb-1">Diagnóstico Personalizado</h4>
                            <p class="text-[13px] text-[#666] leading-[1.7]">Análise do seu perfil atlético,
                                disponibilidade de tempo e equipamento disponível para montar o plano ideal.</p>
                        </div>
                    </li>
                    <li class="flex gap-5 items-start">
                        <div class="fi"><i class="fas fa-calendar-check"></i></div>
                        <div>
                            <h4 class="font-condensed font-black text-white text-lg mb-1">Planilhas Semanais Adaptativas
                            </h4>
                            <p class="text-[13px] text-[#666] leading-[1.7]">O plano se ajusta conforme seu feedback
                                semanal — mais intensidade quando você evolui, descanso quando você precisa.</p>
                        </div>
                    </li>
                    <li class="flex gap-5 items-start">
                        <div class="fi"><i class="fas fa-video"></i></div>
                        <div>
                            <h4 class="font-condensed font-black text-white text-lg mb-1">Biblioteca de Exercícios em
                                Vídeo</h4>
                            <p class="text-[13px] text-[#666] leading-[1.7]">Mais de 500 vídeos demonstrativos com foco
                                em técnica correta para cada modalidade e objetivo.</p>
                        </div>
                    </li>
                    <li class="flex gap-5 items-start">
                        <div class="fi"><i class="fas fa-bolt"></i></div>
                        <div>
                            <h4 class="font-condensed font-black text-white text-lg mb-1">Resultados em 21 Dias</h4>
                            <p class="text-[13px] text-[#666] leading-[1.7]">Protocolo inicial de 3 semanas para
                                estabelecer base de condicionamento e medir seus primeiros ganhos mensuráveis.</p>
                        </div>
                    </li>
                </ul>
                <a href="/login" class="btn-p mt-12 inline-flex">COMEÇAR AGORA <i
                        class="fas fa-arrow-right text-xs"></i></a>
            </div>
        </div>
    </section>

    <!-- QUOTE -->
    <div class="py-20 px-6 md:px-16 text-center sr"
        style="border-top:1px solid rgba(255,255,255,0.04);border-bottom:1px solid rgba(255,255,255,0.04)">
        <p class="font-condensed font-black italic max-w-[900px] mx-auto mb-5 leading-[1.2]"
            style="font-size:clamp(28px,4vw,54px);color:rgba(255,255,255,0.1)">
            "O campeão não é quem nunca cai — é quem sabe <em class="not-italic" style="color:#CAFF00">por que
                levantou</em> e como vai mais longe na próxima."
        </p>
        <p class="text-[12px] tracking-[0.25em] font-condensed" style="color:#444">— FILOSOFIA NEXTSTAGE</p>
    </div>

    <!-- GUIAS EM DESTAQUE -->
    <section id="comunidade" class="pb-28">
        <div class="px-6 md:px-16 pt-20">
            <span class="text-[11px] font-bold tracking-[0.35em] uppercase block mb-2 sr font-condensed"
                style="color:#CAFF00">Guias em Destaque</span>
            <h2 class="font-condensed font-black text-white sr" style="font-size:clamp(36px,5vw,64px)">ÚLTIMOS <span
                    style="color:#CAFF00">CONTEÚDOS</span></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 mt-10">
                <div class="mc sr" style="transition-delay:0.1s"><img
                        src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=400&q=80" alt=""
                        class="w-full object-cover block" style="height:180px">
                    <div class="p-5">
                        <div class="text-[10px] font-bold uppercase mb-2 tracking-[0.2em] font-condensed"
                            style="color:#CAFF00">Corrida</div>
                        <div class="text-base font-bold text-white mb-1">Como correr seu primeiro 10km sem parar</div>
                        <div class="text-xs leading-[1.6]" style="color:#555">Protocolo de 8 semanas para iniciantes.
                        </div>
                    </div>
                </div>
                <div class="mc sr" style="transition-delay:0.2s"><img
                        src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?w=400&q=80" alt=""
                        class="w-full object-cover block" style="height:180px">
                    <div class="p-5">
                        <div class="text-[10px] font-bold uppercase mb-2 tracking-[0.2em] font-condensed"
                            style="color:#CAFF00">Musculação</div>
                        <div class="text-base font-bold text-white mb-1">Hipertrofia para atletas de esportes coletivos
                        </div>
                        <div class="text-xs leading-[1.6]" style="color:#555">Ganho de massa sem perder agilidade.</div>
                    </div>
                </div>
                <div class="mc sr" style="transition-delay:0.3s"><img
                        src="https://images.unsplash.com/photo-1517649763962-0c623066013b?w=400&q=80" alt=""
                        class="w-full object-cover block" style="height:180px">
                    <div class="p-5">
                        <div class="text-[10px] font-bold uppercase mb-2 tracking-[0.2em] font-condensed"
                            style="color:#CAFF00">Ciclismo</div>
                        <div class="text-base font-bold text-white mb-1">Nutrição para ciclistas de longa distância
                        </div>
                        <div class="text-xs leading-[1.6]" style="color:#555">O que comer antes, durante e depois de
                            60km+.</div>
                    </div>
                </div>
                <div class="mc sr" style="transition-delay:0.4s"><img
                        src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=400&q=80" alt=""
                        class="w-full object-cover block" style="height:180px">
                    <div class="p-5">
                        <div class="text-[10px] font-bold uppercase mb-2 tracking-[0.2em] font-condensed"
                            style="color:#CAFF00">Natação</div>
                        <div class="text-base font-bold text-white mb-1">Técnica de braçada: erros mais comuns</div>
                        <div class="text-xs leading-[1.6]" style="color:#555">5 erros que travam sua evolução na
                            piscina.</div>
                    </div>
                </div>
                <div class="mc sr" style="transition-delay:0.5s"><img
                        src="https://images.unsplash.com/photo-1595078475328-1ab05d0a6a0e?w=400&q=80" alt=""
                        class="w-full object-cover block" style="height:180px">
                    <div class="p-5">
                        <div class="text-[10px] font-bold uppercase mb-2 tracking-[0.2em] font-condensed"
                            style="color:#CAFF00">Combate</div>
                        <div class="text-base font-bold text-white mb-1">Condicionamento para lutadores amadores</div>
                        <div class="text-xs leading-[1.6]" style="color:#555">Rotina de 4x por semana para resistência e
                            potência.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ARTICLES -->
    <div class="py-24 bg-[#0e0f14]">
        <div class="text-center mb-12 sr px-6">
            <span class="text-[11px] font-bold tracking-[0.35em] uppercase block mb-4 font-condensed"
                style="color:#CAFF00">Aprofundamento</span>
            <h2 class="font-condensed font-black text-white" style="font-size:clamp(36px,5vw,64px)">GUIAS <span
                    style="color:#CAFF00">COMPLETOS</span></h2>
            <div class="w-12 h-[3px] mx-auto mt-5" style="background:#CAFF00"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-[2px]">
            <div class="ac md:col-span-2 sr" style="transition-delay:0.1s"><img
                    src="https://images.unsplash.com/photo-1546519638-68e109498ffc?w=900&q=80" alt="">
                <div class="ai">
                    <div class="text-[10px] font-bold uppercase mb-2 tracking-[0.2em] font-condensed"
                        style="color:#CAFF00">Especial · Basquete</div>
                    <div class="font-bold text-white leading-[1.3] text-2xl">O sistema de treino que formou 3 campeões
                        nacionais em 2 anos</div>
                </div>
            </div>
            <div class="flex flex-col gap-[2px]">
                <div class="ac sr flex-1" style="transition-delay:0.2s"><img
                        src="https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=600&q=80" alt="">
                    <div class="ai">
                        <div class="text-[10px] font-bold uppercase mb-2 tracking-[0.2em] font-condensed"
                            style="color:#CAFF00">Nutrição · Vôlei</div>
                        <div class="font-bold text-white leading-[1.3] text-lg">Pré-jogo: o que comer nas 3h antes da
                            partida</div>
                    </div>
                </div>
                <div class="ac sr flex-1" style="transition-delay:0.3s"><img
                        src="https://images.unsplash.com/photo-1502904550040-7534597429ae?w=600&q=80" alt="">
                    <div class="ai">
                        <div class="text-[10px] font-bold uppercase mb-2 tracking-[0.2em] font-condensed"
                            style="color:#CAFF00">Mental · Surf</div>
                        <div class="font-bold text-white leading-[1.3] text-lg">Como surfistas de elite controlam o medo
                            em ondas grandes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA BAND -->
    <div class="px-6 md:px-16 py-20 flex flex-col md:flex-row justify-between items-center gap-10 sr"
        style="background:#CAFF00">
        <h2 class="font-condensed font-black text-black leading-[0.9] max-w-[600px]"
            style="font-size:clamp(36px,5vw,72px)">PRONTO PARA O PRÓXIMO ESTÁGIO?</h2>
        <div class="flex flex-col gap-4 w-full md:w-auto" style="min-width:360px">
            <p class="text-[15px] text-black font-semibold leading-[1.5]">Junte-se a 50.000 atletas que decidiram ir
                além. Receba guias semanais e acompanhe sua evolução.</p>
            <div class="flex">
                <input type="email" placeholder="Seu melhor e-mail"
                    class="flex-1 border-none px-5 text-sm text-black outline-none font-sans"
                    style="background:rgba(0,0,0,0.12);padding:18px 20px;" placeholder-style="color:rgba(0,0,0,0.5)">
                <button
                    style="background:#000;color:#CAFF00;font-family:'Barlow Condensed',sans-serif;font-weight:900;font-size:13px;letter-spacing:0.15em;padding:18px 28px;border:none;cursor:pointer;text-transform:uppercase;transition:background 0.3s"
                    onmouseover="this.style.background='#1a1a1a'"
                    onmouseout="this.style.background='#000'">ASSINAR</button>
            </div>
            <p class="text-[11px]" style="color:rgba(0,0,0,0.5)">Sem spam. Só conteúdo de alto nível. Cancele quando
                quiser.</p>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="px-6 md:px-16 pt-16 pb-8" style="border-top:1px solid rgba(255,255,255,0.05)">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-16 mb-12">
            <div>
                <a href="#" class="font-condensed font-black italic text-[24px] text-white no-underline">NEXT<span
                        style="color:#CAFF00">STAGE</span></a>
                <p class="text-[13px] text-[#555] leading-[1.8] mt-4 max-w-[280px]">O guia definitivo de vida esportiva.
                    Nutrição, treino, mentalidade e comunidade para atletas de todos os níveis.</p>
            </div>
            <div>
                <h5 class="text-[11px] tracking-[0.2em] uppercase font-bold mb-5 font-condensed" style="color:#CAFF00">
                    Esportes</h5>
                <ul class="flex flex-col gap-3 list-none">
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Futebol</a>
                    </li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Basquete</a>
                    </li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Natação</a>
                    </li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Ciclismo</a>
                    </li>
                    <li><a href="#" class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">MMA
                            / Combate</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-[11px] tracking-[0.2em] uppercase font-bold mb-5 font-condensed" style="color:#CAFF00">
                    Conteúdo</h5>
                <ul class="flex flex-col gap-3 list-none">
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Planos de
                            Treino</a></li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Guias de
                            Nutrição</a></li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Mental &
                            Foco</a></li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Recuperação</a>
                    </li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Vídeos</a>
                    </li>
                </ul>
            </div>
            <div>
                <h5 class="text-[11px] tracking-[0.2em] uppercase font-bold mb-5 font-condensed" style="color:#CAFF00">
                    NextStage</h5>
                <ul class="flex flex-col gap-3 list-none">
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Sobre
                            Nós</a></li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Comunidade</a>
                    </li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Parceiros</a>
                    </li>
                    <li><a href="#"
                            class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex justify-between items-center pt-6" style="border-top:1px solid rgba(255,255,255,0.05)">
            <p class="text-[11px] tracking-[0.15em] font-condensed" style="color:#333">© 2026 NEXTSTAGE · INTELIGÊNCIA
                ESPORTIVA APLICADA</p>
            <div class="flex gap-4">
                <a href="#" class="sl"><i class="fab fa-instagram"></i></a>
                <a href="#" class="sl"><i class="fab fa-youtube"></i></a>
                <a href="#" class="sl"><i class="fab fa-twitter"></i></a>
                <a href="#" class="sl"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </footer>

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('show'); });
        }, { threshold: 0.08 });
        document.querySelectorAll('.sr').forEach(el => observer.observe(el));
    </script>
</body>

</html>