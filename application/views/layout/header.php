<header class="main-header">
    <div class="top-bar">
        <div class="container top-bar-content">
            <span><i class="fa-solid fa-truck-fast"></i> Envío gratis por compras mayores a S/ 299</span>
            <div class="top-links">
                <a href="#">Ayuda</a>
                <a href="#">Tiendas</a>
                <a href="#">Rastrear Pedido</a>
            </div>
        </div>
    </div>

    <nav class="navbar">
        <div class="container navbar-grid">
            <a href="<?php echo BASE_URL; ?>" class="logo">
                JB<span>TECH</span>
            </a>

            <div class="search-container">
                <input type="text" placeholder="¿Qué tecnología buscas hoy?">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <div class="user-actions">
                <a href="<?php echo BASE_URL; ?>Login" class="action-item">
                    <i class="fa-regular fa-user"></i>
                    <span>Mi Cuenta</span>
                </a>
                <a href="#" class="action-item cart-btn" id="main-cart">
                    <div class="cart-icon-wrapper">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-count">0</span>
                    </div>
                    <span>Carrito</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="categories-nav">
        <div class="container">
            <ul class="nav-list">
                <li><a href="#"><i class="fa-solid fa-bars"></i> Todas las Categorías</a></li>
                <li><a href="#">Laptops</a></li>
                <li><a href="#">Celulares</a></li>
                <li><a href="#">Gaming</a></li>
                <li><a href="#">Audio</a></li>
                <li><a href="#">Smart Home</a></li>
                <li class="deals"><a href="#">Ofertas Relámpago</a></li>
            </ul>
        </div>
    </div>
</header>
