class Modal {
    static activeModal = null;

    static open(id) {
        const modal = document.getElementById(id);
        const overlay = document.getElementById(`${id}-overlay`);

        if (!modal || !overlay) return;

        this.activeModal = { modal, overlay };

        overlay.classList.remove("hidden");
        modal.classList.remove("hidden");

        document.body.classList.add("overflow-hidden");

        requestAnimationFrame(() => {
            modal.classList.remove("opacity-0", "scale-95");
            modal.classList.add("opacity-100", "scale-100");
        });
    }

    static close() {
        if (!this.activeModal) return;

        const { modal, overlay } = this.activeModal;

        modal.classList.remove("opacity-100", "scale-100");
        modal.classList.add("opacity-0", "scale-95");

        setTimeout(() => {
            modal.classList.add("hidden");
            overlay.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        }, 300);

        this.activeModal = null;
    }

    static init() {
        // Open buttons
        document.querySelectorAll("[data-modal-open]").forEach(button => {
            button.addEventListener("click", () => {
                this.open(button.dataset.modalOpen);
            });
        });

        // Close buttons
        document.querySelectorAll("[data-modal-close]").forEach(button => {
            button.addEventListener("click", () => {
                this.close();
            });
        });

        // Overlay click
        document.querySelectorAll("[data-modal-overlay]").forEach(overlay => {
            overlay.addEventListener("click", () => {
                this.close();
            });
        });

        // ESC key
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                this.close();
            }
        });
    }
}

export default Modal;