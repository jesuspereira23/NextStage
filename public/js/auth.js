"use strict";

const Auth = {
    getToken: () => localStorage.getItem("auth_token") ?? "",
    setToken: (token) => localStorage.setItem("auth_token", token),
    clearToken: () => localStorage.removeItem("auth_token"),
    isLogged: () => !!localStorage.getItem("auth_token"),

    headers: () => ({
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${Auth.getToken()}`,
        "X-CSRF-TOKEN":
            document.querySelector('meta[name="csrf-token"]')?.content ?? "",
    }),

    redirect: (user) => {
        window.location.href = "/dashboard";
    },

    logout: async () => {
        try {
         calcu   await fetch("/api/logout", {
                method: "POST",
                headers: Auth.headers(),
            });
        } catch (_) {}
        Auth.clearToken();
        window.location.href = "/login";
    },
};

function setFieldError(field, message) {
    const input = document.getElementById(field);
    const error = document.getElementById(`error-${field}`);
    input?.classList.add("border-red-500");
    if (error) {
        error.textContent = message;
        error.classList.remove("hidden");
    }
}

function clearErrors() {
    document.querySelectorAll(".error-text").forEach((el) => {
        el.classList.add("hidden");
        el.textContent = "";
    });
    document.querySelectorAll(".input-field").forEach((el) => {
        el.classList.remove("border-red-500", "border-[#FF0073]");
    });
}

function setBtnLoading(loading, label = "ENTRAR") {
    const btn = document.getElementById("btn-submit");
    const text = document.getElementById("btn-submit-text");
    if (!btn) return;
    btn.disabled = loading;
    if (text) text.textContent = loading ? "AGUARDE..." : label;
}

// LOGIN
document.getElementById("loginForm")?.addEventListener("submit", async (e) => {
    e.preventDefault();
    clearErrors();
    setBtnLoading(true, "ENTRAR");
    const email = document.getElementById("email")?.value.trim();
    const password = document.getElementById("passwordInput")?.value;
    try {
        const res = await fetch("/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN":
                    document.querySelector('meta[name="csrf-token"]')
                        ?.content ?? "",
            },
            body: JSON.stringify({ email, password }),
        });
        const data = await res.json();
        if (res.ok) {
            Auth.setToken(data.token);
            Auth.redirect(data.user);
        } else {
            if (data.errors)
                Object.entries(data.errors).forEach(([f, m]) =>
                    setFieldError(f, m[0]),
                );
            else
                setFieldError(
                    "email",
                    data.message ?? "E-mail ou senha incorretos.",
                );
        }
    } catch (err) {
        console.error(err);
        setFieldError("email", "Erro de conexão. Tente novamente.");
    } finally {
        setBtnLoading(false, "ENTRAR");
    }
});

// REGISTER
document
    .getElementById("registerForm")
    ?.addEventListener("submit", async (e) => {
        e.preventDefault();
        clearErrors();
        setBtnLoading(true, "CRIAR CONTA");
        const name = document.getElementById("name")?.value.trim();
        const email = document.getElementById("email")?.value.trim();
        const password = document.getElementById("passwordInput")?.value;
        try {
            const res = await fetch("/api/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN":
                        document.querySelector('meta[name="csrf-token"]')
                            ?.content ?? "",
                },
                body: JSON.stringify({
                    name,
                    email,
                    password,
                    password_confirmation: password,
                }),
            });
            const data = await res.json();
            if (res.ok) {
                Auth.setToken(data.token);
                Auth.redirect(data.user);
            } else {
                if (data.errors)
                    Object.entries(data.errors).forEach(([f, m]) =>
                        setFieldError(f, m[0]),
                    );
                else
                    setFieldError(
                        "email",
                        data.message ?? "Erro ao cadastrar.",
                    );
            }
        } catch (err) {
            console.error(err);
            setFieldError("email", "Erro de conexão. Tente novamente.");
        } finally {
            setBtnLoading(false, "CRIAR CONTA");
        }
    });

document.getElementById("btn-logout")?.addEventListener("click", Auth.logout);
window.Auth = Auth;
