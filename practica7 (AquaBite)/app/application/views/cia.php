<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('static/css/inecesario.css'); ?>">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?php echo base_url('static/images/logo2.png'); ?>" alt="AquaBite" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url('inicio'); ?>"><i class="fas fa-home me-2"></i>Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i>Cuenta
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo site_url('login'); ?>"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                        <li><a class="dropdown-item" href="<?php echo site_url('registro'); ?>"><i class="fas fa-user-plus me-2"></i>Registro</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('acerca'); ?>"><i class="fas fa-info-circle me-2"></i>Acerca de</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('cia'); ?>"><i class="fas fa-building me-2"></i>CIA</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Bienvenido a la CIA</h1>
            <p class="lead">Descubre todo sobre nuestra compañía: nuestros servicios, equipo, y mucho más.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Nuestros Servicios</h5>
                    <p class="card-text">Ofrecemos una amplia gama de servicios diseñados para cubrir todas tus necesidades.</p>
                    <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Nuestro Equipo</h5>
                    <p class="card-text">Conoce a las mentes brillantes detrás de nuestra organización y descubre qué nos hace únicos.</p>
                    <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Contacto</h5>
                    <p class="card-text">Estamos aquí para ayudarte. Ponte en contacto con nosotros y resolveremos tus dudas.</p>
                    <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
