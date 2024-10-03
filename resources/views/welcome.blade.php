<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VDV Cooperativa | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fuente personalizada -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        /* Estilos para el fondo del carrusel */
        body{
            background: black;
        }

        .trabajos{
            color: white;
        }

        .carousel {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .carousel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .carousel img.active {
            opacity: 1;
        }

        /* Ajuste del contenido y la altura de la página */
        body, html {
            height: 100%;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        /* Fondo translúcido para las secciones */
        .content, .navbar {
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Centrando el contenido */
        .hero-section {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
            background: linear-gradient(to left, #6a11cb, black);
            padding: 150px 0;
        }

        /* Navbar flotante */
        .navbar {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2;
            opacity: 2;
        }
        h2{
            color: grey;
        }
        span{
            color: white;
        }

       
    </style>
</head>
<body>
    

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h1 class="h3 text-white fw-bold">VDV Cooperativa</h1>
            </a>
            <div class="d-flex">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary">Volver al inicio</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Sección principal -->
    <main>
        <section class="hero-section text-center">
            <div class="container">
                <h1 class="display-4 fw-bold mb-3">Bienvenidos </h1>
                <p class="lead mb-4">VDV Cooperativa es una organización dedicada a proporcionar soluciones innovadoras y sostenibles para la comunidad. Con un enfoque en la colaboración y el desarrollo, trabajamos para mejorar la calidad de vida de nuestros miembros y el entorno en el que vivimos.</p>
                
            </div>
        </section>

        <!-- Secciones adicionales del segundo código como "Trabajos" y "Sobre Nosotros" -->
        <section id="trabajos" class="py-5">
            <div class="container">
                <h2 class="text-center fw-bold mb-5 trabajos">Algunos trabajos realizados</h2>
                <div class="row g-4">
                    <!-- Bloque de proyectos -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card project-card">
                            <img src=" {{ asset('img/image1.jpg') }}"class="card-img-top" alt="Proyecto 1">
                            <div class="card-body">
                                <h5 class="card-title">Muestra 1</h5>
                                <p class="card-text">Descripción breve del proyecto realizado.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card project-card">
                            <img src="{{ asset('img/image2.jpg') }}" class="card-img-top" alt="Proyecto 1">
                            <div class="card-body">
                                <h5 class="card-title">Muestra 2</h5>
                                <p class="card-text">Descripción breve del proyecto realizado.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card project-card">
                            <img src="{{ asset('img/image3.jpg') }}" class="card-img-top" alt="Proyecto 1">
                            <div class="card-body">
                                <h5 class="card-title">Muestra 3</h5>
                                <p class="card-text">Descripción breve del proyecto realizado.</p>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </section>

        <!-- Sección de contacto -->
        <section id="contacto" class="contact-section py-5">
            <div class="container">
                <h2 class="text-center mb-5 fw-bold">Contáctanos</h2>
                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="mb-3">
                            <i class="bi bi-envelope me-2"></i>
                            <span>info@vdvcooperativa.com</span>
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-telephone me-2"></i>
                            <span>+1 234 567 890</span>
                        </div>
                        <div>
                            <i class="bi bi-geo-alt me-2"></i>
                            <span>Garibaldi N° 127, Santiago del Estero</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="Mensaje"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Enviar Mensaje</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <i class="bi bi-building me-2"></i>
                    <span class="fw-bold">Cooperativa de Trabajo LTDA.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">&copy; 2024 VDV Cooperativa. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Script para cambiar las imágenes del carrusel -->
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

