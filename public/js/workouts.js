"use strict";

const API_WORKOUTS = "/api/workouts";
const authHeaders = () => ({
    "Content-Type": "application/json",
    Accept: "application/json",
    Authorization: `Bearer ${localStorage.getItem("auth_token") || ""}`,
    "X-CSRF-TOKEN":
        document.querySelector('meta[name="csrf-token"]')?.content || "",
});

const SPORTS = [
    {
        value: "futebol",
        label: "Futebol",
        icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><circle cx="12" cy="12" r="10"/><path d="M12 12L7.5 8.5M12 12L16.5 8.5M12 12V17.5M7.5 8.5L4 11M7.5 8.5L8.5 4M16.5 8.5L20 11M16.5 8.5L15.5 4M12 17.5L8.5 20M12 17.5L15.5 20"/></svg>`,
    },
    {
        value: "basquete",
        label: "Basquete",
        icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><circle cx="12" cy="12" r="10"/><path d="M12 2v20M2 12h20M5.5 5.5l13 13M18.5 5.5l-13 13"/></svg>`,
    },
    {
        value: "musculacao",
        label: "Musculação",
        icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="m6.5 6.5 11 11M3 9l3-3M18 21l3-3M9 3l3 3M15 15l3 3M3 15l3 3M15 3l3 3M3 3l18 18"/></svg>`,
    },
    {
        value: "corrida",
        label: "Corrida",
        icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="m18 8-4 4 4 4M2 12h12M2 8h8M2 16h8"/></svg>`,
    },
    {
        value: "crossfit",
        label: "Crossfit",
        icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="M6 4v16M18 4v16M3 8h18M3 16h18"/></svg>`,
    },
    {
        value: "natacao",
        label: "Natação",
        icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="M2 6c.6.5 1.2 1 2.5 1s1.9-.5 2.5-1c.6-.5 1.2-1 2.5-1s1.9.5 2.5 1c.6.5 1.2 1 2.5 1s1.9-.5 2.5-1c.6-.5 1.2-1 2.5-1s1.9.5 2.5 1"/></svg>`,
    },
];

let workouts = [];
let currentFilter = "all";
let exerciseRows = [];
let editingId = null;
let deleteTarget = null;

document.addEventListener("DOMContentLoaded", () => {
    buildSportPicker();
    buildSportFilters();
    fetchWorkouts();
    bindEvents();
});

function bindEvents() {
    document.getElementById("btn-new-workout").onclick = openCreateModal;
    document.getElementById("btn-close-modal").onclick = closeModal;
    document.getElementById("btn-cancel").onclick = closeModal;
    document.getElementById("btn-submit").onclick = handleSubmit;
    document.getElementById("btn-add-exercise").onclick = () =>
        addExerciseRow();
    document.getElementById("btn-confirm-delete").onclick = confirmDelete;
    document.getElementById("btn-cancel-delete").onclick = () =>
        document.getElementById("delete-overlay").classList.add("hidden");

    const btnEmptyNew = document.getElementById("btn-empty-new");
    if (btnEmptyNew) btnEmptyNew.onclick = openCreateModal;
}

async function fetchWorkouts() {
    const loading = document.getElementById("loading-state");
    if (loading) loading.classList.remove("hidden");

    try {
        const res = await fetch(API_WORKOUTS, { headers: authHeaders() });

        if (!res.ok) {
            console.error("Erro da API workouts:", res.status);
            workouts = [];
            renderGrid();
            updateStats();
            return;
        }

        const data = await res.json();
        // Suporta { data: [...] } ou diretamente [...]
        workouts = Array.isArray(data)
            ? data
            : Array.isArray(data.data)
              ? data.data
              : [];

        renderGrid();
        updateStats();
    } catch (e) {
        console.error("Falha ao buscar treinos:", e);
        workouts = [];
        renderGrid();
        updateStats();
    } finally {
        if (loading) loading.classList.add("hidden");
    }
}

