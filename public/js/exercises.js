"use strict";

/* ─── Config ─────────────────────────────────────────────── */
const API_EX = "/api/exercises";
const API_WORKOUTS = "/api/workouts";

function headers() {
    const token =
        window.Auth?.getToken() ?? localStorage.getItem("auth_token") ?? "";
    return {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
        "X-CSRF-TOKEN":
            document.querySelector('meta[name="csrf-token"]')?.content ?? "",
    };
}

/* ─── State ──────────────────────────────────────────────── */
let exercises = [];
let workouts = [];
let deleteTarget = null;
let editingId = null;

/* ─── DOM ────────────────────────────────────────────────── */
let listEl,
    tableHeader,
    emptyState,
    loadingState,
    modalOverlay,
    modalBox,
    deleteOverlay;

/* ─── Boot ───────────────────────────────────────────────── */
document.addEventListener("DOMContentLoaded", () => {
    listEl = document.getElementById("exercises-list");
    tableHeader = document.getElementById("table-header");
    emptyState = document.getElementById("empty-state");
    loadingState = document.getElementById("loading-state");
    modalOverlay = document.getElementById("modal-overlay");
    modalBox = document.getElementById("modal-box");
    deleteOverlay = document.getElementById("delete-overlay");

    // Remove classes de animação do Blade que impedem o modal de aparecer
    if (modalBox) {
        modalBox.classList.remove("opacity-0", "scale-95", "translate-y-6");
        modalBox.style.opacity = "1";
        modalBox.style.transform = "none";
    }

    bindEvents();
    fetchWorkouts();
    fetchExercises();
});

/* ─── Events ─────────────────────────────────────────────── */
function bindEvents() {
    document
        .getElementById("btn-new")
        ?.addEventListener("click", openCreateModal);
    document.getElementById("btn-close")?.addEventListener("click", closeModal);
    document
        .getElementById("btn-cancel")
        ?.addEventListener("click", closeModal);
    document
        .getElementById("btn-submit")
        ?.addEventListener("click", handleSubmit);
    document
        .getElementById("btn-cancel-delete")
        ?.addEventListener("click", closeDeleteModal);
    document
        .getElementById("btn-confirm-delete")
        ?.addEventListener("click", confirmDelete);

    modalOverlay?.addEventListener("click", (e) => {
        if (e.target === modalOverlay) closeModal();
    });
    deleteOverlay?.addEventListener("click", (e) => {
        if (e.target === deleteOverlay) closeDeleteModal();
    });

    document
        .getElementById("search-input")
        ?.addEventListener("input", renderList);
    document
        .getElementById("workout-filter")
        ?.addEventListener("change", renderList);
    document
        .getElementById("sort-select")
        ?.addEventListener("change", renderList);
}

/* ─── API ────────────────────────────────────────────────── */
async function fetchWorkouts() {
    try {
        const res = await fetch(API_WORKOUTS, { headers: headers() });
        const json = await res.json();
        workouts = json.data ?? json;
        populateWorkoutSelects();
    } catch {
        /* silencioso */
    }
}

async function fetchExercises() {
    showLoading(true);
    try {
        const res = await fetch(API_EX, { headers: headers() });
        const json = await res.json();
        exercises = json.data ?? json;
        renderList();
        updateStats();
    } catch {
        showToast("Erro ao carregar exercícios.", "error");
    } finally {
        showLoading(false);
    }
}

async function createExercise(payload) {
    const res = await fetch(API_EX, {
        method: "POST",
        headers: headers(),
        body: JSON.stringify(payload),
    });
    const json = await res.json();
    if (!res.ok) throw json;
    return json.data ?? json;
}

async function updateExercise(id, payload) {
    const res = await fetch(`${API_EX}/${id}`, {
        method: "PUT",
        headers: headers(),
        body: JSON.stringify(payload),
    });
    const json = await res.json();
    if (!res.ok) throw json;
    return json.data ?? json;
}

async function deleteExercise(id) {
    const res = await fetch(`${API_EX}/${id}`, {
        method: "DELETE",
        headers: headers(),
    });
    if (!res.ok) throw new Error("Erro ao remover.");
}

