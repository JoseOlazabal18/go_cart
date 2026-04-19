document.addEventListener('DOMContentLoaded', () => {

  // 🎯 Carrusel superior
  const radios = document.querySelectorAll('.carousel input');
  let current = 0;

  setInterval(() => {
    radios[current].checked = false;
    current = (current + 1) % radios.length;
    radios[current].checked = true;
  }, 3500);

  // 🔥 CARGAR PRODUCTOS
  function get_products() {
    $.ajax({
      url: BASE_URL + "products/get_products",
      type: "GET",
      dataType: "json",
      success: function (data) {

        let html = "";

        if (data.status === "OK") {

          data.data.forEach((item) => {
            html += `
              <div class="product-card">
                
                <div class="product-image">
                  <img src="public/img/products/default.jpg" alt="${item.name}">
                  
                  <div class="product-overlay">
                    <button class="btn-action cart" title="Añadir al carrito">
                      <i class="fa-solid fa-cart-plus"></i>
                    </button>
                    <button class="btn-action details" title="Ver detalles">
                      <i class="fa-solid fa-eye"></i>
                    </button>
                  </div>

                </div>

                <div class="product-info">
                  <span class="product-cat">Tecnología</span>
                  <h3 class="product-name">${item.name}</h3>
                  <p class="product-price">S/ ${parseFloat(item.price).toFixed(2)}</p>
                </div>

              </div>
            `;
          });

        } else {
          html = "<p>No hay productos disponibles</p>";
        }

        document.getElementById("carousel-track").innerHTML = html;
      }
    });
  }

  // 🚀 ejecutar
  get_products();

});