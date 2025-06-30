<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/styleInicio.css">
    <link rel="stylesheet" href="../src/css/styleinteres.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Inicio</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../src/img/logoucla.png" alt="Logo">
            <h1>JUBILACIÓN UCLA</h1>
        </div>

        <?php
            session_start();

            if (isset($_SESSION['ci'])) {
                
                if(isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'empleado') {
                        include 'navs/navInicioEmpleado.php';

                    } elseif ($_SESSION['rol'] == 'administrador') {
                        include 'navs/navInicioAdmin.php';
                    }
                }
            } else {
                // Si no hay usuario autenticado, mostrar el enlace de login
                include 'navs/navInicio.php';
                
            }
        ?>
    </header>
    
    <main>
        <div class="container__background-circule">
            <div class="circule"></div>
        </div>

            <div class="services-container">
        <div class="services-header">
            <h1>¿Qué hacemos por ti?</h1>
            <h2>Agilizamos tu solicitud de jubilación, ¡en un par de clics!</h2>
        </div>
        
        <div class="services-content">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <h3>Simplificamos tu trámite</h3>
                <p>Olvídate del papeleo, las esperas y los trámites engorrosos. Con nuestra plataforma, el proceso de enviar tu solicitud de jubilación es rápido e intuitivo.</p>
                
                <div class="highlight">
                    En solo unos pocos clics, tu carta estará en camino, dándote la tranquilidad de saber que tu futuro está en marcha, sin complicaciones ni demoras.
                </div>
                
                <p>Tu tiempo es valioso, y queremos que lo dediques a lo que realmente importa: disfrutar de la vida y prepararte para esta nueva etapa.</p>
                
                <ul class="benefits-list">
                    <li><i class="fas fa-check-circle"></i> Proceso 100% digital sin papeleos</li>
                    <li><i class="fas fa-check-circle"></i> Ahorra horas de espera y trámites</li>
                    <li><i class="fas fa-check-circle"></i> Seguimiento en tiempo real de tu solicitud</li>
                    <li><i class="fas fa-check-circle"></i> Asesoramiento personalizado en cada paso</li>
                </ul>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Te preparamos para disfrutar cada día</h3>
                <p>Pero nuestra ayuda no termina con la solicitud. Entendemos que la jubilación es más que un trámite; es el inicio de una nueva aventura.</p>
                
                <div class="highlight">
                    Hemos creado un catálogo exclusivo de cursos y recursos diseñados para acompañarte en esta transición.
                </div>
                
                <p>Aprenderás a gestionar tus finanzas post-jubilación, explorar nuevas pasiones, mantenerte activo y conectado, y mucho más.</p>
                
                <p>Te brindamos las herramientas y el conocimiento para que tomes las riendas de tu futuro y vivas esta etapa con confianza, propósito y plenitud.</p>
                
                <ul class="benefits-list">
                    <li><i class="fas fa-check-circle"></i> Cursos de finanzas para jubilados</li>
                    <li><i class="fas fa-check-circle"></i> Talleres de desarrollo personal</li>
                    <li><i class="fas fa-check-circle"></i> Comunidad de personas en tu misma situación</li>
                    <li><i class="fas fa-check-circle"></i> Recursos para una vida saludable y activa</li>
                    <li><i class="fas fa-check-circle"></i> Asesoramiento para emprendimientos post-jubilación</li>
                </ul>
            </div>
        </div>
        
        <div class="cta-section">
            <a href="?controlador=autenticacion&metodo=login"> <button class="cta-button">Comienza tu jubilación ahora <i class="fas fa-arrow-right"></i></button></a>
        </div>
        
        <div class="testimonial">
            <!--<p>"Gracias a esta plataforma, pude completar mi trámite de jubilación en menos de 15 minutos. Ahora estoy disfrutando de sus cursos para prepararme para esta nueva etapa. ¡Una experiencia transformadora!"</p>
            <div class="testimonial-author">- Marta Rodríguez, recién jubilada</div> -->
        </div>
    </div>
        
    </main>
    
    <footer>
        &copy; 2025 Universidad Centroccidental Lisandro Alvarado. Todos los derechos reservados.
    </footer>
</body>
</html>