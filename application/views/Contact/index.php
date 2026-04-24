<!-- SECCION DE CONTACTO -->
<section class="contact-section">
    <div class="container">
        <div class="section-header">
            <div class="header-text">
                <h2 class="section-title">Estamos listos para ayudarte con soluciones tecnologicas</h2>
            </div>
            <div class="logo-wrapper hide-mobile">
            </div>
        </div>

        <div class="contact-grid">
            <div class="contact-card">
                <div class="contact-card-header">
                    <i class="fa-solid fa-address-card"></i>
                    <h3>Informacion</h3>
                </div>
                
                <div class="contact-list">
                    <div class="contact-item">
                        <i class="fa-solid fa-building"></i>
                        <div class="contact-info">
                            <span class="contact-label">RUC</span>
                            <span class="contact-value">10410697551</span>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <div class="contact-info">
                            <span class="contact-label">Direccion</span>
                            <span class="contact-value">Calle Lopez de Zuñiga N° 547, Piso 2<br>Chancay, Huaral - Lima</span>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fa-solid fa-phone"></i>
                        <div class="contact-info">
                            <span class="contact-label">Telefono</span>
                            <span class="contact-value">
                                <a href="tel:+51996720630">(51) 996 720 630</a>
                            </span>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fa-solid fa-envelope"></i>
                        <div class="contact-info">
                            <span class="contact-label">Email</span>
                            <span class="contact-value">
                                <a href="mailto:ventas@solucionesintegralesjb.com">ventas@solucionesintegralesjb.com</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-card-header">
                    <i class="fa-regular fa-clock"></i>
                    <h3>Horario</h3>
                </div>
                
                <div class="schedule-list">
                    <div class="schedule-item">
                        <span class="schedule-day">Lunes a Viernes</span>
                        <span class="schedule-time">9:00 am - 6:00 pm</span>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-day">Sabados</span>
                        <span class="schedule-time">9:00 am - 1:00 pm</span>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-day">Domingos</span>
                        <span class="schedule-time">Cerrado</span>
                    </div>
                </div>

                <div class="support-info">
                    <i class="fa-solid fa-headset"></i>
                    <div>
                        <span class="support-label">Soporte Tecnico</span>
                        <span class="support-value">Disponible 24/7</span>
                    </div>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-card-header">
                    <i class="fa-solid fa-map-pin"></i>
                    <h3>Ubicacion</h3>
                </div>
                
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps?q=Calle+L%C3%B3pez+de+Z%C3%BA%C3%B1iga+547+Chancay&output=embed"
                        width="100%" 
                        height="250" 
                        style="border:0; border-radius: 16px;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                    <div class="map-footer">
                        <a href="https://www.google.com/maps/dir/?api=1&destination=Calle+L%C3%B3pez+de+Z%C3%BA%C3%B1iga+547+Chancay" target="_blank" class="map-link">
                            <i class="fa-solid fa-directions"></i> Como llegar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .contact-section {
        background:
            radial-gradient(circle at top left, rgba(37, 99, 235, 0.14), transparent 24%),
            radial-gradient(circle at bottom right, rgba(15, 23, 42, 0.12), transparent 28%),
            linear-gradient(180deg, #f4f8fc 0%, #eaf1f8 100%);
        padding: 5rem 0 0;
        position: relative;
        overflow: hidden;
    }

    .contact-section::before,
    .contact-section::after {
        content: '';
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
    }

    .contact-section::before {
        width: 340px;
        height: 340px;
        top: -120px;
        right: -120px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.18) 0%, rgba(59, 130, 246, 0) 70%);
    }

    .contact-section::after {
        width: 280px;
        height: 280px;
        bottom: 40px;
        left: -100px;
        background: radial-gradient(circle, rgba(14, 116, 144, 0.12) 0%, rgba(14, 116, 144, 0) 72%);
    }

    .contact-section .container {
        max-width: 1600px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 1;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .header-text {
        flex: 1;
    }

    .section-title {
        font-size: 2.9rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }

    .section-subtitle {
        color: #666;
        font-size: 1.1rem;
    }

    .logo-wrapper {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .logo-img-small {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        object-fit: cover;
    }

    .logo-text-small {
        font-weight: 600;
        color: #1a1a2e;
        font-size: 1rem;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 2.25rem;
    }

    .contact-card {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.7);
        border-radius: 24px;
        padding: 2.4rem;
        box-shadow: 0 16px 35px rgba(15, 23, 42, 0.08);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 38px rgba(15, 23, 42, 0.12);
    }

    .contact-card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(37, 99, 235, 0.08);
    }

    .contact-card-header i {
        font-size: 2.1rem;
        color: #1a1a2e;
    }

    .contact-card-header h3 {
        font-size: 1.75rem;
        color: #1a1a2e;
        margin: 0;
    }

    .contact-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .contact-item > i {
        width: 52px;
        height: 52px;
        background: #f0f2f5;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1a1a2e;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .contact-info {
        flex: 1;
    }

    .contact-label {
        font-size: 0.95rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #999;
        letter-spacing: 0.8px;
        display: block;
        margin-bottom: 0.25rem;
    }

    .contact-value {
        font-weight: 600;
        color: #333;
        font-size: 1.25rem;
        line-height: 1.4;
    }

    .contact-value a {
        color: #333;
        text-decoration: none;
        font-size: 1.25rem;
    }

    .contact-value a:hover {
        color: #2563eb;
        text-decoration: underline;
    }

    .schedule-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .schedule-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .schedule-day {
        font-weight: 600;
        color: #444;
        font-size: 1.2rem;
    }

    .schedule-time {
        color: #666;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .support-info {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        margin-top: 1.8rem;
        padding: 1.2rem;
        background: rgba(240, 242, 245, 0.9);
        border-radius: 16px;
    }

    .support-info i {
        font-size: 1.85rem;
        color: #1a1a2e;
    }

    .support-label {
        font-size: 0.95rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #999;
        letter-spacing: 0.8px;
        display: block;
        margin-bottom: 0.25rem;
    }

    .support-value {
        font-weight: 700;
        color: #1a1a2e;
        font-size: 1.25rem;
    }

    .map-container {
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
    }

    .map-container iframe {
        width: 100%;
        height: 300px;
        border-radius: 20px;
    }

    .map-footer {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .map-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        color: #2563eb;
        text-decoration: none;
        font-size: 1.05rem;
        font-weight: 500;
        padding: 0.6rem 1.2rem;
        background: rgba(240, 242, 245, 0.9);
        border-radius: 12px;
        transition: all 0.2s;
    }

    .map-link i {
        font-size: 1rem;
    }

    .map-link:hover {
        background: #e0e4e9;
        text-decoration: none;
        transform: translateY(-2px);
        color: #1d4ed8;
    }

    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .contact-section {
            padding: 3rem 0 0;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .hide-mobile {
            display: none;
        }
        
        .section-header {
            text-align: center;
            justify-content: center;
        }
        
        .contact-card {
            padding: 1.5rem;
        }
        
        .contact-card-header h3 {
            font-size: 1.3rem;
        }
        
        .contact-value {
            font-size: 1rem;
        }
        
        .contact-value a {
            font-size: 1rem;
        }
        
        .map-container iframe {
            height: 220px;
        }
        
        .map-footer {
            flex-direction: column;
            align-items: stretch;
        }
        
        .map-link {
            justify-content: center;
        }
        
        .schedule-day,
        .schedule-time {
            font-size: 0.95rem;
        }
        
        .support-value {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .section-title {
            font-size: 1.5rem;
        }
        
        .contact-card-header i {
            font-size: 1.5rem;
        }
        
        .contact-card-header h3 {
            font-size: 1.2rem;
        }
        
        .contact-item > i {
            width: 38px;
            height: 38px;
            font-size: 1rem;
        }
        
        .contact-value {
            font-size: 0.95rem;
        }
    }
</style>
