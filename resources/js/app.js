import "./bootstrap";
import { createIcons, icons } from "lucide";

/* =========================
   THEME
========================= */
const applyTheme = () => {
    const savedTheme = localStorage.getItem("theme");

    if (
        savedTheme === "dark" ||
        (!savedTheme &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
};

/* =========================
   INIT APP
========================= */
applyTheme();

document.addEventListener("DOMContentLoaded", () => {
    createIcons({ icons });

    /* =========================
       SIDEBAR SYSTEM (FIXED)
    ========================= */

    const leftSidebar = document.getElementById("left-sidebar");
    const rightSidebar = document.getElementById("right-sidebar");
    const overlay = document.getElementById("overlay");

    const btnLeft = document.getElementById("toggle-left");
    const btnRight = document.getElementById("toggle-right");

    const isMobile = () => window.innerWidth < 1024;

    const LS_LEFT = "sidebar_left";
    const LS_RIGHT = "sidebar_right";

    const getState = (key) => localStorage.getItem(key) ?? "open";
    const setState = (key, value) => localStorage.setItem(key, value);

    /* =========================
       APPLY STATE (FIXED CORE)
    ========================= */
    const applyState = () => {
        if (!leftSidebar || !rightSidebar) return;

        const leftState = getState(LS_LEFT);
        const rightState = getState(LS_RIGHT);

        // 🔥 RESET FIRST (prevents broken states)
        leftSidebar.classList.remove("-translate-x-full", "sidebar-hidden");
        rightSidebar.classList.remove("translate-x-full", "sidebar-hidden");

        if (isMobile()) {
            // MOBILE → use transform
            if (leftState === "closed") {
                leftSidebar.classList.add("-translate-x-full");
            }

            if (rightState === "closed") {
                rightSidebar.classList.add("translate-x-full");
            }
        } else {
            // DESKTOP → use collapse
            if (leftState === "closed") {
                leftSidebar.classList.add("sidebar-hidden");
            }

            if (rightState === "closed") {
                rightSidebar.classList.add("sidebar-hidden");
            }
        }

        syncOverlay();
    };

    /* =========================
       OVERLAY SYNC (FIXED)
    ========================= */
    const syncOverlay = () => {
        if (!overlay) return;

        if (!isMobile()) {
            overlay.classList.add("hidden");
            return;
        }

        const leftOpen = getState(LS_LEFT) === "open";
        const rightOpen = getState(LS_RIGHT) === "open";

        overlay.classList.toggle("hidden", !(leftOpen || rightOpen));
    };

    /* =========================
       TOGGLES (FIXED)
    ========================= */
    const toggleLeft = () => {
        if (!leftSidebar) return;

        const newState = getState(LS_LEFT) === "closed" ? "open" : "closed";
        setState(LS_LEFT, newState);

        applyState(); // 🔥 always re-sync UI
    };

    const toggleRight = () => {
        if (!rightSidebar) return;

        const newState = getState(LS_RIGHT) === "closed" ? "open" : "closed";
        setState(LS_RIGHT, newState);

        applyState();
    };

    const closeAll = () => {
        setState(LS_LEFT, "closed");
        setState(LS_RIGHT, "closed");
        applyState();
    };

    /* =========================
       EVENTS
    ========================= */
    btnLeft?.addEventListener("click", toggleLeft);
    btnRight?.addEventListener("click", toggleRight);
    overlay?.addEventListener("click", closeAll);

    applyState();
    window.addEventListener("resize", applyState);

    /* =========================
       CLEANUP ANIMATIONS
    ========================= */
    setTimeout(() => {
        document.querySelectorAll(".animate-fade-in").forEach((el) => {
            el.style.opacity = "0";
            setTimeout(() => el.remove(), 300);
        });
    }, 5000);
});

/* =========================
   LOADER
========================= */
window.showLoader = () => {
    document.getElementById("global-loader")?.classList.remove("hidden");
};

window.hideLoader = () => {
    document.getElementById("global-loader")?.classList.add("hidden");
};

window.addEventListener("pageshow", () => {
    window.hideLoader();
});

/* =========================
   TOAST
========================= */
window.showToast = (message, type = "info") => {
    const container = document.getElementById("toast-container");
    if (!container) return;

    const toast = document.createElement("div");
    toast.className = `toast toast-${type}`;

    const text = document.createElement("span");
    text.className = "toast-message";
    text.textContent = message;

    const button = document.createElement("button");
    button.type = "button";
    button.setAttribute("aria-label", "Dismiss notification");
    button.textContent = "×";
    button.addEventListener("click", () => removeToast(toast));

    toast.append(text, button);
    container.appendChild(toast);

    setTimeout(() => removeToast(toast), 4000);
};

const removeToast = (toast) => {
    if (!toast) return;

    toast.style.opacity = "0";
    toast.style.transform = "translateY(-10px)";

    setTimeout(() => toast.remove(), 300);
};

/* =========================
   THEME TOGGLE
========================= */
window.toggleTheme = () => {
    const html = document.documentElement;
    html.classList.toggle("dark");

    localStorage.setItem(
        "theme",
        html.classList.contains("dark") ? "dark" : "light",
    );
};

/* =========================
   GLOBAL LINK LOADER
========================= */
document.addEventListener("click", (event) => {
    const link = event.target.closest("a");

    if (!link) return;
    if (!link.href) return;
    if (link.target === "_blank") return;
    if (link.hasAttribute("download")) return;
    if (link.getAttribute("href")?.startsWith("#")) return;

    window.showLoader();
});
