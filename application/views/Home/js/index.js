document.addEventListener('DOMContentLoaded', () => {
    // ELEMENTOS DEL SIDEBAR (Móvil)
    const btnOpen = document.getElementById('open-menu');
    const btnClose = document.getElementById('close-menu');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    // ELEMENTOS DE CATEGORÍAS (Desktop)
    const desktopToggle = document.getElementById('desktop-toggle');
    const desktopList = document.getElementById('desktop-list');

    // Lógica para el Sidebar Móvil (Aparece por la derecha)
    const toggleMenu = () => {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
        // Bloquea el scroll del body al abrir el menú
        document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : 'auto';
    };

    // Lógica para el Despliegue Horizontal (Desktop)
    const toggleDesktopCategories = () => {
        desktopList.classList.toggle('active');
        // Opcional: Cambia el icono o color del botón al estar activo
        desktopToggle.classList.toggle('is-active');
    };

    // Listeners para Móvil
    if (btnOpen) btnOpen.addEventListener('click', toggleMenu);
    if (btnClose) btnClose.addEventListener('click', toggleMenu);
    if (overlay) overlay.addEventListener('click', toggleMenu);

    // Listener para Desktop
    if (desktopToggle) desktopToggle.addEventListener('click', toggleDesktopCategories);
});