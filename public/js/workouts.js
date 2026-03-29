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
}

async function fetchWorkouts() {
    document.getElementById("loading-state").classList.remove("hidden");
    try {
        const res = await fetch(API_WORKOUTS, { headers: authHeaders() });
        const data = await res.json();
        workouts = data.data || data;
        renderGrid();
        updateStats();
    } catch (e) {
        console.error(e);
    } finally {
        document.getElementById("loading-state").classList.add("hidden");
    }
}

function renderGrid() {
    const grid = document.getElementById("workouts-grid");
    const filtered =
        currentFilter === "all"
            ? workouts
            : workouts.filter((w) => w.sport === currentFilter);

    grid.innerHTML = "";
    grid.classList.toggle("hidden", filtered.length === 0);
    document
        .getElementById("empty-state")
        .classList.toggle("hidden", filtered.length > 0);

    filtered.forEach((w) => {
        const card = document.createElement("div");
        card.className =
            "bg-[#0e0f14] border border-white/5 p-6 flex flex-col hover:border-[#CAFF00]/40 transition-all";
        card.innerHTML = `
                    <div class="mb-4 text-[#CAFF00]">${SPORTS.find((s) => s.value === w.sport)?.icon || ""}</div>
                    <h3 class="font-black text-white text-lg uppercase mb-1">${w.title}</h3>
                    <span class="text-[10px] text-[#555] uppercase font-bold tracking-widest mb-6">${w.sport}</span>

                    <div class="flex items-center gap-4 pt-5 border-t border-white/5 mt-auto">
                        <button onclick='openEditModal(${JSON.stringify(w)})' class="text-[#555] hover:text-[#CAFF00] text-[10px] font-black uppercase flex items-center gap-1 transition-colors">
                            <i class="fas fa-edit"></i> EDITAR
                        </button>
                        <button onclick="openDeleteModal(${w.id})" class="text-[#555] hover:text-red-500 text-[10px] font-black uppercase flex items-center gap-1 transition-colors">
                            <i class="fas fa-trash"></i> EXCLUIR
                        </button>
                    </div>
                `;
        grid.appendChild(card);
    });
}

window.openEditModal = (w) => {
    editingId = w.id;
    document.getElementById("modal-title").textContent = "EDITAR TREINO";
    document.getElementById("field-title").value = w.title;
    document.getElementById("field-duration").value = w.duration || "";
    document.getElementById("field-difficulty").value = w.difficulty || "";
    document
        .querySelectorAll(".sport-opt")
        .forEach((btn) =>
            btn.classList.toggle("active", btn.dataset.sport === w.sport),
        );
    exerciseRows = (w.exercises || []).map((ex) => ({
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
    await fetch(`${API_WORKOUTS}/${deleteTarget}`, {
        method: "DELETE",
        headers: authHeaders(),
    });
    document
        .getElementById("delete-overlay")
        .classList.replace("flex", "hidden");
    showToast("Removido!");
    fetchWorkouts();
}

async function handleSubmit() {
    const sport = document.querySelector(".sport-opt.active")?.dataset.sport;
    const payload = {
        title: document.getElementById("field-title").value,
        sport: sport,
        difficulty: document.getElementById("field-difficulty").value,
        duration: document.getElementById("field-duration").value,
        exercises: exerciseRows,
    };
    const method = editingId ? "PUT" : "POST";
    const url = editingId ? `${API_WORKOUTS}/${editingId}` : API_WORKOUTS;
    const res = await fetch(url, {
        method,
        headers: authHeaders(),
        body: JSON.stringify(payload),
    });
    if (res.ok) {
        closeModal();
        fetchWorkouts();
        showToast("Salvo!");
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
    list.innerHTML = exerciseRows
        .map(
            (row) => `
                <div class="bg-white/5 border border-white/10 p-4 flex flex-col gap-2">
                    <input type="text" placeholder="Nome" value="${row.name}" onchange="updateRow(${row._key}, 'name', this.value)" class="bg-transparent border-b border-white/10 text-xs p-1 outline-none">
                    <div class="grid grid-cols-2 gap-2">
                        <input type="number" placeholder="Sets" value="${row.sets}" onchange="updateRow(${row._key}, 'sets', this.value)" class="bg-transparent border-b border-white/10 text-xs p-1 outline-none">
                        <input type="number" placeholder="Reps" value="${row.reps}" onchange="updateRow(${row._key}, 'reps', this.value)" class="bg-transparent border-b border-white/10 text-xs p-1 outline-none">
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

function buildSportPicker() {
    const picker = document.getElementById("sport-picker");
    picker.innerHTML = SPORTS.map(
        (s) => `
                <button type="button" data-sport="${s.value}" class="sport-opt flex flex-col items-center gap-2 p-3 border border-white/5 transition-all">
                    ${s.icon} <span class="text-[8px] font-bold uppercase text-[#555]">${s.label}</span>
                </button>
            `,
    ).join("");
    picker.querySelectorAll(".sport-opt").forEach(
        (btn) =>
            (btn.onclick = () => {
                picker
                    .querySelectorAll(".sport-opt")
                    .forEach((b) => b.classList.remove("active"));
                btn.classList.add("active");
            }),
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
}

function updateStats() {
    document.getElementById("stat-total").textContent = workouts.length;
    document.getElementById("stat-esportes").textContent = [
        ...new Set(workouts.map((w) => w.sport)),
    ].length;
    document.getElementById("stat-exercises").textContent = workouts.reduce(
        (acc, w) => acc + (w.exercises?.length || 0),
        0,
    );
}

function showToast(m) {
    const t = document.getElementById("toast");
    document.getElementById("toast-msg").textContent = m;
    t.classList.replace("opacity-0", "opacity-100");
    setTimeout(() => t.classList.replace("opacity-100", "opacity-0"), 3000);
}

function openCreateModal() {
    editingId = null;
    document.getElementById("field-title").value = "";
    exerciseRows = [];
    renderExerciseRows();
    showModal();
}
