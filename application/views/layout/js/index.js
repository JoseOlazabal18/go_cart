document.addEventListener('DOMContentLoaded', () => {
    // ... Tus variables anteriores (btnOpen, sidebar, etc) ...
    const btnOpen = document.getElementById('open-menu');
    const btnClose = document.getElementById('close-menu');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    // NUEVO: Variables para el acordeón de categorías en móvil
    const catToggle = document.getElementById('sidebar-cat-toggle');
    const catList = document.getElementById('sidebar-cat-list');

    // Lógica para abrir/cerrar sidebar
    const toggleMenu = () => {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
        document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : 'auto';
    };

    // NUEVO: Lógica del acordeón
    if (catToggle) {
        catToggle.addEventListener('click', () => {
            catToggle.classList.toggle('active'); // Para rotar el icono
            catList.classList.toggle('active');   // Para expandir la lista
        });
    }

    if (btnOpen) btnOpen.addEventListener('click', toggleMenu);
    if (btnClose) btnClose.addEventListener('click', toggleMenu);
    if (overlay) overlay.addEventListener('click', toggleMenu);

    // Lógica Desktop (Categorías horizontales)
    const desktopToggle = document.getElementById('desktop-toggle');
    const desktopList = document.getElementById('desktop-list');
    if (desktopToggle) {
        desktopToggle.addEventListener('click', () => {
            desktopList.classList.toggle('active');
        });
    }
});