<header class="main-header">
    <nav class="navbar">
        <div class="container navbar-grid">
            <a href="#" class="logo">
                <img src="public/img/logo.jpg" alt="Logo" class="logo-img">
            </a>

            <div class="search-container hide-mobile">
                <input type="text" placeholder="¿Qué tecnología buscas hoy?">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>  

            <div class="user-actions">
                <a href="#" class="action-item">
                    <i class="fa-regular fa-user"></i>
                    <span class="hide-mobile">Mi Cuenta</span>
                </a>
                <a href="#" class="action-item cart-btn">
                    <div class="cart-icon-wrapper">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-count">0</span>
                    </div>
                    <span class="hide-mobile">Carrito</span>
                </a>
                <button class="menu-toggle show-mobile" id="open-menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <div class="categories-nav hide-mobile">
        <div class="container flex-nav">
            <button class="all-cat-trigger" id="desktop-toggle">
                <i class="fa-solid fa-bars"></i> Todas las Categorías
            </button>
            
            <ul class="nav-list collapsible-list" id="desktop-list">
                <li><a href="#">Computadoras</a></li>
                <li><a href="#">Laptops</a></li>
                <li><a href="#">Impresoras</a></li>
                <li><a href="#">Monitores</a></li>
                <li><a href="#">Moviles</a></li>
                <li><a href="#">Perifericos</a></li>
                <li><a href="#">Redes</a></li>
            </ul>
        </div>
    </div>
</header>

<div class="sidebar-overlay" id="overlay"></div>
<aside class="mobile-sidebar" id="sidebar">
    <div class="sidebar-header">
        <span class="sidebar-title">Menú</span>
        <button class="close-menu" id="close-menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <nav class="sidebar-nav">
        <ul class="sidebar-list">
            <li><a href="#">Computadoras</a></li>
            <li><a href="#">Laptops</a></li>
            <li><a href="#">Impresoras</a></li>
            <li><a href="#">Monitores</a></li>
            <li><a href="#">Moviles</a></li>
            <li><a href="#">Perifericos</a></li>
            <li><a href="#">Redes</a></li>
            <hr class="sidebar-hr">
            <li><a href="#"><i class="fa-regular fa-user"></i> Mi Cuenta</a></li>
            <li><a href="#"><i class="fa-solid fa-gear"></i> Configuración</a></li>
        </ul>
    </nav>
</aside>