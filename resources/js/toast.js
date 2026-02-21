class Toast {

    static container = null;

    static init() {
        if (!this.container) {
            this.container = document.createElement('div');
            this.container.className =
                "fixed top-20 left-1/2 -translate-x-1/2 z-[9999] w-96 space-y-3";
            document.body.appendChild(this.container);
        }
    }

    static show(message, type = 'success', duration = 3000) {
        this.init();

        const colors = {
            success: "bg-green-400/80",
            error: "bg-red-400/80",
            warning: "bg-yellow-400/80",
            info: "bg-blue-400/80"
        };

        const toast = document.createElement('div');
        toast.className =
            `relative text-white px-4 py-3 rounded-lg shadow-lg 
             transform transition-all duration-300 opacity-0 translate-y-2 ${colors[type]}`;

        toast.innerHTML = `
            <div class="flex justify-between items-start gap-3">
                <span class="text-sm font-medium">${message}</span>
                <button class="text-white text-lg leading-none">&times;</button>
            </div>
        `;

        // Close button
        toast.querySelector('button').addEventListener('click', () => {
            this.hide(toast);
        });

        this.container.appendChild(toast);

        // Animate in
        requestAnimationFrame(() => {
            toast.classList.remove('opacity-0', 'translate-y-2');
            toast.classList.add('opacity-100', 'translate-y-0');
        });

        // Auto hide
        setTimeout(() => {
            this.hide(toast);
        }, duration);
    }

    static hide(toast) {
        toast.classList.remove('opacity-100', 'translate-y-0');
        toast.classList.add('opacity-0', 'translate-y-2');

        setTimeout(() => {
            toast.remove();
        }, 300);
    }
}

export default Toast;