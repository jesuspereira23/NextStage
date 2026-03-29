
    document.addEventListener("DOMContentLoaded", () => {

      /* ── Editar info ── */
      document.getElementById("btn-edit-info")?.addEventListener("click", () => {
        document.getElementById("info-view").classList.add("hidden");
        document.getElementById("info-form").classList.remove("hidden");
      });
      document.getElementById("btn-cancel-info")?.addEventListener("click", () => {
        document.getElementById("info-view").classList.remove("hidden");
        document.getElementById("info-form").classList.add("hidden");
      });

      /* ── Editar senha ── */
      document.getElementById("btn-edit-password")?.addEventListener("click", () => {
        document.getElementById("password-view").classList.add("hidden");
        document.getElementById("password-form").classList.remove("hidden");
      });
      document.getElementById("btn-cancel-password")?.addEventListener("click", () => {
        document.getElementById("password-view").classList.remove("hidden");
        document.getElementById("password-form").classList.add("hidden");
      });

      /* ── Btn editar perfil (hero) ── */
      document.getElementById("btn-edit-profile")?.addEventListener("click", () => {
        document.getElementById("info-view").classList.add("hidden");
        document.getElementById("info-form").classList.remove("hidden");
        document.getElementById("info-form").scrollIntoView({ behavior: "smooth", block: "center" });
      });

      /* ── Modal excluir conta ── */
      document.getElementById("btn-delete-account")?.addEventListener("click", () => {
        const overlay = document.getElementById("delete-account-overlay");
        overlay.classList.remove("hidden");
        overlay.classList.add("flex");
      });
      document.getElementById("btn-cancel-delete-account")?.addEventListener("click", () => {
        const overlay = document.getElementById("delete-account-overlay");
        overlay.classList.add("hidden");
        overlay.classList.remove("flex");
      });

      /* ── Stats via API ── */
      async function loadStats() {
        const token = window.Auth?.getToken() ?? localStorage.getItem("auth_token") ?? "";
        const h = {
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content ?? "",
        };
        try {
          const [exRes, wkRes, obRes] = await Promise.all([
            fetch("/api/exercises", { headers: h }),
            fetch("/api/workouts", { headers: h }),
            fetch("/api/objectives", { headers: h }),
          ]);
          const [exJson, wkJson, obJson] = await Promise.all([
            exRes.json(), wkRes.json(), obRes.json()
          ]);
          const exCount = (exJson.data ?? exJson).length ?? 0;
          const wkCount = (wkJson.data ?? wkJson).length ?? 0;
          const obList = obJson.data ?? obJson;
          const total = obList.length;
          const done = obList.filter(o => o.completed).length;
          const pct = total ? Math.round((done / total) * 100) : 0;

          document.getElementById("stat-exercises").textContent = exCount;
          document.getElementById("stat-workouts").textContent = wkCount;
          document.getElementById("stat-objectives").textContent = total;
          document.getElementById("stat-done").textContent = pct + "%";
          document.getElementById("pct-objectives").textContent = pct + "%";

          setTimeout(() => {
            document.getElementById("bar-objectives").style.width = pct + "%";
          }, 300);
        } catch (e) {
          console.error("Erro ao carregar stats:", e);
        }
      }

      loadStats();

      /* ── Flash messages ── */
      @if(session('success'))
        showToast("{{ session('success') }}", "success");
      @endif
      @if(session('error'))
        showToast("{{ session('error') }}", "error");
      @endif
  });

    function showToast(msg, type = "success") {
      const toast = document.getElementById("toast");
      const icon = document.getElementById("toast-icon");
      const label = document.getElementById("toast-msg");
      if (!toast) return;
      icon.className = type === "error" ? "fas fa-exclamation-circle text-red-400 text-sm" : "fas fa-check text-[#CAFF00] text-sm";
      label.textContent = msg;
      toast.classList.remove("translate-y-6", "opacity-0");
      toast.classList.add("translate-y-0", "opacity-100");
      setTimeout(() => {
        toast.classList.add("translate-y-6", "opacity-0");
        toast.classList.remove("translate-y-0", "opacity-100");
      }, 3500);
    }
