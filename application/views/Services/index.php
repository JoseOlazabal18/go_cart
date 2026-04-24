<section class="services-section">
    <div class="container">
        <div class="services-hero" style="text-align: center;">
            <h1 style="font-size: 2.8rem; color: #2563eb;">Nuestros Servicios</h1>
            <p style="text-align: center; line-height: 1.6;">
                Brindamos soluciones integrales y estrategicas disenadas para fortalecer tu negocio,<br>
                optimizar tus procesos y acompanarte en el logro de tus objetivos.
            </p>
        </div>

        <div style="max-width: 900px; margin: 32px auto 0; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); overflow: hidden;">
            <div style="display: flex; align-items: center; min-height: 320px;">
                <div style="width: 50%; min-height: 320px; background: #f3f4f6; display: flex; align-items: stretch; justify-content: stretch; padding: 0;">
                    <img src="<?php echo BASE_URL; ?>public/img/desarr.soft.jpg" alt="Desarrollo de software" style="width: 100%; height: 320px; object-fit: cover; display: block;">
                </div>
                <div style="width: 50%; padding: 32px; text-align: left;">
                    <h2 style="font-size: 2.2rem; color: #2563eb; margin-bottom: 12px;">Desarrollo de Software</h2>
                    <p style="font-size: 1.8rem; font-weight: 700; margin-bottom: 12px;">Soluciones Tecnologicas Personalizadas</p>
                    <p style="font-size: 1.6rem; line-height: 1.6; margin: 0;">
                        Desarrollamos aplicaciones web y moviles a medida que se adaptan perfectamente a las necesidades de tu empresa.
                    </p>
                </div>
            </div>
        </div>

        <div style="max-width: 900px; margin: 32px auto 0; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); overflow: hidden;">
            <div style="display: flex; align-items: center; min-height: 320px;">
                <div style="width: 50%; min-height: 320px; background: #f3f4f6; display: flex; align-items: stretch; justify-content: stretch; padding: 0;">
                    <img src="<?php echo BASE_URL; ?>public/img/marketing-digital.jpg" alt="Marketing digital" style="width: 100%; height: 320px; object-fit: cover; display: block;">
                </div>
                <div style="width: 50%; padding: 32px; text-align: left;">
                    <h2 style="font-size: 2.2rem; color: #2563eb; margin-bottom: 12px;">Marketing Digital</h2>
                    <p style="font-size: 1.8rem; font-weight: 700; margin-bottom: 12px;">Estrategias de Growth Marketing</p>
                    <p style="font-size: 1.6rem; line-height: 1.6; margin: 0;">
                        Potenciamos tu presencia digital con campanas efectivas en redes sociales, SEO y publicidad online.
                    </p>
                </div>
            </div>
        </div>

        <div style="max-width: 900px; margin: 32px auto 0; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); overflow: hidden;">
            <div style="display: flex; align-items: center; min-height: 320px;">
                <div style="width: 50%; min-height: 320px; background: #f3f4f6; display: flex; align-items: stretch; justify-content: stretch; padding: 0;">
                    <img src="<?php echo BASE_URL; ?>public/img/sup.tecnico.jpg" alt="Soporte tecnico" style="width: 100%; height: 320px; object-fit: cover; display: block;">
                </div>
                <div style="width: 50%; padding: 32px; text-align: left;">
                    <h2 style="font-size: 2.2rem; color: #2563eb; margin-bottom: 12px;">Soporte Tecnico</h2>
                    <p style="font-size: 1.8rem; font-weight: 700; margin-bottom: 12px;">Asistencia Especializada 24/7</p>
                    <p style="font-size: 1.6rem; line-height: 1.6; margin: 0;">
                        Brindamos mantenimiento preventivo y correctivo para garantizar el funcionamiento optimo de tus sistemas.
                    </p>
                </div>
            </div>
        </div>

        <div style="max-width: 900px; margin: 32px auto 0; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); overflow: hidden;">
            <div style="display: flex; align-items: center; min-height: 320px;">
                <div style="width: 50%; min-height: 320px; background: #f3f4f6; display: flex; align-items: stretch; justify-content: stretch; padding: 0;">
                    <img src="<?php echo BASE_URL; ?>public/img/consul.empresarial.jpg" alt="Consultoria empresarial" style="width: 100%; height: 320px; object-fit: cover; display: block;">
                </div>
                <div style="width: 50%; padding: 32px; text-align: left;">
                    <h2 style="font-size: 2.2rem; color: #2563eb; margin-bottom: 12px;">Consultoria Empresarial</h2>
                    <p style="font-size: 1.8rem; font-weight: 700; margin-bottom: 12px;">Optimizacion de Procesos</p>
                    <p style="font-size: 1.6rem; line-height: 1.6; margin: 0;">
                        Analizamos y mejoramos tus flujos de trabajo para aumentar la productividad y reducir costos operativos.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .services-section {
        background:
            radial-gradient(circle at top left, rgba(37, 99, 235, 0.14), transparent 24%),
            radial-gradient(circle at bottom right, rgba(15, 23, 42, 0.12), transparent 28%),
            linear-gradient(180deg, #f4f8fc 0%, #eaf1f8 100%);
        padding: 5rem 0 3rem;
        position: relative;
        overflow: hidden;
    }

    .services-section::before,
    .services-section::after {
        content: '';
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
    }

    .services-section::before {
        width: 340px;
        height: 340px;
        top: -120px;
        right: -120px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.18) 0%, rgba(59, 130, 246, 0) 70%);
    }

    .services-section::after {
        width: 280px;
        height: 280px;
        bottom: 40px;
        left: -100px;
        background: radial-gradient(circle, rgba(14, 116, 144, 0.12) 0%, rgba(14, 116, 144, 0) 72%);
    }

    .services-section .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
        position: relative;
        z-index: 1;
    }
</style>
