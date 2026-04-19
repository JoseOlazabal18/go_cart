document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. SLIDER HERO (RADIOS) ---
    const radios = document.querySelectorAll('.carousel input');
    if (radios.length > 0) {
        let current = 0;
        setInterval(() => {
            radios[current].checked = false;
            current = (current + 1) % radios.length;
            radios[current].checked = true;
        }, 3500);
    }

    // --- 2. CARRUSEL DE PRODUCTOS ---
    const track = document.getElementById('carousel-track');
    const container = document.getElementById('carousel-container');
    
    if (track && container) {
        let scrollAmount = 0;
        let step = 0.8; // Velocidad suave
        let isPaused = false;

        const animate = () => {
            if (!isPaused) {
                scrollAmount -= step;
                const maxScroll = track.scrollWidth - container.offsetWidth;
                
                if (Math.abs(scrollAmount) >= maxScroll) {
                    scrollAmount = 0; 
                }
                track.style.transform = `translateX(${scrollAmount}px)`;
            }
            requestAnimationFrame(animate);
        };

        container.addEventListener('mouseenter', () => isPaused = true);
        container.addEventListener('mouseleave', () => isPaused = false);
        
        animate();
    }

    // --- 3. SIDEBAR MÓVIL (ACORDEÓN) ---
    const catToggle = document.getElementById('sidebar-cat-toggle');
    const catList = document.getElementById('sidebar-cat-list');
    if (catToggle) {
        catToggle.addEventListener('click', () => {
            catList.classList.toggle('active');
            catToggle.classList.toggle('active');
        });
    }
});