function renderGrid() {
    const grid = document.getElementById("workouts-grid");
    const empty = document.getElementById("empty-state");
    if (!grid) return;

    const data = Array.isArray(workouts) ? workouts : [];
    const filtered =
        currentFilter === "all"
            ? data
            : data.filter((w) => w.sport === currentFilter);

    if (!filtered.length) {
        grid.classList.add("hidden");
        if (empty) empty.classList.remove("hidden");
        return;
    }

    if (empty) empty.classList.add("hidden");
    grid.classList.remove("hidden");

    grid.innerHTML = filtered
        .map(
            (w) => `
        <div class="bg-[#0e0f14] border border-white/5 p-6 flex flex-col gap-4 hover:border-white/10 transition-all">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-[9px] font-bold tracking-[0.25em] uppercase text-[#CAFF00]">${w.sport_label ?? w.sport ?? "—"}</span>
                    <h3 class="font-black text-white uppercase text-lg leading-tight mt-1">${w.title ?? "Sem título"}</h3>
                </div>
                <div class="flex gap-2">
                    <button onclick='openEditModal(${JSON.stringify(w)})' class="text-[#555] hover:text-white transition-colors p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </button>
                    <button onclick='openDeleteModal(${w.id})' class="text-[#555] hover:text-red-500 transition-colors p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6"/></svg>
                    </button>
                </div>
            </div>
            <div class="flex gap-3 flex-wrap">
                ${w.duration ? `<span class="text-[9px] font-bold uppercase tracking-widest text-[#555] border border-white/5 px-2 py-1">${w.duration} min</span>` : ""}
                ${(w.difficulty_label ?? w.difficulty) ? `<span class="text-[9px] font-bold uppercase tracking-widest text-[#555] border border-white/5 px-2 py-1">${w.difficulty_label ?? w.difficulty}</span>` : ""}
                ${w.exercises_count > 0 ? `<span class="text-[9px] font-bold uppercase tracking-widest text-[#555] border border-white/5 px-2 py-1">${w.exercises_count} exercício${w.exercises_count !== 1 ? "s" : ""}</span>` : ""}
            </div>
            ${
                w.exercises?.length
                    ? `<ul class="space-y-1 mt-1">
                ${w.exercises
                    .slice(0, 3)
                    .map(
                        (ex) =>
                            `<li class="text-[11px] text-[#555] flex gap-2"><span class="text-[#333]">—</span>${ex.name}${ex.sets ? ` <span class="text-[#333]">${ex.sets}×${ex.reps ?? "?"}</span>` : ""}</li>`,
                    )
                    .join("")}
                ${w.exercises.length > 3 ? `<li class="text-[10px] text-[#333]">+${w.exercises.length - 3} mais</li>` : ""}
            </ul>`
                    : ""
            }
        </div>
    `,
        )
        .join("");
}

function buildSportFilters() {
    const container = document.getElementById("sport-filters");
    if (!container) return;

    const allBtn = container.querySelector('[data-sport="all"]');
    if (allBtn) {
        allBtn.onclick = () => setFilter("all", allBtn, container);
    }

    SPORTS.forEach((s) => {
        const btn = document.createElement("button");
        btn.dataset.sport = s.value;
        btn.className =
            "sport-filter-btn font-black text-[10px] uppercase px-4 py-2 border border-white/10 text-[#555] hover:text-white hover:border-white/30 transition-all";
        btn.textContent = s.label;
        btn.onclick = () => setFilter(s.value, btn, container);
        container.appendChild(btn);
    });
}

function setFilter(sport, activeBtn, container) {
    currentFilter = sport;
    container.querySelectorAll(".sport-filter-btn").forEach((b) => {
        b.classList.remove("active-sport");
        b.classList.add("text-[#555]");
        b.classList.remove("text-[#CAFF00]");
    });
    activeBtn.classList.add("active-sport");
    activeBtn.classList.remove("text-[#555]");
    renderGrid();
}

window.openEditModal = (w) => {
    editingId = w.id;
    document.getElementById("modal-title").textContent = "EDITAR TREINO";
    document.getElementById("field-title").value = w.title ?? "";
    document.getElementById("field-duration").value = w.duration ?? "";
    document.getElementById("field-difficulty").value =
        w.difficulty ?? "iniciante";
    document
        .querySelectorAll(".sport-opt")
        .forEach((btn) =>
            btn.classList.toggle("active", btn.dataset.sport === w.sport),
        );
    exerciseRows = (w.exercises ?? []).map((ex) => ({
        ...ex,
        _key: Math.random(),
    }));
    renderExerciseRows();
    showModal();
};

window.openDeleteModal = (id) => {
    deleteTarget = id;
    document
        .getElementById("delete-overlay")
        .classList.replace("hidden", "flex");
};

async function confirmDelete() {
    if (!deleteTarget) return;
    try {
        await fetch(`${API_WORKOUTS}/${deleteTarget}`, {
            method: "DELETE",
            headers: authHeaders(),
        });
        showToast("Treino removido!");
        fetchWorkouts();
    } catch (e) {
        console.error(e);
        showToast("Erro ao remover.");
    } finally {
        deleteTarget = null;
        document
            .getElementById("delete-overlay")
            .classList.replace("flex", "hidden");
    }
}

async function handleSubmit() {
    const titleEl = document.getElementById("field-title");
    const title = titleEl?.value?.trim();
    if (!title) {
        showToast("Informe o nome do treino.");
        titleEl?.focus();
        return;
    }

    const sport = document.querySelector(".sport-opt.active")?.dataset.sport;
    if (!sport) {
        showToast("Selecione um esporte.");
        return;
    }

    const payload = {
        title,
        sport,
        difficulty: document.getElementById("field-difficulty")?.value ?? null,
        duration: document.getElementById("field-duration")?.value
            ? parseInt(document.getElementById("field-duration").value)
            : null,
        exercises: exerciseRows
            .filter((r) => r.name?.trim())
            .map(({ name, sets, reps, rest, notes, order }) => ({
                name,
                sets: sets || null,
                reps: reps || null,
                rest: rest || null,
                notes: notes || null,
                order: order ?? 0,
            })),
    };

    const method = editingId ? "PUT" : "POST";
    const url = editingId ? `${API_WORKOUTS}/${editingId}` : API_WORKOUTS;

    try {
        const res = await fetch(url, {
            method,
            headers: authHeaders(),
            body: JSON.stringify(payload),
        });

        if (!res.ok) {
            const err = await res.json().catch(() => ({}));
            console.error("Erro ao salvar:", err);
            showToast("Erro ao salvar. Verifique os campos.");
            return;
        }

        closeModal();
        fetchWorkouts();
        showToast(editingId ? "Treino atualizado!" : "Treino criado!");
    } catch (e) {
        console.error(e);
        showToast("Erro de conexão.");
    }
}

