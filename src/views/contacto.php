<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/styleInicio1css">
    <link rel="stylesheet" href="../src/css/stylecontacto1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Contacto</title>
    <style>
        :root {
            --color-primary: <?= $colors['color_primary'] ?>;
            --color-background: <?= $colors['color_background'] ?>;
        }
    </style>
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
        <div class="contact-container">
        <div class="contact-info">
            <h2>Contáctanos</h2>
            <p>¿Tienes alguna pregunta o sugerencia? Estamos aquí para ayudarte. Completa el formulario y te responderemos a la brevedad.</p>
            
            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <h3>Dirección</h3>
                    <p>luego lo pongo</p>
                </div>
            </div>
            
            <div class="info-item">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <h3>Teléfono</h3>
                    <p>+58 412 5120548</p>
                </div>
            </div>
            
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <h3>Email</h3>
                    <p>ucla@gmail.com</p>
                </div>
            </div>
            
            <div class="info-item">
                <i class="fas fa-clock"></i>
                <div>
                    <h3>Horario</h3>
                    <p>Lunes a Viernes: 7:00 - 12:00</p>
                </div>
            </div>
            
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
        
        <div class="contact-form">
            <h2>Envíanos un mensaje</h2>
            <form>
                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" class="form-control" placeholder="Ingresa tu nombre" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" class="form-control" placeholder="Ingresa tu correo" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="tel" id="phone" class="form-control" placeholder="Ingresa tu teléfono">
                </div>
                
                <div class="form-group">
                    <label for="subject">Asunto</label>
                    <input type="text" id="subject" class="form-control" placeholder="¿Cuál es el asunto?" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" class="form-control" placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>
                
                <button type="submit" class="btn">Enviar mensaje <i class="fas fa-paper-plane"></i></button>
            </form>
            <div class="form-decoration"></div>
        </div>
    </div>
        
    </main>
    
    <footer>
        &copy; 2025 Universidad Centroccidental Lisandro Alvarado. Todos los derechos reservados.
    </footer>
</body>
</html>