<style>
  /* Footer */
footer {
    background-color: #f1f5f9;
    color: #334155; /* var(--text-color) */
    padding: 30px 0;
    border-top: 1px solid #e2e8f0; /* var(--border-color) */
    margin-top: auto;
}

footer .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

footer p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b; /* var(--text-light) */
}

.social-icons {
    display: flex;
    gap: 10px;
}

.social-box {
    width: 38px;
    height: 38px;
    background: #ffffff; /* var(--card-color) */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-size: 16px;
    color: #64748b; /* var(--text-light) */
    transition: all 0.3s ease;
    text-decoration: none;
    border: 1px solid #e2e8f0; /* var(--border-color) */
}

.social-box:hover {
    background: #2563eb; /* var(--primary-color) */
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Responsive for footer */
@media (max-width: 576px) {
    footer .container {
        flex-direction: column;
        text-align: center;
    }
}
</style>

  <footer>
    <div class="container">
        <p>&copy; 2025 JB S.A.C. - Todos los derechos reservados</p>
        <div class="social-icons">
            <a href="https://www.facebook.com/solucionesintegralesJB" target="_blank" class="social-box"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.tiktok.com/@solucionesintegralesjb" target="_blank" class="social-box"><i class="fab fa-tiktok"></i></a>
            <a href="https://www.linkedin.com/company/soluciones-integrales-jb/?originalSubdomain=pe" target="_blank" class="social-box"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://www.instagram.com/solucionesintegralesjb/" target="_blank" class="social-box"><i class="fab fa-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCwZllsxQMp2LwUSIDmldUeQ" target="_blank" class="social-box"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</footer>

<!-- 
==================================================
            SCRIPTS GLOBALES
==================================================
-->

<!-- 1. jQuery y Bootstrap (Movidos desde header.php) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    // Estas variables ahora son globales y se definen en cada página
    // Vienen del script 'process_notifications.php' que se incluyó en el header
    const globalJustCanceled = <?php echo json_encode($justCanceledOrders ?? []); ?>;
    const globalExpiringSoon = <?php echo json_encode($expiringSoonOrders ?? []); ?>;
</script>

<script src="../assets/js/global_notifications.js"></script>
