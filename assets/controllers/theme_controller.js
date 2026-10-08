import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    toggle() {
        const isDark = document.documentElement.classList.toggle("dark");

        try {
            localStorage.setItem("theme", isDark ? "dark" : "light");
        } catch (e) {}
    }
}
