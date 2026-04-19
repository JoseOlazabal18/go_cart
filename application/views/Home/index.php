<aside class="mobile-sidebar" id="sidebar">
    <div class="sidebar-header">
        <span class="sidebar-title">Menú</span>
        <button class="close-menu" id="close-menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="sidebar-list">
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Productos</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Contacto</a></li>
            
            <hr class="sidebar-hr">

            <li class="sidebar-dropdown">
                <button class="dropdown-btn" id="sidebar-cat-toggle">
                    Categorías <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul class="dropdown-content" id="sidebar-cat-list">
                    <li><a href="#">Computadoras</a></li>
                    <li><a href="#">Laptops</a></li>
                    <li><a href="#">Impresoras</a></li>
                    <li><a href="#">Monitores</a></li>
                    <li><a href="#">Móviles</a></li>
                    <li><a href="#">Periféricos</a></li>
                </ul>
            </li>

            <hr class="sidebar-hr">
            <li><a href="#"><i class="fa-regular fa-user"></i> Mi Cuenta</a></li>
        </ul>
    </nav>
</aside>
<section class="hero-soft">

  <div class="container hero-grid">

    <!-- TEXTO -->
    <div class="hero-content">

      <span class="badge">Lo nuevo en tecnología</span>

      <h1>
        Tu Tecnología <br>
        al Mejor Precio
      </h1>

      <p>
        Descubre las últimas innovaciones en electrónicos, gaming y tecnología con garantía.
      </p>

      <div class="actions">
        <a href="<?php echo BASE_URL; ?>products" class="btn-primary">
          <i class="fas fa-shopping-cart"></i>
          Ver Catálogo
        </a>
      </div>
    </div>

    <!-- IMAGEN -->
    <div class="hero-visual">
    <div class="image-card carousel-wrapper">

        <div class="carousel">

          <input type="radio" name="slider" id="item-1" checked>
          <input type="radio" name="slider" id="item-2">
          <input type="radio" name="slider" id="item-3">

          <div class="cards">
            <label class="card" for="item-1" id="song-1">
              <img src="public/img/airphone_main.jpg" alt="Hero Image 1">
            </label>

            <label class="card" for="item-2" id="song-2">
              <img src="public/img/teclados_main.jpg" alt="Hero Image 1">
            </label>

            <label class="card" for="item-3" id="song-3">
              <img src="public/img/monitor_main.jpg" alt="Hero Image 1">
            </label>
          </div>
        </div>

    </div>
</div>

  </div>

</section>


<!--000-->
<section class="products-carousel-section">
    <div class="container">
        <h2 class="section-title">Novedades Destacadas</h2>
        
        <div class="carousel-container" id="carousel-container">
            <div class="carousel-track" id="carousel-track">
                <!-- 🔥 Aquí JS insertará los 4 productos -->
            </div>
        </div>
    </div>
</section>

<section class="why-choose-us">
    <div class="container">
        <div class="section-header">
            <div class="header-text">
                <h2 class="section-title">¿Por qué elegir JB S.A.C.?</h2>
                <p class="section-subtitle">Calidad garantizada, precios competitivos y atención personalizada</p>
            </div>
            <div class="logo-wrapper hide-mobile">
                <img src="public/img/logo.jpg" alt="Logo" class="logo-img-small">
                <span class="logo-text-small">JB S.A.C.</span>
                
            </div>
        </div>

        <div class="features-grid">
            <div class="feature-item">
                <i class="fa-solid fa-truck feature-icon"></i>
                <a href="#" class="feature-link">Envío seguro</a>
            </div>
            <div class="feature-item">
                <i class="fa-solid fa-shield-halved feature-icon"></i>
                <a href="#" class="feature-link">Garantía oficial</a>
            </div>
            <div class="feature-item">
                <i class="fa-solid fa-headset feature-icon"></i>
                <a href="#" class="feature-link">Soporte técnico</a>
            </div>
        </div>
    </div>
</section>



