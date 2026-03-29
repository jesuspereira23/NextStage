"use strict";

const hdrs = () => ({
    "Content-Type": "application/json",
    Accept: "application/json",
    Authorization: `Bearer ${localStorage.getItem("auth_token") ?? ""}`,
});

const $ = (id) => document.getElementById(id);
const txt = (id, v) => {
    const e = $(id);
    if (e) e.textContent = v;
};

/* ── Guard ── */
function guard() {
    if (!localStorage.getItem("auth_token")) {
        window.location.href = "/login";
        return false;
    }
    return true;
}

/* ── Clock + Date ── */
function startClock() {
    const tick = () => {
        const el = $("clock");
        if (el)
            el.textContent = new Date().toLocaleTimeString("pt-BR", {
                hour: "2-digit",
                minute: "2-digit",
            });
    };
    tick();
    setInterval(tick, 1000);

    const dateEl = $("dateLabel");
    if (dateEl) {
        const now = new Date();
        dateEl.textContent = now
            .toLocaleDateString("pt-BR", {
                weekday: "short",
                day: "numeric",
                month: "short",
            })
            .toUpperCase();
    }
}

/* ── User ── */
async function loadUser() {
    try {
        const r = await fetch("/api/me", { headers: hdrs() });
        if (!r.ok) {
            localStorage.removeItem("auth_token");
            window.location.href = "/login";
            return;
        }
        const u = await r.json();
        txt("userName", u.name?.split(" ")[0] ?? "Atleta");
        const av = $("userAvatar");
        if (av) av.textContent = (u.name?.[0] ?? "A").toUpperCase();
    } catch {}
}

/* ── Workouts ── */
async function loadWorkouts() {
    try {
        const r = await fetch("/api/workouts", { headers: hdrs() });
        if (!r.ok) return;
        const list = await r.json();
        const weekAgo = new Date();
        weekAgo.setDate(weekAgo.getDate() - 7);
        txt(
            "statWorkouts",
            list.filter((w) => new Date(w.created_at) > weekAgo).length,
        );
        if (list.length > 0) {
            const latest = list[0];
            txt("workoutTitle", latest.title ?? "Treino do dia");
            txt(
                "workoutMeta",
                [
                    latest.duration ? latest.duration + " min" : null,
                    latest.difficulty ?? null,
                ]
                    .filter(Boolean)
                    .join(" · ") || "Pronto para começar",
            );
            const cta = $("workoutCta");
            if (cta) {
                cta.href = "/workouts";
                cta.innerHTML = `<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg> Iniciar treino`;
            }
        }
    } catch (e) {
        console.error(e);
    }
}

/* ── Objectives ── */
async function loadObjectives() {
    const el = $("objectivesList");
    try {
        const r = await fetch("/api/objectives", { headers: hdrs() });
        if (!r.ok) {
            el.innerHTML = emptyState("Nenhum objetivo ainda");
            return;
        }
        const list = await r.json();
        txt("statObjectives", list.filter((o) => !o.completed).length);
        if (!list.length) {
            el.innerHTML = emptyState("Nenhum objetivo ainda");
            return;
        }
        el.innerHTML = list
            .slice(0, 4)
            .map(
                (o) => `
            <div class="flex items-center gap-3 py-2.5 border-b border-white/[.04] last:border-0">
                <div class="w-5 h-5 rounded-full shrink-0 flex items-center justify-center border-2 ${o.completed ? "bg-[#CAFF00] border-[#CAFF00]" : "border-zinc-700"}">
                    ${o.completed ? `<svg class="w-3 h-3 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>` : ""}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-white truncate ${o.completed ? "line-through opacity-40" : ""}">${o.name ?? "—"}</p>
                    <p class="text-[10px] text-zinc-600">${o.category ?? ""} ${o.priority ? "· " + o.priority : ""}</p>
                </div>
            </div>`,
            )
            .join("");
    } catch {
        el.innerHTML = emptyState("Erro ao carregar");
    }
}

/* ── Evolution ── */
async function loadEvolution() {
    const el = $("evolutionContent");
    try {
        const r = await fetch("/api/evolution-logs", { headers: hdrs() });
        if (!r.ok) {
            el.innerHTML = emptyState("Nenhum registro ainda");
            return;
        }
        const list = await r.json();
        txt("statLogs", list.length);
        if (!list.length) {
            el.innerHTML = emptyState("Nenhum registro ainda");
            return;
        }
        const latest = list.sort(
            (a, b) => new Date(b.created_at) - new Date(a.created_at),
        )[0];
        el.innerHTML = `
            <div class="grid grid-cols-2 gap-2.5 mb-3">
                ${latest.weight ? `<div class="bg-[#1F1F1F] border border-white/[.05] rounded-xl p-3.5"><p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Peso</p><p class="font-black text-xl text-white leading-none">${parseFloat(latest.weight).toFixed(1).replace(".", ",")} <span class="text-xs font-normal text-zinc-500">kg</span></p></div>` : ""}
                ${latest.body_fat ? `<div class="bg-[#1F1F1F] border border-white/[.05] rounded-xl p-3.5"><p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Gordura</p><p class="font-black text-xl text-white leading-none">${parseFloat(latest.body_fat).toFixed(1).replace(".", ",")} <span class="text-xs font-normal text-zinc-500">%</span></p></div>` : ""}
            </div>
            ${latest.performance_note ? `<div class="bg-[#1F1F1F] border border-white/[.05] rounded-xl p-3.5"><p class="text-[10px] text-[#CAFF00] font-bold uppercase tracking-widest mb-1">Nota</p><p class="text-xs text-zinc-400 leading-relaxed italic">${latest.performance_note}</p></div>` : ""}
            <p class="text-[10px] text-zinc-600 text-right mt-2">${list.length} registro${list.length !== 1 ? "s" : ""} total</p>`;
    } catch {
        el.innerHTML = emptyState("Erro ao carregar");
    }
}

/* ── Helpers ── */
function emptyState(msg) {
    return `<div class="flex flex-col items-center justify-center py-6 text-zinc-600"><svg class="w-7 h-7 mb-2 opacity-30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg><p class="text-xs">${msg}</p></div>`;
}

/* ── Boot ── */
document.addEventListener("DOMContentLoaded", () => {
    if (!guard()) return;
    startClock();
    loadUser();
    loadWorkouts();
    loadObjectives();
    loadEvolution();
});
