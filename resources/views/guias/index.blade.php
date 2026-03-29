@extends('layouts.app')

@section('content')
    <div class="px-6 md:px-16 py-10">
        <div>
            <h1 class="text-4xl font-bold text-[#CAFF00] mb-6 uppercase italic">Guias</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/xaejheK7WMXZklIVjSwaEiM0YN1XmvG9I9c27GLoy8E/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/cnR2ZS5lcy92LzE3/MDAxNTg0P3c9ODAw/JnByZXZpZXc9MDE3/NzQ2NDg3MTg1NTcu/anBn"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Futebol">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Futebol</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/pCY7ywyTxO8dLioT7f0NqiIBHLHY_qObL4CnTpOkDsw/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMudmVjdGVlenku/Y29tL3RpL2ZvdG9z/LWdyYXRpcy90Mi8x/NjU3OTE3NC1qb2dh/ZG9yZXMtZGUtYmFz/cXVldGUtdmlzdGEt/c3VwZXJpb3ItZm90/by5KUEc"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Basquete">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Basquete</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/6b5Ej_EnOYReaz3deAKJTt4mtnAnMavrSi0l43v557A/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMubmF0aW9uYWxn/ZW9ncmFwaGljYnJh/c2lsLmNvbS9maWxl/cy9zdHlsZXMvaW1h/Z2VfMzIwMC9wdWJs/aWMvbmF0aW9uYWxn/ZW9ncmFwaGljMjU2/NzUzMy53ZWJwP3c9/MTYwMCZoPTEwNjE"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Natacao">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Natação</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/lVvOwI2YnX-KqloTJ-zbNRUJ-qAMV8oipaTdhSYVVkE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMjE5/MjMyNDczNC9lcy9m/b3RvL2NpY2xpc3Rh/cy1jYXVjJUMzJUEx/c2ljb3MtYWN0aXZv/cy1leHBsb3JhbmRv/LWxvcy1jYW1pbm9z/LXJ1cmFsZXMtdmFj/JUMzJUFEb3MtZW4t/bGEtem9uYS1tb250/YSVDMyVCMW9zYS5q/cGc_cz02MTJ4NjEy/Jnc9MCZrPTIwJmM9/WFNvbWZPRW1lSTdf/eXluUE12NHBocmot/SXlxZVBLUjhjUzk2/QmprWXlfZz0"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Ciclismo">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Ciclismo</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/jLiUA24sfI8nJb6BzVv2-tkNow_fUNTj4IBZuN-UCXs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTQ5/MjY3MDcxMS9wdC9m/b3RvL2xhcmdlLWdy/b3VwLW9mLXBlb3Bs/ZS1ydW5uaW5nLWZh/c3QtaW4tdGhlLWNp/dHktZGVmb2N1c2Vk/LWxpZ2h0LWFuZC1z/aGFkb3dzLXNwb3J0/cy1iYWNrZ3JvdW5k/LmpwZz9zPTYxMng2/MTImdz0wJms9MjAm/Yz1NbjJHdTdDdUdE/MWMtZmNuRnFtTFk3/b2JkWTFhaFhuaHdy/cmJvUUl2akhnPQ"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Corrida">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Corrida</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/43poXsk5qcKhoyvbFtZGsRPPkDiSd6wshJBu1WP3fss/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTMx/OTcyMjMxNy9wdC9m/b3RvL3N1cmZlcnMt/d2FpdGluZy1pbi10/aGUtb2NlYW4tZm9y/LWEtd2F2ZS5qcGc_/cz02MTJ4NjEyJnc9/MCZrPTIwJmM9LVBK/X2NLaVVKT1RQRC0y/c21ZWUtMYUs0bVpr/YkZacXVFXzdPa1VI/ZU1vOD0"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Surf">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Surf</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/m7XNN2hmR0KVHHX7CT5InQIfWykTwQYL9YyI29DUElQ/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvNjAx/ODIxOTI3L3B0L2Zv/dG8vYm9keWJ1aWxk/ZXItcHJlcGFyaW5n/LWEtYmFyYmVsbC1v/bi1hLXBvd2VyLXJh/Y2staW4tZ3ltLmpw/Zz9zPTYxMng2MTIm/dz0wJms9MjAmYz15/a1YyS2ItWmtlaUI3/R2Ezd1c0MTJ4dS1L/eFJqeUY4ZkNCam9I/M3c2c1drPQ"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Musculacao">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Musculação</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/Wp5NQZ1zcXXeG1wTGshGCmk5yn4nQaQMrr27GJsh3Xg/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtcHJlbWl1/bS91bS1ncnVwby1k/ZS1qb3ZlbnMtYXRs/ZXRhcy1lbS11bWEt/YWNhZGVtaWEtY3Jv/c3NmaXQtcmVhbGl6/YW5kby11bWEtdmFy/aWVkYWRlLWRlLXJv/dGluYXMtZGUtZXhl/cmNpY2lvcy1lbnF1/YW50by1vLXRyZWlu/YWRvci1lLW91dHJv/cy1tZW1icm9zLWRv/LWdydXBvLW9zLXRv/cmNlbV8zNzg0OTQt/NDcyLmpwZz9zZW10/PWFpc19oeWJyaWQm/dz03NDAmcT04MA"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Crossfit">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Crossfit</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/AhtdioNcZ9cJVS-RVcrTCVDXMgBewY4ZwRjTq-DM6II/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zMS5z/dGF0aWMuYnJhc2ls/ZXNjb2xhLnVvbC5j/b20uYnIvYmUvMjAy/My8wNi9hdGFxdWUt/dm9sZWkuanBn"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Volei">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Vôlei</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/9Ldpo-37VgArvdM6HhN5OZMenGqM91P3_Pq18xIV7Mc/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly90My5m/dGNkbi5uZXQvanBn/LzAyLzM0LzcxLzEw/LzM2MF9GXzIzNDcx/MTA1OV93NTJ4dHZv/d25kcFN6Q0gxbWcx/ZmNQWmlCMlNRZFlU/UC5qcGc"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Lutas">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Lutas</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/fMbmlFkHkaKYiHYAElZlggugqKyH6CFKGn5UzmaTYcU/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLmFo/c3RhdGljLmNvbS9p/cy9pbWFnZS9hY2Nv/cmhvdGVscy9yZWdy/YXMtZG8tdGVuaXMt/c2FpYmEtcXVhaXMt/c2FvLW9zLWZ1bmRh/bWVudG9zLWRvLWVz/cG9ydGUtMjAyNC0x/OjE2Ynk5P2ZtdD1q/cGcmb3BfdXNtPTEu/NzUsMC4zLDIsMCZy/ZXNNb2RlPXNoYXJw/MiZpY2NFbWJlZD10/cnVlJmljYz1zUkdC/JmRwcj1vbiwxLjMm/d2lkPTMzNSZoZWk9/MTg4JnFsdD04MA"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Tenis">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter">Tênis</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-[#111111] border border-[#CAFF00]/50 rounded-lg p-4 hover:border-[#CAFF00] transition-all duration-300 group cursor-pointer relative">
                <div class="aspect-[4/3] w-full overflow-hidden rounded relative">
                    <img src="https://imgs.search.brave.com/JbHHmlk7_oq4rD20SDAT34iT_jtk7ZCO-UU12SDS0c0/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/aG9iYnl0dC5jb20u/YnIvd3AtY29udGVu/dC91cGxvYWRzLzIw/MjQvMDEvRW50ZW5k/YS1hLWRpZmVyZW5j/YS1lbnRyZS1waW5n/LXBvbmctZS10ZW5p/cy1kZS1tZXNhLmpw/Zw"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Ping pong">
                    <div
                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <span class="text-[#CAFF00] font-black text-2xl uppercase italic tracking-tighter text-center">Tênis
                            de Mesa</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection