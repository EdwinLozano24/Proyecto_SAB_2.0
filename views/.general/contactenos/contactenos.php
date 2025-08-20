<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Contactanos!</title>
    <link rel="stylesheet" href="/assets/css/layoutFinal/paciente/layout.css">
    <link rel="stylesheet" href="/assets/css/contactenos/contactenos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside.php');
    ?>

    <main class="main-content">
        <div class="redes-container">
            <section class="redes-section">
                <h2 class="section-title">Contáctanos</h2>
                <p class="section-subtitle">Síguenos en nuestras redes sociales para estar al día con promociones, consejos y más</p>
                
                <div class="redes-grid">
                    <div class="redes-card email">
                        <div class="card-icon">
                            <i class="fa-solid fa-envelope-circle-check"></i>
                        </div>
                        <div class="card-content">
                            <h3>Gmail</h3>
                            <p class="card-desc">¡Envíanos un mensaje ya!</p>
                            <div class="card-footer">
                                <span class="card-username">SaludBenefitt@gmail.com</span>
                                <a href="mailto:SaludBenefitt@gmail.com" target="_blank" class="btn btn-seguir">
                                    Ir <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="redes-card whatsapp">
                        <div class="card-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="card-content">
                            <h3>WhatsApp</h3>
                            <p class="card-desc">Resolveremos tus dudas e inquitudes rapidamente.</p>
                            <div class="card-footer">
                                <span class="card-username">¡Envianos un mensaje!</span>
                                <a href="https://wa.me/573170560930" target="_blank" class="btn btn-seguir">
                                    Ir <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta Instagram -->
                    <div class="redes-card instagram">
                        <div class="card-icon">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <div class="card-content">
                            <h3>Instagram</h3>
                            <p class="card-desc">Consejos diarios, antes/después y promociones exclusivas.</p>
                            <div class="card-footer">
                                <span class="card-username">@SaludBenefitt</span>
                                <a href="https://www.instagram.com/saludbenefitt/" target="_blank" class="btn btn-seguir">
                                    Ir <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tarjeta TikTok -->
                    <div class="redes-card tiktok">
                        <div class="card-icon">
                            <i class="fab fa-tiktok"></i>
                        </div>
                        <div class="card-content">
                            <h3>TikTok</h3>
                            <p class="card-desc">Videos educativos y divertidos sobre salud dental.</p>
                            <div class="card-footer">
                                <span class="card-username">@salud_benefit</span>
                                <a href="https://www.tiktok.com/@salud_benefit" target="_blank" class="btn btn-seguir">
                                    Ir <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tarjeta Facebook -->
                    <div class="redes-card facebook">
                        <div class="card-icon">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <div class="card-content">
                            <h3>Facebook</h3>
                            <p class="card-desc">Eventos, noticias y comunidad de pacientes.</p>
                            <div class="card-footer">
                                <span class="card-username">Salud Benefit</span>
                                <a href="https://www.facebook.com/profile.php?id=61576580559377" target="_blank" class="btn btn-seguir">
                                    Ir <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta YouTube -->
                    <div class="redes-card youtube">
                        <div class="card-icon">
                            <i class="fab fa-youtube"></i>
                        </div>
                        <div class="card-content">
                            <h3>YouTube</h3>
                            <p class="card-desc">Tutoriales completos y testimonios de pacientes.</p>
                            <div class="card-footer">
                                <span class="card-username">@SaludBenefit</span>
                                <a href="https://www.youtube.com/channel/UC5QRoI2-Nrcfpdoj1XeEI0g" target="_blank" class="btn btn-seguir">
                                    Ir <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php'); ?>
</body>

</html>