<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('static/css/inicio.css'); ?>">
   
</head>
<body class="fade-in">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?php echo base_url('static/images/logo2.png'); ?>" alt="AquaBite" class="img-fluid">
        </a>
        <div class="navbar-nav ms-auto">
            <a class="nav-item nav-link active" href="<?php echo site_url('inicio'); ?>"><i class="fas fa-home me-2"></i>Inicio</a>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i>Cuenta
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo site_url('login'); ?>"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                    <li><a class="dropdown-item" href="<?php echo site_url('registro'); ?>"><i class="fas fa-user-plus me-2"></i>Registro</a></li>
                </ul>
            </div>
            <a class="nav-item nav-link" href="<?php echo site_url('acerca'); ?>"><i class="fas fa-info-circle me-2"></i>Acerca de</a>
            <a class="nav-item nav-link" href="<?php echo site_url('cia'); ?>"><i class="fas fa-building me-2"></i>CIA</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo base_url('static/images/imagen1.jpg'); ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('static/images/imagen2.jpg'); ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('static/images/imagen3.jpg'); ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('static/images/imagen4.jpeg'); ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('static/images/imagen3.jpg'); ?>" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="carousel-thumbnails d-flex justify-content-center mt-2">
                <img src="<?php echo base_url('static/images/imagen1.jpg'); ?>" class="mx-1 active" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0">
                <img src="<?php echo base_url('static/images/imagen2.jpg'); ?>" class="mx-1" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1">
                <img src="<?php echo base_url('static/images/imagen3.jpg'); ?>" class="mx-1" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2">
                <img src="<?php echo base_url('static/images/imagen4.jpeg'); ?>" class="mx-1" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3">
                <img src="<?php echo base_url('static/images/imagen3.jpg'); ?>" class="mx-1" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4">
            </div>
        </div>
        <div class="col-md-6">
            <h1 class="fw-bold">AUTOMATIZA TU CRIADERO DE TILAPIAS</h1>
            <p class="lead">Transforma tu negocio acuícola con nuestra avanzada solución IoT</p>
            <p>Nuestro <strong>dispositivo de monitoreo y automatización IoT</strong> es la herramienta perfecta para optimizar la gestión de tus criaderos de tilapias. Con tecnología de vanguardia, permite un control preciso de los parámetros vitales como <strong>temperatura</strong> del agua, nivel de <strong>turbidez</strong> y cantidad de <strong>alimento</strong>, asegurando un entorno ideal para el crecimiento y la salud de tus tilapias.</p>
            <button class="btn btn-primary btn-lg text-uppercase fw-bold btn-compra-inicio" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-shopping-cart me-2"></i>COMPRAR</button>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="<?php echo base_url('static/images/registration.png'); ?>" alt="Crea tu cuenta" class="img-fluid">
        </div>
        
        <div class="col-md-6">
            <h3 class="mb-4">CREA TU CUENTA</h3>
            <p class="mb-4">Crea tu cuenta para poder realizar pedidos de productos hasta la puerta de tu casa, es muy fácil y rápido.</p>
            <a href="<?php echo site_url('login'); ?>" class="btn btn-primary btn-lg text-uppercase fw-bold btn-compra-inicio">
                <i class="fas fa-user-plus me-2"></i>Inicia Sesion
            </a>
        </div>
    </div>
</div>

<div class="bg-light-alt-inicio py-5">
    <div class="container">
        <h2 class="text-center mb-5 text-uppercase fw-bold">Nuestros servicios</h2>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-water fa-3x feature-icon-inicio mb-3"></i>
                <h3 class="h4 mb-3">Monitoreo de Agua</h3>
                <p>Control preciso de la temperatura, nivel de turbidez y calidad del agua para asegurar un ambiente óptimo.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-fish fa-3x feature-icon-inicio mb-3"></i>
                <h3 class="h4 mb-3">Alimentación Automática</h3>
                <p>Sistemas automatizados para la distribución de alimento, mejorando la eficiencia y reduciendo desperdicios.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-chart-line fa-3x feature-icon-inicio mb-3"></i>
                <h3 class="h4 mb-3">Análisis de Datos</h3>
                <p>Recopilación y análisis de datos para optimizar el rendimiento y tomar decisiones informadas.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade custom-modal-inicio" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #4a7b8a; color: white;">
                <h5 class="modal-title"><i class="fas fa-exclamation-circle me-2"></i> Iniciar Sesión Requerido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">Para realizar una compra, necesitas iniciar sesión.</p>
            </div>
            <div class="modal-footer justify-content-center" style="background-color: #f1f1f1;">
                <button type="button" class="btn btn-danger btn-cerrar-inicio" data-bs-dismiss="modal">Cerrar</button>
                <a href="<?php echo site_url('login'); ?>" class="btn btn-primary btn-iniciar-inicio"><i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión</a>
            </div>
        </div>
    </div>
</div>

<footer class="footer-inicio mt-auto py-3">
    <div class="container text-center">
        <div class="col footer-text-inicio">
            &copy; 2024, AquaBite.com, Todos los Derechos Reservados.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('static/js/inicio.js'); ?>"></script>
</body>
</html>
