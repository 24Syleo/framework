export const modal = (btn, modal, span) => {
    btn.addEventListener('click', () => {
        modal.style.display = "block";
    });
    span.addEventListener('click', () => {
        modal.style.display = "none";
    });
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
}