/* ─── Submit ─────────────────────────────────────────────── */
async function handleSubmit() {
    hideError();

    const workoutId = document.getElementById("field-workout").value;
    const name = document.getElementById("field-name").value.trim();
    const sets = document.getElementById("field-sets").value;
    const reps = document.getElementById("field-reps").value;
    const rest = document.getElementById("field-rest").value;
    const notes = document.getElementById("field-notes").value.trim();
    const order = document.getElementById("field-order").value;

    if (!workoutId) {
        showError("Selecione um treino.");
        return;
    }
    if (!name) {
        showError("O nome é obrigatório.");
        return;
    }

    const payload = {
        workout_id: Number(workoutId),
        name,
        sets: sets ? Number(sets) : null,
        reps: reps ? Number(reps) : null,
        rest: rest ? Number(rest) : null,
        notes: notes || null,
        order: order ? Number(order) : 0,
    };

    setSubmitLoading(true);
    try {
        if (editingId) {
            const updated = await updateExercise(editingId, payload);
            exercises = exercises.map((ex) =>
                ex.id === editingId ? { ...ex, ...updated } : ex,
            );
            showToast("Exercício atualizado!", "success");
        } else {
            const created = await createExercise(payload);
            exercises.unshift(created);
            showToast("Exercício criado!", "success");
        }
        closeModal();
        renderList();
        updateStats();
    } catch (err) {
        showError(err?.message ?? "Erro ao salvar.");
    } finally {
        setSubmitLoading(false);
    }
}

/* ─── Render ─────────────────────────────────────────────── */
function renderList() {
    const search =
        document.getElementById("search-input")?.value.toLowerCase() ?? "";
    const wFilter = document.getElementById("workout-filter")?.value ?? "";
    const sort = document.getElementById("sort-select")?.value ?? "name";

    let list = [...exercises];

    if (search) {
        list = list.filter(
            (ex) =>
                ex.name?.toLowerCase().includes(search) ||
                ex.notes?.toLowerCase().includes(search),
        );
    }

    if (wFilter) {
        list = list.filter((ex) => String(ex.workout_id) === wFilter);
    }

    list.sort((a, b) => {
        if (sort === "name") return (a.name ?? "").localeCompare(b.name ?? "");
        if (sort === "sets") return (b.sets ?? 0) - (a.sets ?? 0);
        if (sort === "reps") return (b.reps ?? 0) - (a.reps ?? 0);
        if (sort === "newest") return b.id - a.id;
        return 0;
    });

    if (list.length === 0) {
        listEl.classList.add("hidden");
        tableHeader.classList.remove("grid");
        tableHeader.classList.add("hidden");
        emptyState.classList.remove("hidden");
        emptyState.classList.add("flex");
        return;
    }

    emptyState.classList.add("hidden");
    emptyState.classList.remove("flex");
    listEl.classList.remove("hidden");
    tableHeader.classList.remove("hidden");
    tableHeader.classList.add("grid");

    listEl.innerHTML = list.map((ex) => exerciseRow(ex)).join("");

    list.forEach((ex) => {
        document
            .getElementById(`edit-${ex.id}`)
            ?.addEventListener("click", () => openEditModal(ex));
        document
            .getElementById(`delete-${ex.id}`)
            ?.addEventListener("click", () => openDeleteModal(ex.id));
    });
}

