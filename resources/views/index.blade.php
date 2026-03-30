<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NextStage — Live Your Game</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        condensed: ['"Barlow Condensed"', 'sans-serif'],
                        body: ['Barlow', 'sans-serif'],
                    },
                    keyframes: {
                        ticker: { '0%': { transform: 'translateX(0)' }, '100%': { transform: 'translateX(-50%)' } },
                    },
                    animation: {
                        ticker: 'ticker 28s linear infinite',
                    }
                }
            }
        }
    </script>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,700;0,900;1,900&family=Barlow:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Barlow', sans-serif;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Barlow Condensed', sans-serif;
            text-transform: uppercase;
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #CAFF00;
        }

        .sr {
            opacity: 0;
            transform: translateY(48px);
            transition: opacity 0.85s ease, transform 0.85s ease;
        }

        .sr.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* BW hero photo */
        .hero-photo {
            filter: grayscale(100%) brightness(0.42);
        }

        /* sport card image zoom */
        .sport-card img {
            transition: transform 0.6s ease, filter 0.4s;
            filter: grayscale(25%) brightness(0.72);
        }

        .sport-card:hover img {
            transform: scale(1.1);
            filter: grayscale(0%) brightness(0.85);
        }

        /* article zoom */
        .article-card img {
            transition: transform 0.5s, filter 0.4s;
        }

        .article-card:hover img {
            transform: scale(1.06);
            filter: brightness(0.75);
        }

        /* pillar hover bar */
        .pillar-card {
            position: relative;
            transition: background 0.3s;
        }

        .pillar-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: transparent;
            transition: background 0.3s;
        }

        .pillar-card:hover::before {
            background: #CAFF00;
        }

        /* mini card arrow */
        .mini-card {
            position: relative;
        }

        .mini-card::after {
            content: '→';
            position: absolute;
            top: 16px;
            right: 16px;
            color: #CAFF00;
            font-size: 18px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mini-card:hover::after {
            opacity: 1;
        }

        /* features corner */
        .features-img-wrap {
            position: relative;
        }

        .features-img-wrap::before {
            content: '';
            position: absolute;
            bottom: -20px;
            left: -20px;
            width: 180px;
            height: 180px;
            border: 3px solid #CAFF00;
            border-radius: 4px;
            z-index: -1;
        }
    </style>
</head>

<body class="bg-[#08090D] text-white overflow-x-hidden">

    <!-- ===== NAV ===== -->
    <nav
        class="fixed top-0 left-0 w-full z-50 h-[70px] px-10 flex items-center justify-between bg-[#08090D]/92 backdrop-blur-xl border-b border-[#CAFF00]/[0.07]">
        <a href="#" class="font-condensed font-black italic text-[26px] tracking-tight text-white no-underline">
            NEXT<span class="text-[#CAFF00]">STAGE</span>
        </a>
        <ul class="hidden lg:flex gap-9 list-none m-0 p-0">
            <li><a href="#treino"
                    class="text-[11px] font-bold tracking-[0.2em] uppercase text-[#999] hover:text-[#CAFF00] transition-colors no-underline">Treino</a>
            </li>
            <li><a href="#vida"
                    class="text-[11px] font-bold tracking-[0.2em] uppercase text-[#999] hover:text-[#CAFF00] transition-colors no-underline">Pilares</a>
            </li>
            <li><a href="#guias"
                    class="text-[11px] font-bold tracking-[0.2em] uppercase text-[#999] hover:text-[#CAFF00] transition-colors no-underline">Esportes</a>
            </li>
            <li><a href="#comunidade"
                    class="text-[11px] font-bold tracking-[0.2em] uppercase text-[#999] hover:text-[#CAFF00] transition-colors no-underline">Guias</a>
            </li>
        </ul>
        <a href="/login"
            class="bg-[#CAFF00] text-black font-black text-[12px] tracking-[0.15em] uppercase px-6 py-[10px] rounded-[3px] no-underline hover:shadow-[0_0_24px_rgba(202,255,0,0.4)] hover:-translate-y-0.5 transition-all">
            Montar Plano
        </a>
    </nav>

    <!-- ===== HERO ===== -->
    <section class="relative min-h-screen flex items-end overflow-hidden pt-[70px]">
        <!-- B&W background photo -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=1800&q=90" alt="Natação de elite"
                class="hero-photo w-full h-full object-cover object-center" />
            <!-- gradient: heavy at bottom so text pops, lighter at top -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#08090D] via-[#08090D]/65 to-[#08090D]/10"></div>
            <!-- left vignette -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#08090D]/60 to-transparent"></div>
        </div>

        <!-- hero content, anchored to bottom -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-10 pb-24 lg:pb-32">
            <!-- eyebrow -->
            <div class="sr flex items-center gap-3 mb-6">
                <span class="block w-8 h-[2px] bg-[#CAFF00]"></span>
                <span class="text-[#CAFF00] text-[11px] font-bold tracking-[0.38em] uppercase">Guia de Vida
                    Esportiva</span>
            </div>
            <!-- headline -->
            <h1 class="sr font-condensed font-black leading-[0.86] mb-7 text-[clamp(68px,10vw,128px)]"
                style="transition-delay:.15s">
                VIVA O SEU<br><em class="text-[#CAFF00] italic">MELHOR<br>JOGO.</em>
            </h1>
            <!-- sub -->
            <p class="sr text-[16px] text-[#aaa] leading-[1.75] max-w-[440px] mb-10" style="transition-delay:.3s">
                Mais que placares. Transforme seu corpo, mente e rotina com o ecossistema NextStage — nutrição, treino,
                mental e comunidade em um só lugar.
            </p>
            <!-- buttons -->
            <div class="sr flex flex-wrap gap-4 mb-16" style="transition-delay:.45s">
                <a href="#"
                    class="inline-flex items-center gap-2 bg-[#CAFF00] text-black font-black text-[13px] tracking-[0.15em] uppercase px-10 py-[18px] rounded-[3px] no-underline hover:shadow-[0_0_36px_rgba(202,255,0,0.4)] hover:-translate-y-1 transition-all">
                    MONTAR MEU PLANO <i class="fas fa-chevron-right text-[11px]"></i>
                </a>
                <a href="#guias"
                    class="inline-flex items-center text-white font-bold text-[13px] tracking-[0.15em] uppercase px-9 py-[18px] border border-white/10 rounded-[3px] no-underline hover:border-[#CAFF00] hover:bg-[#CAFF00]/5 transition-all">
                    VER ESPORTES
                </a>
            </div>
            <!-- stats -->
            <div class="sr flex flex-wrap gap-10 pt-8 border-t border-white/[0.06]" style="transition-delay:.6s">
                <div>
                    <div class="font-condensed font-black text-[42px] text-[#CAFF00] leading-none">15+</div>
                    <div class="text-[11px] text-[#555] tracking-[0.1em] mt-1 uppercase">Modalidades</div>
                </div>
                <div>
                    <div class="font-condensed font-black text-[42px] text-[#CAFF00] leading-none">200+</div>
                    <div class="text-[11px] text-[#555] tracking-[0.1em] mt-1 uppercase">Guias de Treino</div>
                </div>
                <div>
                    <div class="font-condensed font-black text-[42px] text-[#CAFF00] leading-none">50k</div>
                    <div class="text-[11px] text-[#555] tracking-[0.1em] mt-1 uppercase">Atletas Ativos</div>
                </div>
            </div>
        </div>

        <!-- sport badge (bottom-right) -->
        <div class="absolute bottom-8 right-10 z-10 hidden lg:flex items-center gap-3">
            <span class="text-[#444] text-[10px] tracking-[0.2em] uppercase">Esporte em destaque</span>
            <span
                class="bg-[#CAFF00] text-black font-condensed font-black text-[12px] tracking-[0.1em] px-3 py-1">NATAÇÃO</span>
        </div>
    </section>

    <!-- ===== TICKER ===== -->
    <div class="bg-[#CAFF00] overflow-hidden py-[14px] whitespace-nowrap">
        <div class="inline-flex animate-ticker">
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">FUTEBOL
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">BASQUETE
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">NATAÇÃO
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">CICLISMO
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">TÊNIS
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">MMA
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">VÔLEI
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">CORRIDA
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">CROSSFIT
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">SURF
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">BOXE
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">ATLETISMO
                <span>✦</span></span>
            <!-- duplicate for seamless loop -->
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">FUTEBOL
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">BASQUETE
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">NATAÇÃO
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">CICLISMO
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">TÊNIS
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">MMA
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">VÔLEI
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">CORRIDA
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">CROSSFIT
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">SURF
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">BOXE
                <span>✦</span></span>
            <span
                class="inline-flex items-center gap-3 font-condensed font-black text-[15px] tracking-[0.1em] text-black px-8">ATLETISMO
                <span>✦</span></span>
        </div>
    </div>

    <!-- ===== PILARES ===== -->
    <section id="vida" class="px-10 py-28">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 sr">
                <span class="block text-[#CAFF00] text-[11px] font-bold tracking-[0.35em] uppercase mb-4">Os 6
                    Pilares</span>
                <h2 class="font-condensed font-black text-[clamp(36px,5vw,64px)]">ALTO <span
                        class="text-[#CAFF00]">RENDIMENTO</span><br>COMEÇA AQUI</h2>
                <div class="w-12 h-[3px] bg-[#CAFF00] mx-auto mt-5"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2px]">
                <div class="pillar-card bg-[#111318] p-14 hover:bg-[#161820] sr" style="transition-delay:.1s">
                    <div class="font-condensed font-black text-[80px] leading-none text-[#CAFF00]/[0.07] -mb-5">01</div>
                    <i class="fas fa-apple-whole text-[32px] text-[#CAFF00] mb-5 block"></i>
                    <h3 class="font-condensed font-black text-[24px] mb-4">Nutrição Tática</h3>
                    <p class="text-[14px] text-[#666] leading-[1.8]">Cardápios personalizados por esporte, foco em
                        recuperação muscular, energia de longa duração e composição corporal ideal para seu tipo de
                        atleta.</p>
                </div>
                <div class="pillar-card bg-[#111318] p-14 hover:bg-[#161820] sr" style="transition-delay:.2s">
                    <div class="font-condensed font-black text-[80px] leading-none text-[#CAFF00]/[0.07] -mb-5">02</div>
                    <i class="fas fa-brain text-[32px] text-[#CAFF00] mb-5 block"></i>
                    <h3 class="font-condensed font-black text-[24px] mb-4">Mentalidade Elite</h3>
                    <p class="text-[14px] text-[#666] leading-[1.8]">Técnicas de foco e visualização, controle de
                        ansiedade pré-jogo e resiliência psicológica usadas por campeões olímpicos e atletas de elite
                        mundial.</p>
                </div>
                <div class="pillar-card bg-[#111318] p-14 hover:bg-[#161820] sr" style="transition-delay:.3s">
                    <div class="font-condensed font-black text-[80px] leading-none text-[#CAFF00]/[0.07] -mb-5">03</div>
                    <i class="fas fa-dumbbell text-[32px] text-[#CAFF00] mb-5 block"></i>
                    <h3 class="font-condensed font-black text-[24px] mb-4">Treino Híbrido</h3>
                    <p class="text-[14px] text-[#666] leading-[1.8]">Planilhas que combinam força, explosão, mobilidade
                        e recuperação — periodizadas para você evoluir sem platôs e sem lesões.</p>
                </div>
                <div class="pillar-card bg-[#111318] p-14 hover:bg-[#161820] sr" style="transition-delay:.4s">
                    <div class="font-condensed font-black text-[80px] leading-none text-[#CAFF00]/[0.07] -mb-5">04</div>
                    <i class="fas fa-users text-[32px] text-[#CAFF00] mb-5 block"></i>
                    <h3 class="font-condensed font-black text-[24px] mb-4">Comunidade Ativa</h3>
                    <p class="text-[14px] text-[#666] leading-[1.8]">Conecte-se com atletas que compartilham metas e
                        resultados. Desafios semanais, rankings e acompanhamento de parceiros de treino.</p>
                </div>
                <div class="pillar-card bg-[#111318] p-14 hover:bg-[#161820] sr" style="transition-delay:.5s">
                    <div class="font-condensed font-black text-[80px] leading-none text-[#CAFF00]/[0.07] -mb-5">05</div>
                    <i class="fas fa-moon text-[32px] text-[#CAFF00] mb-5 block"></i>
                    <h3 class="font-condensed font-black text-[24px] mb-4">Recuperação & Sono</h3>
                    <p class="text-[14px] text-[#666] leading-[1.8]">Protocolos de recuperação ativa, crioterapia,
                        alongamentos pós-treino e guias de sono profundo para maximizar cada sessão.</p>
                </div>
                <div class="pillar-card bg-[#111318] p-14 hover:bg-[#161820] sr" style="transition-delay:.6s">
                    <div class="font-condensed font-black text-[80px] leading-none text-[#CAFF00]/[0.07] -mb-5">06</div>
                    <i class="fas fa-chart-line text-[32px] text-[#CAFF00] mb-5 block"></i>
                    <h3 class="font-condensed font-black text-[24px] mb-4">Métricas & Evolução</h3>
                    <p class="text-[14px] text-[#666] leading-[1.8]">Dashboards de performance, análise de carga de
                        treino e relatórios mensais de evolução corporal e técnica esportiva.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SPORTS SHOWCASE ===== -->
    <section id="guias" class="bg-[#0e0f14] pb-24">
        <div class="flex justify-between items-end px-10 pt-24 pb-14">
            <h2 class="font-condensed font-black text-[clamp(36px,5vw,60px)] sr">EXPLORE <span
                    class="text-[#CAFF00]">ESPORTES</span></h2>
            <span class="text-[#333] font-bold text-[12px] tracking-[0.2em] hidden md:block sr">+ DE 15
                MODALIDADES</span>
        </div>
        <!-- row 1: 3 cols -->
        <div class="grid grid-cols-3 gap-[4px] mb-[4px] px-[4px]">
            <div class="sport-card relative overflow-hidden h-[260px] cursor-pointer sr" style="transition-delay:.1s">
                <img src="https://images.unsplash.com/photo-1551958219-acbc608c6377?w=800&q=80"
                    class="w-full h-full object-cover" alt="Futebol">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">01</span>
                <div class="absolute bottom-0 left-0 right-0 p-5 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[20px]">Futebol</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">32
                        GUIAS</span>
                </div>
            </div>
            <div class="sport-card relative overflow-hidden h-[260px] cursor-pointer sr" style="transition-delay:.15s">
                <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?w=800&q=80"
                    class="w-full h-full object-cover" alt="Basquete">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">02</span>
                <div class="absolute bottom-0 left-0 right-0 p-5 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[20px]">Basquete</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">18
                        GUIAS</span>
                </div>
            </div>
            <div class="sport-card relative overflow-hidden h-[260px] cursor-pointer sr" style="transition-delay:.2s">
                <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=800&q=80"
                    class="w-full h-full object-cover" alt="Natação">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">03</span>
                <div class="absolute bottom-0 left-0 right-0 p-5 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[20px]">Natação</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">24
                        GUIAS</span>
                </div>
            </div>
        </div>
        <!-- row 2: 4 cols -->
        <div class="grid grid-cols-4 gap-[4px] mb-[4px] px-[4px]">
            <div class="sport-card relative overflow-hidden h-[200px] cursor-pointer sr" style="transition-delay:.25s">
                <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?w=600&q=80"
                    class="w-full h-full object-cover" alt="Ciclismo">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">04</span>
                <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[18px]">Ciclismo</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">15
                        GUIAS</span>
                </div>
            </div>
            <div class="sport-card relative overflow-hidden h-[200px] cursor-pointer sr" style="transition-delay:.3s">
                <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=600&q=80"
                    class="w-full h-full object-cover" alt="Corrida">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">05</span>
                <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[18px]">Corrida</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">27
                        GUIAS</span>
                </div>
            </div>
            <div class="sport-card relative overflow-hidden h-[200px] cursor-pointer sr" style="transition-delay:.35s">
                <img src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=600&q=80"
                    class="w-full h-full object-cover" alt="Tênis">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">06</span>
                <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[18px]">Tênis</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">12
                        GUIAS</span>
                </div>
            </div>
            <div class="sport-card relative overflow-hidden h-[200px] cursor-pointer sr" style="transition-delay:.4s">
                <img src="https://images.unsplash.com/photo-1595078475328-1ab05d0a6a0e?w=600&q=80"
                    class="w-full h-full object-cover" alt="MMA">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">07</span>
                <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[18px]">MMA</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">19
                        GUIAS</span>
                </div>
            </div>
        </div>
        <!-- row 3: 3 cols -->
        <div class="grid grid-cols-3 gap-[4px] px-[4px]">
            <div class="sport-card relative overflow-hidden h-[220px] cursor-pointer sr" style="transition-delay:.45s">
                <img src="https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=600&q=80"
                    class="w-full h-full object-cover" alt="Vôlei">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">08</span>
                <div class="absolute bottom-0 left-0 right-0 p-5 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[20px]">Vôlei</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">11
                        GUIAS</span>
                </div>
            </div>
            <div class="sport-card relative overflow-hidden h-[220px] cursor-pointer sr" style="transition-delay:.5s">
                <img src="https://images.unsplash.com/photo-1554284126-aa88f22d8b74?w=600&q=80"
                    class="w-full h-full object-cover" alt="Crossfit">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">09</span>
                <div class="absolute bottom-0 left-0 right-0 p-5 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[20px]">Crossfit</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">20
                        GUIAS</span>
                </div>
            </div>
            <div class="sport-card relative overflow-hidden h-[220px] cursor-pointer sr" style="transition-delay:.55s">
                <img src="https://images.unsplash.com/photo-1502904550040-7534597429ae?w=600&q=80"
                    class="w-full h-full object-cover" alt="Surf">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <span class="absolute top-4 right-4 font-condensed text-[13px] text-white/25 z-10">10</span>
                <div class="absolute bottom-0 left-0 right-0 p-5 flex justify-between items-end z-10">
                    <span class="font-condensed font-black text-[20px]">Surf</span>
                    <span class="bg-[#CAFF00] text-black text-[10px] font-black tracking-[0.1em] px-[10px] py-1">8
                        GUIAS</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TREINO / FEATURES ===== -->
    <section id="treino" class="px-10 py-28">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div class="features-img-wrap sr">
                <img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?w=800&q=80"
                    class="w-full h-[580px] object-cover rounded-[4px]" alt="Atleta">
                <div
                    class="absolute top-[30px] right-[-20px] bg-[#CAFF00] text-black font-condensed font-black text-[13px] tracking-[0.1em] px-5 py-3 z-10">
                    PLANOS PERSONALIZADOS</div>
            </div>
            <div class="sr" style="transition-delay:.2s">
                <span class="block text-[#CAFF00] text-[11px] font-bold tracking-[0.35em] uppercase mb-4">Como
                    Funciona</span>
                <h2 class="font-condensed font-black text-[clamp(38px,5vw,64px)] leading-[0.9] mb-6">SEU TREINO,<br>SUAS
                    <span class="text-[#CAFF00]">REGRAS.</span>
                </h2>
                <p class="text-[14px] text-[#666] leading-[1.8] max-w-[420px]">Respondemos um questionário rápido sobre
                    seu esporte, nível atual e objetivos. O NextStage gera um plano completo — treino, nutrição e rotina
                    de recuperação.</p>
                <ul class="flex flex-col gap-8 mt-12 list-none p-0">
                    <li class="flex gap-5 items-start">
                        <div
                            class="w-12 h-12 min-w-[48px] border border-[#CAFF00]/20 rounded-[4px] flex items-center justify-center text-[#CAFF00] text-[18px]">
                            <i class="fas fa-sliders"></i>
                        </div>
                        <div>
                            <h4 class="font-condensed font-black text-[18px] mb-1">Diagnóstico Personalizado</h4>
                            <p class="text-[13px] text-[#666] leading-[1.7]">Análise do seu perfil atlético,
                                disponibilidade de tempo e equipamento disponível para montar o plano ideal.</p>
                        </div>
                    </li>
                    <li class="flex gap-5 items-start">
                        <div
                            class="w-12 h-12 min-w-[48px] border border-[#CAFF00]/20 rounded-[4px] flex items-center justify-center text-[#CAFF00] text-[18px]">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <h4 class="font-condensed font-black text-[18px] mb-1">Planilhas Semanais Adaptativas</h4>
                            <p class="text-[13px] text-[#666] leading-[1.7]">O plano se ajusta conforme seu feedback —
                                mais intensidade quando você evolui, descanso quando precisa.</p>
                        </div>
                    </li>
                    <li class="flex gap-5 items-start">
                        <div
                            class="w-12 h-12 min-w-[48px] border border-[#CAFF00]/20 rounded-[4px] flex items-center justify-center text-[#CAFF00] text-[18px]">
                            <i class="fas fa-video"></i>
                        </div>
                        <div>
                            <h4 class="font-condensed font-black text-[18px] mb-1">Biblioteca de Exercícios em Vídeo
                            </h4>
                            <p class="text-[13px] text-[#666] leading-[1.7]">Mais de 500 vídeos demonstrativos com foco
                                em técnica correta para cada modalidade e objetivo.</p>
                        </div>
                    </li>
                    <li class="flex gap-5 items-start">
                        <div
                            class="w-12 h-12 min-w-[48px] border border-[#CAFF00]/20 rounded-[4px] flex items-center justify-center text-[#CAFF00] text-[18px]">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h4 class="font-condensed font-black text-[18px] mb-1">Resultados em 21 Dias</h4>
                            <p class="text-[13px] text-[#666] leading-[1.7]">Protocolo inicial de 3 semanas para
                                estabelecer base de condicionamento e medir os primeiros ganhos.</p>
                        </div>
                    </li>
                </ul>
                <a href="#"
                    class="inline-flex items-center gap-2 bg-[#CAFF00] text-black font-black text-[13px] tracking-[0.15em] uppercase px-10 py-[18px] rounded-[3px] mt-12 no-underline hover:shadow-[0_0_36px_rgba(202,255,0,0.35)] hover:-translate-y-1 transition-all">
                    COMEÇAR AGORA <i class="fas fa-arrow-right text-[11px]"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== QUOTE ===== -->
    <div class="px-10 py-20 text-center border-t border-b border-white/[0.04] sr">
        <p
            class="font-condensed font-black italic text-[clamp(26px,4vw,52px)] leading-[1.2] text-white/10 max-w-[900px] mx-auto mb-5">
            "O campeão não é quem nunca cai — é quem sabe <em class="text-[#CAFF00] not-italic">por que levantou</em> e
            como vai mais longe na próxima."
        </p>
        <p class="text-[#444] text-[12px] tracking-[0.25em] uppercase">— Filosofia NextStage</p>
    </div>

    <!-- ===== GUIAS EM DESTAQUE ===== -->
    <section id="comunidade" class="px-10 py-24">
        <div class="max-w-7xl mx-auto">
            <div class="mb-10 sr">
                <span class="block text-[#CAFF00] text-[11px] font-bold tracking-[0.35em] uppercase mb-3">Guias em
                    Destaque</span>
                <h2 class="font-condensed font-black text-[clamp(36px,5vw,56px)]">ÚLTIMOS <span
                        class="text-[#CAFF00]">CONTEÚDOS</span></h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="mini-card bg-[#111318] rounded-[4px] overflow-hidden hover:-translate-y-1.5 transition-transform sr"
                    style="transition-delay:.1s">
                    <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=400&q=80"
                        class="w-full h-[180px] object-cover" alt="">
                    <div class="p-5">
                        <div class="text-[#CAFF00] text-[10px] tracking-[0.2em] font-bold uppercase mb-2">Corrida</div>
                        <div class="font-bold text-[15px] mb-2">Como correr seu primeiro 10km sem parar</div>
                        <div class="text-[12px] text-[#555] leading-[1.6]">Protocolo de 8 semanas para iniciantes
                            atingirem a marca.</div>
                    </div>
                </div>
                <div class="mini-card bg-[#111318] rounded-[4px] overflow-hidden hover:-translate-y-1.5 transition-transform sr"
                    style="transition-delay:.2s">
                    <img src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?w=400&q=80"
                        class="w-full h-[180px] object-cover" alt="">
                    <div class="p-5">
                        <div class="text-[#CAFF00] text-[10px] tracking-[0.2em] font-bold uppercase mb-2">Musculação
                        </div>
                        <div class="font-bold text-[15px] mb-2">Hipertrofia para atletas de esportes coletivos</div>
                        <div class="text-[12px] text-[#555] leading-[1.6]">Ganho de massa sem perder agilidade no campo.
                        </div>
                    </div>
                </div>
                <div class="mini-card bg-[#111318] rounded-[4px] overflow-hidden hover:-translate-y-1.5 transition-transform sr"
                    style="transition-delay:.3s">
                    <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?w=400&q=80"
                        class="w-full h-[180px] object-cover" alt="">
                    <div class="p-5">
                        <div class="text-[#CAFF00] text-[10px] tracking-[0.2em] font-bold uppercase mb-2">Ciclismo</div>
                        <div class="font-bold text-[15px] mb-2">Nutrição para ciclistas de longa distância</div>
                        <div class="text-[12px] text-[#555] leading-[1.6]">O que comer antes, durante e após pedaladas
                            +60km.</div>
                    </div>
                </div>
                <div class="mini-card bg-[#111318] rounded-[4px] overflow-hidden hover:-translate-y-1.5 transition-transform sr"
                    style="transition-delay:.4s">
                    <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=400&q=80"
                        class="w-full h-[180px] object-cover" alt="">
                    <div class="p-5">
                        <div class="text-[#CAFF00] text-[10px] tracking-[0.2em] font-bold uppercase mb-2">Natação</div>
                        <div class="font-bold text-[15px] mb-2">Técnica de braçada: erros mais comuns</div>
                        <div class="text-[12px] text-[#555] leading-[1.6]">Os 5 erros que travam sua evolução na
                            piscina.</div>
                    </div>
                </div>
                <div class="mini-card bg-[#111318] rounded-[4px] overflow-hidden hover:-translate-y-1.5 transition-transform sr"
                    style="transition-delay:.5s">
                    <img src="https://images.unsplash.com/photo-1595078475328-1ab05d0a6a0e?w=400&q=80"
                        class="w-full h-[180px] object-cover" alt="">
                    <div class="p-5">
                        <div class="text-[#CAFF00] text-[10px] tracking-[0.2em] font-bold uppercase mb-2">Combate</div>
                        <div class="font-bold text-[15px] mb-2">Condicionamento para lutadores amadores</div>
                        <div class="text-[12px] text-[#555] leading-[1.6]">Rotina 4x/semana para resistência e potência
                            de golpes.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== ARTICLES ===== -->
    <div class="bg-[#0e0f14] px-10 py-24">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 sr">
                <span
                    class="block text-[#CAFF00] text-[11px] font-bold tracking-[0.35em] uppercase mb-4">Aprofundamento</span>
                <h2 class="font-condensed font-black text-[clamp(36px,5vw,64px)]">GUIAS <span
                        class="text-[#CAFF00]">COMPLETOS</span></h2>
                <div class="w-12 h-[3px] bg-[#CAFF00] mx-auto mt-5"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr_1fr] gap-[2px]">
                <div class="article-card relative overflow-hidden cursor-pointer h-[380px] sr"
                    style="transition-delay:.1s">
                    <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?w=900&q=80"
                        class="w-full h-full object-cover brightness-[0.55]" alt="">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                        <div class="text-[#CAFF00] text-[10px] tracking-[0.2em] font-bold uppercase mb-2">Especial ·
                            Basquete</div>
                        <div class="font-bold text-[26px] leading-[1.25]">O sistema de treino que formou 3 campeões
                            nacionais em 2 anos</div>
                    </div>
                </div>
                <div class="article-card relative overflow-hidden cursor-pointer h-[380px] sr"
                    style="transition-delay:.2s">
                    <img src="https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=600&q=80"
                        class="w-full h-full object-cover brightness-[0.55]" alt="">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-5 z-10">
                        <div class="text-[#CAFF00] text-[10px] tracking-[0.2em] font-bold uppercase mb-2">Nutrição ·
                            Vôlei</div>
                        <div class="font-bold text-[18px] leading-[1.3]">Pré-jogo: o que comer nas 3h antes da partida
                        </div>
                    </div>
                </div>
                <div class="article-card relative overflow-hidden cursor-pointer h-[380px] sr"
                    style="transition-delay:.3s">
                    <img src="https://images.unsplash.com/photo-1502904550040-7534597429ae?w=600&q=80"
                        class="w-full h-full object-cover brightness-[0.55]" alt="">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-5 z-10">
                        <div class="text-[#CAFF00] text-[10px] tracking-[0.2em] font-bold uppercase mb-2">Mental · Surf
                        </div>
                        <div class="font-bold text-[18px] leading-[1.3]">Como surfistas de elite controlam o medo em
                            ondas grandes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== CTA BAND ===== -->
    <div class="bg-[#CAFF00] px-10 py-20 flex flex-col lg:flex-row justify-between items-center gap-10 sr">
        <h2 class="font-condensed font-black text-black text-[clamp(36px,5vw,72px)] leading-[0.88] max-w-[560px]">PRONTO
            PARA O PRÓXIMO ESTÁGIO?</h2>
        <div class="flex flex-col gap-4 w-full lg:w-auto lg:min-w-[380px]">
            <p class="text-black font-semibold text-[15px] leading-[1.5]">Junte-se a 50.000 atletas que decidiram ir
                além. Receba guias semanais e acompanhe sua evolução.</p>
            <div class="flex">
                <input type="email" placeholder="Seu melhor e-mail"
                    class="flex-1 bg-black/10 border-0 px-5 py-[18px] text-[14px] text-black placeholder-black/40 outline-none"
                    style="font-family:Barlow,sans-serif">
                <button
                    class="bg-black text-[#CAFF00] font-black text-[13px] tracking-[0.15em] uppercase px-7 py-[18px] border-0 hover:bg-[#111] transition-colors cursor-pointer">ASSINAR</button>
            </div>
            <p class="text-[11px] text-black/50">Sem spam. Só conteúdo de alto nível. Cancele quando quiser.</p>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="px-10 pt-16 pb-8 border-t border-white/[0.05]">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_1fr] gap-14 mb-12">
                <div>
                    <a href="#" class="font-condensed font-black italic text-[24px] text-white no-underline">NEXT<span
                            class="text-[#CAFF00]">STAGE</span></a>
                    <p class="text-[13px] text-[#555] leading-[1.8] mt-4 max-w-[280px]">O guia definitivo de vida
                        esportiva. Nutrição, treino, mentalidade e comunidade para atletas de todos os níveis.</p>
                </div>
                <div>
                    <h5 class="text-[#CAFF00] text-[11px] tracking-[0.2em] uppercase font-bold mb-5">Esportes</h5>
                    <ul class="flex flex-col gap-3 list-none p-0 m-0">
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
                        <li><a href="#" class="text-[13px] text-[#CAFF00] no-underline">Ver Todos →</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-[#CAFF00] text-[11px] tracking-[0.2em] uppercase font-bold mb-5">Conteúdo</h5>
                    <ul class="flex flex-col gap-3 list-none p-0 m-0">
                        <li><a href="#"
                                class="text-[13px] text-[#555] no-underline hover:text-white transition-colors">Planos
                                de Treino</a></li>
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
                    <h5 class="text-[#CAFF00] text-[11px] tracking-[0.2em] uppercase font-bold mb-5">NextStage</h5>
                    <ul class="flex flex-col gap-3 list-none p-0 m-0">
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
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-white/[0.05]">
                <p class="text-[11px] text-[#333] tracking-[0.15em] uppercase">© 2026 NextStage · Inteligência Esportiva
                    Aplicada</p>
                <div class="flex gap-4">
                    <a href="#"
                        class="w-9 h-9 border border-white/[0.08] rounded-[3px] flex items-center justify-center text-[#444] text-[14px] no-underline hover:border-[#CAFF00] hover:text-[#CAFF00] transition-all"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#"
                        class="w-9 h-9 border border-white/[0.08] rounded-[3px] flex items-center justify-center text-[#444] text-[14px] no-underline hover:border-[#CAFF00] hover:text-[#CAFF00] transition-all"><i
                            class="fab fa-youtube"></i></a>
                    <a href="#"
                        class="w-9 h-9 border border-white/[0.08] rounded-[3px] flex items-center justify-center text-[#444] text-[14px] no-underline hover:border-[#CAFF00] hover:text-[#CAFF00] transition-all"><i
                            class="fab fa-twitter"></i></a>
                    <a href="#"
                        class="w-9 h-9 border border-white/[0.08] rounded-[3px] flex items-center justify-center text-[#444] text-[14px] no-underline hover:border-[#CAFF00] hover:text-[#CAFF00] transition-all"><i
                            class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const obs = new IntersectionObserver(
            entries => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('show'); }),
            { threshold: 0.08 }
        );
        document.querySelectorAll('.sr').forEach(el => obs.observe(el));
    </script>
</body>

</html>