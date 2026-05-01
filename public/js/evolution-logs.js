"use strict";

document.addEventListener("DOMContentLoaded", async () => {
    try {
        // Buscar objetivos da API
        const res = await fetch("/api/objectives", {
            headers: { Accept: "application/json" }
        });
        const data = await res.json();

        // Estatísticas
        const total = data.length;
        const done = data.filter(o => o.completed).length;
        const pct = total ? Math.round((done / total) * 100) : 0;

        // Atualizar números na tela
        document.getElementById("perf-total").textContent = total;
        document.getElementById("perf-done").textContent = done;
        document.getElementById("perf-progress").textContent = pct + "%";

        // Gráfico de pizza/donut
        const ctx = document.getElementById("performanceChart").getContext("2d");
        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Concluídos", "Pendentes"],
                datasets: [{
                    data: [done, total - done],
                    backgroundColor: ["#CAFF00", "#333"],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: { color: "#fff" }
                    }
                }
            }
        });
    } catch (e) {
        console.error("Erro ao carregar performance", e);
    }
});