/* ─── Row ────────────────────────────────────────────────── */
function exerciseRow(ex) {
    const workout = workouts.find((w) => w.id === ex.workout_id);
    const restStr = ex.rest ? formatRest(ex.rest) : "—";

    return `
    <div style="display:flex; flex-direction:column; background:#0e0f14; border:1px solid rgba(255,255,255,0.04); transition:border-color 0.2s;">
        
        <!-- Dados principais -->
        <div style="display:grid; grid-template-columns:2fr 1fr 100px 100px 100px; gap:1rem; align-items:center; padding:1rem 1.5rem;">

            <!-- Nome -->
            <div style="display:flex; align-items:center; gap:0.75rem; min-width:0;">
                <div style="width:2rem; height:2rem; background:rgba(202,255,0,0.07); border:1px solid rgba(202,255,0,0.1); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fas fa-dumbbell" style="color:#CAFF00; font-size:10px;"></i>
                </div>
                <div style="min-width:0;">
                    <div style="font-family:'Barlow Condensed',sans-serif; font-weight:900; color:white; font-size:1rem; text-transform:uppercase; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${esc(ex.name)}</div>
                    ${ex.notes ? `<div style="font-size:11px; color:#444; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${esc(ex.notes)}</div>` : ""}
                </div>
            </div>

            <!-- Treino -->
            <div style="min-width:0; overflow:hidden;">
                ${
                    workout
                        ? `<span style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#CAFF00; display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${esc(workout.title)}</span>`
                        : `<span style="font-size:10px; color:#333;">—</span>`
                }
            </div>

            <!-- Séries -->
            <div style="text-align:center;">
                <span style="font-family:'Barlow Condensed',sans-serif; font-weight:900; color:white; font-size:1.125rem;">${ex.sets ?? "—"}</span>
            </div>

            <!-- Reps -->
            <div style="text-align:center;">
                <span style="font-family:'Barlow Condensed',sans-serif; font-weight:900; color:white; font-size:1.125rem;">${ex.reps ?? "—"}</span>
            </div>

            <!-- Descanso -->
            <div style="text-align:center;">
                <span style="font-size:11px; color:#555;">${restStr}</span>
            </div>
        </div>

        <!-- Ações — sempre visíveis -->
        <div style="display:flex; gap:0.25rem; padding:0.5rem 1.5rem 0.75rem; border-top:1px solid rgba(255,255,255,0.04); background:rgba(255,255,255,0.01);">
            <button id="edit-${ex.id}"
                style="display:flex; align-items:center; gap:0.5rem; padding:0.375rem 0.75rem; border:1px solid rgba(255,255,255,0.08); color:#555; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.1em; background:transparent; cursor:pointer; transition:all 0.2s;"
                onmouseover="this.style.color='#CAFF00';this.style.borderColor='#CAFF00';"
                onmouseout="this.style.color='#555';this.style.borderColor='rgba(255,255,255,0.08)';">
                <i class="fas fa-pencil" style="font-size:9px;"></i> EDITAR
            </button>
            <button id="delete-${ex.id}"
                style="display:flex; align-items:center; gap:0.5rem; padding:0.375rem 0.75rem; border:1px solid rgba(255,255,255,0.08); color:#555; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.1em; background:transparent; cursor:pointer; transition:all 0.2s;"
                onmouseover="this.style.color='#f87171';this.style.borderColor='#f87171';"
                onmouseout="this.style.color='#555';this.style.borderColor='rgba(255,255,255,0.08)';">
                <i class="fas fa-trash" style="font-size:9px;"></i> EXCLUIR
            </button>
        </div>
    </div>`;
}

/* ─── Stats ──────────────────────────────────────────────── */
function updateStats() {
    const total = exercises.length;
    const withSets = exercises.filter((e) => e.sets);
    const withReps = exercises.filter((e) => e.reps);
    const avgSets = withSets.length
        ? Math.round(withSets.reduce((s, e) => s + e.sets, 0) / withSets.length)
        : null;
    const avgReps = withReps.length
        ? Math.round(withReps.reduce((s, e) => s + e.reps, 0) / withReps.length)
        : null;
    const wCount = new Set(exercises.map((e) => e.workout_id).filter(Boolean))
        .size;

    document.getElementById("stat-total").textContent = total;
    document.getElementById("stat-avg-sets").textContent = avgSets ?? "—";
    document.getElementById("stat-avg-reps").textContent = avgReps ?? "—";
    document.getElementById("stat-workouts").textContent = wCount;
}

/* ─── Selects ────────────────────────────────────────────── */
function populateWorkoutSelects() {
    const filterSel = document.getElementById("workout-filter");
    const modalSel = document.getElementById("field-workout");
    const options = workouts
        .map((w) => `<option value="${w.id}">${esc(w.title)}</option>`)
        .join("");

    if (filterSel)
        filterSel.innerHTML =
            `<option value="">Todos os treinos</option>` + options;
    if (modalSel)
        modalSel.innerHTML =
            `<option value="">— Selecione —</option>` + options;
}

/* ─── Modal criar / editar ───────────────────────────────── */
function openCreateModal() {
    editingId = null;
    document.getElementById("modal-title").textContent = "NOVO EXERCÍCIO";
    document.getElementById("btn-submit-text").textContent = "CRIAR";
    document.getElementById("btn-submit-icon").className =
        "fas fa-plus text-xs";
    document.getElementById("exercise-id").value = "";
    document.getElementById("field-workout").value = "";
    document.getElementById("field-name").value = "";
    document.getElementById("field-sets").value = "";
    document.getElementById("field-reps").value = "";
    document.getElementById("field-rest").value = "";
    document.getElementById("field-notes").value = "";
    document.getElementById("field-order").value = "";
    hideError();
    showModal();
}

function openEditModal(ex) {
    editingId = ex.id;
    document.getElementById("modal-title").textContent = "EDITAR EXERCÍCIO";
    document.getElementById("btn-submit-text").textContent = "SALVAR";
    document.getElementById("btn-submit-icon").className =
        "fas fa-check text-xs";
    document.getElementById("exercise-id").value = ex.id;
    document.getElementById("field-workout").value = ex.workout_id ?? "";
    document.getElementById("field-name").value = ex.name ?? "";
    document.getElementById("field-sets").value = ex.sets ?? "";
    document.getElementById("field-reps").value = ex.reps ?? "";
    document.getElementById("field-rest").value = ex.rest ?? "";
    document.getElementById("field-notes").value = ex.notes ?? "";
    document.getElementById("field-order").value = ex.order ?? 0;
    hideError();
    showModal();
}

function showModal() {
    // Garante que o modal-box está visível independente das classes do Blade
    modalBox.style.opacity = "1";
    modalBox.style.transform = "none";
    modalBox.style.transition = "none";

    modalOverlay.classList.remove("hidden");
    modalOverlay.classList.add("flex");
}

function closeModal() {
    modalOverlay.classList.add("hidden");
    modalOverlay.classList.remove("flex");
}

/* ─── Modal deletar ──────────────────────────────────────── */
function openDeleteModal(id) {
    deleteTarget = id;
    deleteOverlay.classList.remove("hidden");
    deleteOverlay.classList.add("flex");
}

function closeDeleteModal() {
    deleteTarget = null;
    deleteOverlay.classList.add("hidden");
    deleteOverlay.classList.remove("flex");
}

async function confirmDelete() {
    if (!deleteTarget) return;
    try {
        await deleteExercise(deleteTarget);
        exercises = exercises.filter((ex) => ex.id !== deleteTarget);
        renderList();
        updateStats();
        showToast("Exercício removido.", "success");
    } catch {
        showToast("Erro ao remover.", "error");
    } finally {
        closeDeleteModal();
    }
}

/* ─── UI helpers ─────────────────────────────────────────── */
function showLoading(show) {
    loadingState?.classList.toggle("hidden", !show);
}

function setSubmitLoading(loading) {
    const btn = document.getElementById("btn-submit");
    const text = document.getElementById("btn-submit-text");
    const icon = document.getElementById("btn-submit-icon");
    if (btn) btn.disabled = loading;
    if (text)
        text.textContent = loading
            ? "SALVANDO..."
            : editingId
              ? "SALVAR"
              : "CRIAR";
    if (icon)
        icon.className = loading
            ? "fas fa-spinner fa-spin text-xs"
            : editingId
              ? "fas fa-check text-xs"
              : "fas fa-plus text-xs";
}

function showError(msg) {
    const el = document.getElementById("form-error");
    if (el) {
        el.textContent = msg;
        el.classList.remove("hidden");
    }
}

function hideError() {
    document.getElementById("form-error")?.classList.add("hidden");
}

function showToast(msg, type = "success") {
    const toast = document.getElementById("toast");
    const icon = document.getElementById("toast-icon");
    const label = document.getElementById("toast-msg");
    if (!toast) return;
    if (icon)
        icon.className =
            type === "error"
                ? "fas fa-exclamation-circle text-red-400 text-sm"
                : "fas fa-check text-[#CAFF00] text-sm";
    if (label) label.textContent = msg;
    toast.classList.remove("translate-y-4", "opacity-0");
    toast.classList.add("translate-y-0", "opacity-100");
    setTimeout(() => {
        toast.classList.add("translate-y-4", "opacity-0");
        toast.classList.remove("translate-y-0", "opacity-100");
    }, 3000);
}

function formatRest(seconds) {
    if (seconds < 60) return `${seconds}s`;
    const m = Math.floor(seconds / 60);
    const s = seconds % 60;
    return s ? `${m}m${s}s` : `${m}min`;
}

function esc(str) {
    return String(str ?? "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;");
}