function addExerciseRow() {
    exerciseRows.push({
        _key: Date.now() + Math.random(),
        name: "",
        sets: "",
        reps: "",
    });
    renderExerciseRows();
}

function renderExerciseRows() {
    const list = document.getElementById("exercises-list");
    if (!list) return;
    list.innerHTML = exerciseRows
        .map(
            (row) => `
        <div class="bg-white/5 border border-white/10 p-4 flex flex-col gap-2">
            <div class="flex justify-between items-center">
                <input type="text" placeholder="Nome do exercício" value="${row.name ?? ""}"
                    onchange="updateRow(${row._key}, 'name', this.value)"
                    class="bg-transparent border-b border-white/10 text-xs p-1 outline-none flex-1 text-white">
                <button onclick="removeRow(${row._key})" class="text-[#555] hover:text-red-400 ml-3 text-xs">✕</button>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <input type="number" placeholder="Sets" value="${row.sets ?? ""}"
                    onchange="updateRow(${row._key}, 'sets', this.value)"
                    class="bg-transparent border-b border-white/10 text-xs p-1 outline-none text-white">
                <input type="number" placeholder="Reps" value="${row.reps ?? ""}"
                    onchange="updateRow(${row._key}, 'reps', this.value)"
                    class="bg-transparent border-b border-white/10 text-xs p-1 outline-none text-white">
            </div>
        </div>
    `,
        )
        .join("");
}

window.updateRow = (key, field, val) => {
    const r = exerciseRows.find((x) => x._key === key);
    if (r) r[field] = val;
};

window.removeRow = (key) => {
    exerciseRows = exerciseRows.filter((x) => x._key !== key);
    renderExerciseRows();
};

function buildSportPicker() {
    const picker = document.getElementById("sport-picker");
    if (!picker) return;
    picker.innerHTML = SPORTS.map(
        (s) => `
        <button type="button" data-sport="${s.value}" class="sport-opt flex flex-col items-center gap-2 p-3 border border-white/5 transition-all hover:border-white/20">
            ${s.icon}
            <span class="text-[8px] font-bold uppercase text-[#555]">${s.label}</span>
        </button>
    `,
    ).join("");
    picker.querySelectorAll(".sport-opt").forEach((btn) => {
        btn.onclick = () => {
            picker
                .querySelectorAll(".sport-opt")
                .forEach((b) => b.classList.remove("active"));
            btn.classList.add("active");
        };
    });
}

function updateStats() {
    const data = Array.isArray(workouts) ? workouts : [];
    const statTotal = document.getElementById("stat-total");
    const statEsportes = document.getElementById("stat-esportes");
    const statExercises = document.getElementById("stat-exercises");
    if (statTotal) statTotal.textContent = data.length;
    if (statEsportes)
        statEsportes.textContent = [
            ...new Set(data.map((w) => w.sport)),
        ].length;
    if (statExercises)
        statExercises.textContent = data.reduce(
            (acc, w) => acc + (w.exercises_count ?? w.exercises?.length ?? 0),
            0,
        );
}

function showModal() {
    document
        .getElementById("modal-overlay")
        .classList.replace("hidden", "flex");
}

function closeModal() {
    document
        .getElementById("modal-overlay")
        .classList.replace("flex", "hidden");
    editingId = null;
    exerciseRows = [];
    document.getElementById("modal-title").textContent = "NOVO TREINO";
    document
        .querySelectorAll(".sport-opt")
        .forEach((b) => b.classList.remove("active"));
}

function openCreateModal() {
    editingId = null;
    document.getElementById("field-title").value = "";
    document.getElementById("field-duration").value = "";
    document.getElementById("field-difficulty").value = "iniciante";
    exerciseRows = [];
    renderExerciseRows();
    document.getElementById("modal-title").textContent = "NOVO TREINO";
    document
        .querySelectorAll(".sport-opt")
        .forEach((b) => b.classList.remove("active"));
    showModal();
}

function showToast(m) {
    const t = document.getElementById("toast");
    const msg = document.getElementById("toast-msg");
    if (!t || !msg) return;
    msg.textContent = m;
    t.classList.replace("opacity-0", "opacity-100");
    setTimeout(() => t.classList.replace("opacity-100", "opacity-0"), 3000);
}
