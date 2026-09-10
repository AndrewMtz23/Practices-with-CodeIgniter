<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca De</title>
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
            <a class="nav-item nav-link" href="#"><i class="fas fa-building me-2"></i>CIA</a>
        </div>
    </div>
</nav>

<div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('inicio'); ?>"><i class="fas fa-home me-2"></i>Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i>Cuenta
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo site_url('login'); ?>">Login</a></li>
                        <li><a class="dropdown-item" href="<?php echo site_url('registro'); ?>">Registro</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url('acerca'); ?>">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link" href="<?php echo site_url('cia'); ?>"><i class="fas fa-building me-2"></i>CIA</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1 class="text-center mb-4">Acerca de AquaBite</h1>

            <div class="card">
                <div class="card-body">
                    <h2>¿Quiénes Somos?</h2>
                    <p>
                        AquaBite es una empresa dedicada a revolucionar la industria acuícola mediante soluciones innovadoras de IoT (Internet de las Cosas).
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2>Nuestro Compromiso</h2>
                    <p>
                        Nos dedicamos a proporcionar herramientas avanzadas para el monitoreo y automatización de criaderos, asegurando condiciones óptimas para la salud y crecimiento de los peces.
                    </p>
                    <p>
                        Nuestro equipo está comprometido con la calidad, la eficiencia y la sostenibilidad en todas nuestras soluciones.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2>Misión</h2>
                    <p>
                        Facilitar la gestión inteligente de los recursos acuícolas a través de tecnología de vanguardia, mejorando la productividad y minimizando el impacto ambiental.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2>Visión</h2>
                    <p>
                        Ser líderes en soluciones IoT para la industria acuícola, contribuyendo al desarrollo sostenible y a la seguridad alimentaria global.
                    </p>
                </div>
            </div>

            <div class="text-center">
                <a href="<?php echo site_url('inicio'); ?>" class="btn btn-primary btn-lg text-uppercase fw-bold btn-compra">Regresar</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
