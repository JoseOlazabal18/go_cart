// public/js/main.js
document.addEventListener('DOMContentLoaded', () => {
    const cartButtons = document.querySelectorAll('.btn-add-cart');

    cartButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            // Lógica simple: si tiene la clase disabled, no hace nada
            if (btn.classList.contains('disabled')) {
                alert("Por favor, selecciona una variante (color/tamaño) primero.");
                return;
            }
            
            // Simulación de agregar al carrito
            const count = document.querySelector('.cart-count');
            count.innerText = parseInt(count.innerText) + 1;
            btn.innerText = "¡Agregado!";
            btn.style.backgroundColor = "var(--success)";
        });
    });
});