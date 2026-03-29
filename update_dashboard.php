<?php

$file = 'resources/views/dashboard.blade.php';
$content = file_get_contents($file);

// Replace default Tailwind green with the NextStage theme green
$content = str_replace('#22C55E', '#CAFF00', $content);
$content = str_replace('34,197,94', '202,255,0', $content);
$content = str_replace('#1db352', '#b3e600', $content); // hover color

// Fix the typo
$content = str_replace("@endsectionç", "@endsection", $content);

$append = <<<'EOD'

        {{-- ── GESTÃO DO SISTEMA (CRUDS) ── --}}
        <div class="mt-12 mb-8">
            <h2 class="text-2xl font-black text-white uppercase italic mb-5" style="font-family:'Syne',sans-serif">Gestão do Sistema</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                
                {{-- Card Níveis --}}
                <a href="{{ route('levels.index') }}" class="group bg-[#161616] border border-white/[.06] hover:border-[#CAFF00]/50 rounded-2xl p-5 flex flex-col items-center justify-center gap-3 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-[#CAFF00]/10 flex items-center justify-center text-[#CAFF00] group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <span class="font-bold text-[11px] tracking-wide uppercase">Níveis</span>
                </a>

                {{-- Card Objetivos --}}
                <a href="{{ route('objectives.index') }}" class="group bg-[#161616] border border-white/[.06] hover:border-[#CAFF00]/50 rounded-2xl p-5 flex flex-col items-center justify-center gap-3 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-[#CAFF00]/10 flex items-center justify-center text-[#CAFF00] group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="font-bold text-[11px] tracking-wide uppercase">Objetivos</span>
                </a>

                {{-- Card Treinos --}}
                <a href="{{ route('workouts.index') }}" class="group bg-[#161616] border border-white/[.06] hover:border-[#CAFF00]/50 rounded-2xl p-5 flex flex-col items-center justify-center gap-3 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-[#CAFF00]/10 flex items-center justify-center text-[#CAFF00] group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <span class="font-bold text-[11px] tracking-wide uppercase">Treinos</span>
                </a>

                {{-- Card Exercícios --}}
                <a href="{{ route('exercises.index') }}" class="group bg-[#161616] border border-white/[.06] hover:border-[#CAFF00]/50 rounded-2xl p-5 flex flex-col items-center justify-center gap-3 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-[#CAFF00]/10 flex items-center justify-center text-[#CAFF00] group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </div>
                    <span class="font-bold text-[11px] tracking-wide uppercase">Exercícios</span>
                </a>

                {{-- Card Evolução --}}
                <a href="{{ route('evolution-logs.index') }}" class="group bg-[#161616] border border-white/[.06] hover:border-[#CAFF00]/50 rounded-2xl p-5 flex flex-col items-center justify-center gap-3 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-[#CAFF00]/10 flex items-center justify-center text-[#CAFF00] group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                    <span class="font-bold text-[11px] tracking-wide uppercase">Evolução</span>
                </a>

            </div>
        </div>

    </div>
    </div>
EOD;

// Insert $append right before "    </div>\n    </div>"
// The dashboard.blade.php ends with:
/*
        </div>{{-- /main-grid --}}
    </div>
    </div>

    @push('styles')
*/
$splitToken = "        </div>{{-- /main-grid --}}";
$parts = explode($splitToken, $content);
if (count($parts) === 2) {
    $newContent = $parts[0] . $splitToken . $append . "\n" . $parts[1];
    file_put_contents($file, $newContent);
    echo "Dashboard successfully updated with new colors and CRUD sections.\n";
} else {
    echo "Error parsing dashboard.blade.php.\n";
}
