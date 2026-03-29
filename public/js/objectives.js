"use strict";

const API = "/api/objectives";
const headers = () => ({
    "Content-Type": "application/json",
    Accept: "application/json",
    Authorization: `Bearer ${localStorage.getItem("auth_token") || ""}`,
    "X-CSRF-TOKEN": "{{ csrf_token() }}",
});

let objectives = [];
let currentFilter = "all";
let deleteId = null;

document.addEventListener("DOMContentLoaded", () => {
    fetchObjectives();

    // Abrir modal novo
    document.getElementById("btn-new-objective").onclick = () => {
        document.getElementById("objective-form").reset();
        document.getElementById("objective-id").value = "";
        document.getElementById("modal-title").textContent = "NOVO OBJETIVO";
        openModal();
    };

    // Filtros
    document.querySelectorAll(".filter-btn").forEach((btn) => {
        btn.onclick = () => {
            currentFilter = btn.dataset.filter;
            document.querySelectorAll(".filter-btn").forEach((b) => {
                b.classList.remove(
                    "text-[#CAFF00]",
                    "border-b-2",
                    "border-[#CAFF00]",
                );
                b.classList.add("text-[#555]");
            });
            btn.classList.add(
                "text-[#CAFF00]",
                "border-b-2",
                "border-[#CAFF00]",
            );
            btn.classList.remove("text-[#555]");
            renderList();
        };
    });

    // Submit Form
    document.getElementById("objective-form").onsubmit = saveObjective;

    // Confirmar Delete
    document.getElementById("btn-confirm-delete").onclick = async () => {
        if (!deleteId) return;
        await fetch(`${API}/${deleteId}`, {
            method: "DELETE",
            headers: headers(),
        });
        showToast("Objetivo removido");
        closeDeleteModal();
        fetchObjectives();
    };
});

async function fetchObjectives() {
    document.getElementById("loading-state").classList.remove("hidden");
    try {
        const res = await fetch(API, { headers: headers() });
        const data = await res.json();
        objectives = data.data || data;
        renderList();
        updateStats();
    } catch (e) {
        console.error("Erro ao buscar", e);
    } finally {
        document.getElementById("loading-state").classList.add("hidden");
    }
}

function renderList() {
    const list = document.getElementById("objectives-list");
    const filtered = objectives.filter((o) => {
        if (currentFilter === "done") return o.completed;
        if (currentFilter === "pending") return !o.completed;
        return true;
    });

    list.innerHTML = "";

    filtered.forEach((obj) => {
        const isDone = obj.completed;
        const prioColor = {
            alta: "bg-red-500",
            media: "bg-yellow-400",
            baixa: "bg-green-400",
        }[obj.priority];

        const card = document.createElement("div");
        card.className = `bg-[#0e0f14] border border-white/5 p-6 transition-all hover:border-[#CAFF00]/40 ${isDone ? "opacity-40" : ""}`;
        card.innerHTML = `
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-3">
                        <input type="checkbox" ${isDone ? "checked" : ""} 
                               onchange="toggleComplete(${obj.id}, this.checked)" 
                               class="w-5 h-5 accent-[#CAFF00] cursor-pointer">
                        <div>
                            <h3 class="font-black uppercase text-white leading-tight ${isDone ? "line-through" : ""}">${obj.name}</h3>
                            <p class="text-[#555] text-xs mt-1">${obj.description || "Sem descrição"}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-white/5">
                    <div class="flex items-center gap-4">
                        <button onclick="editObjective(${obj.id})" class="text-[#555] hover:text-[#CAFF00] text-xs font-bold flex items-center gap-1 transition-colors">
                            <i class="fas fa-edit"></i> EDITAR
                        </button>
                        <button onclick="openDeleteModal(${obj.id})" class="text-[#555] hover:text-red-500 text-xs font-bold flex items-center gap-1 transition-colors">
                            <i class="fas fa-trash"></i> EXCLUIR
                        </button>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full ${prioColor}"></span>
                        <span class="text-[9px] text-[#555] font-black uppercase tracking-widest">${obj.priority}</span>
                    </div>
                </div>
            `;
        list.appendChild(card);
    });
}

async function saveObjective(e) {
    e.preventDefault();
    const id = document.getElementById("objective-id").value;
    const payload = {
        name: document.getElementById("field-title").value,
        description: document.getElementById("field-description").value,
        category: document.getElementById("field-category").value,
        priority: document.getElementById("field-priority").value,
    };

    const method = id ? "PUT" : "POST";
    const url = id ? `${API}/${id}` : API;

    try {
        await fetch(url, {
            method,
            headers: headers(),
            body: JSON.stringify(payload),
        });
        showToast(id ? "Objetivo atualizado!" : "Objetivo criado!");
        closeModal();
        fetchObjectives();
    } catch (e) {
        showToast("Erro ao salvar", "error");
    }
}

async function toggleComplete(id, completed) {
    await fetch(`${API}/${id}`, {
        method: "PUT",
        headers: headers(),
        body: JSON.stringify({ completed }),
    });
    fetchObjectives();
}

// Funções de Interface
window.editObjective = (id) => {
    const obj = objectives.find((o) => o.id === id);
    if (!obj) return;

    document.getElementById("objective-id").value = obj.id;
    document.getElementById("field-title").value = obj.name;
    document.getElementById("field-description").value = obj.description || "";
    document.getElementById("field-category").value = obj.category;
    document.getElementById("field-priority").value = obj.priority;
    document.getElementById("modal-title").textContent = "EDITAR OBJETIVO";
    openModal();
};

function openModal() {
    document
        .getElementById("modal-overlay")
        .classList.replace("hidden", "flex");
}
function closeModal() {
    document
        .getElementById("modal-overlay")
        .classList.replace("flex", "hidden");
}

window.openDeleteModal = (id) => {
    deleteId = id;
    document
        .getElementById("delete-overlay")
        .classList.replace("hidden", "flex");
};
function closeDeleteModal() {
    document
        .getElementById("delete-overlay")
        .classList.replace("flex", "hidden");
}

function updateStats() {
    const done = objectives.filter((o) => o.completed).length;
    document.getElementById("stat-total").textContent = objectives.length;
    document.getElementById("stat-done").textContent = done;
    document.getElementById("stat-pct").textContent =
        (objectives.length ? Math.round((done / objectives.length) * 100) : 0) +
        "%";
}

function showToast(msg) {
    const t = document.getElementById("toast");
    document.getElementById("toast-msg").textContent = msg;
    t.classList.replace("opacity-0", "opacity-100");
    t.classList.replace("translate-y-4", "translate-y-0");
    setTimeout(() => {
        t.classList.replace("opacity-100", "opacity-0");
        t.classList.replace("translate-y-0", "translate-y-4");
    }, 3000);
}
