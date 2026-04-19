<header class="main-header">
    <nav class="navbar">
        <div class="container navbar-grid">
            <a href="<?php echo BASE_URL; ?>" class="logo">
                <img src="public/img/logo.jpg" alt="Logo" class="logo-img">
                <span class="logo-text">Soluciones Integrales JB</span>
            </a>

            <ul class="nav-main hide-mobile">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Productos</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>

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
                <li><a href="#">Móviles</a></li>
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