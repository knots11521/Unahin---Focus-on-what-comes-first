import "./bootstrap";
import { createIcons, icons } from "lucide";

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

const initializeSidebars = () => {
    const leftSidebar = document.getElementById("left-sidebar");
    const rightSidebar = document.getElementById("right-sidebar");
    const leftExpand = document.getElementById("btn-left-expand");
    const rightExpand = document.getElementById("btn-right-expand");

    if (leftSidebar && localStorage.getItem("sidebar_left_collapsed") === "true") {
        leftSidebar.classList.add("sidebar-collapsed");
        leftExpand?.classList.remove("hidden");
    }

    if (rightSidebar && localStorage.getItem("sidebar_right_collapsed") === "true") {
        rightSidebar.classList.add("sidebar-collapsed");
        rightExpand?.classList.remove("hidden");
    }
};

applyTheme();

document.addEventListener("DOMContentLoaded", () => {
    createIcons({ icons });
    initializeSidebars();

    setTimeout(() => {
        document.querySelectorAll(".animate-fade-in").forEach((element) => {
            element.style.opacity = "0";
            setTimeout(() => element.remove(), 300);
        });
    }, 5000);
});

window.showLoader = () => {
    document.getElementById("global-loader")?.classList.remove("hidden");
};

window.hideLoader = () => {
    document.getElementById("global-loader")?.classList.add("hidden");
};

window.toggleTheme = () => {
    const html = document.documentElement;
    html.classList.toggle("dark");
    localStorage.setItem(
        "theme",
        html.classList.contains("dark") ? "dark" : "light",
    );
};

window.toggleSidebar = (side) => {
    const sidebar = document.getElementById(`${side}-sidebar`);
    const expandButton = document.getElementById(`btn-${side}-expand`);

    if (!sidebar) {
        return;
    }

    sidebar.classList.toggle("sidebar-collapsed");
    const isCollapsed = sidebar.classList.contains("sidebar-collapsed");

    expandButton?.classList.toggle("hidden", !isCollapsed);
    localStorage.setItem(`sidebar_${side}_collapsed`, String(isCollapsed));
};

window.showToast = (message, type = "info") => {
    const container = document.getElementById("toast-container");

    if (!container) {
        return;
    }

    const toast = document.createElement("div");
    toast.className = `toast ${type}`;
    toast.innerHTML = `
        <span>${message}</span>
        <button type="button" aria-label="Dismiss notification" onclick="this.parentElement.remove()">×</button>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = "0";
        toast.style.transform = "translateY(-10px)";
        setTimeout(() => toast.remove(), 300);
    }, 4000);
};

document.addEventListener("click", (event) => {
    const link = event.target.closest("a");

    if (link && link.href && !link.target && !link.hasAttribute("download")) {
        window.showLoader();
    }
});
