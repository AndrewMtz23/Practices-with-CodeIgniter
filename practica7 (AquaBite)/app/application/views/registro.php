<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('static/css/acceso.css'); ?>">

</head>
<body class="bg-light">
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

<div class="container login-container">
    <div class="login-form">
        <img src="<?php echo base_url('static/images/logo.jpeg'); ?>" class="login-logo img-fluid" alt="Nuestra misión">
        <h2 class="text-center mb-4">Crea una Cuenta</h2>
        <form id="registerForm">
            <div class="mb-3">
                <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-continuar">Registrar</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <small>¿Ya tienes cuenta? <a href="<?php echo site_url('login'); ?>" class="text-decoration-none">Inicia sesión</a></small>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    var jsonData = {};
    formData.forEach((value, key) => jsonData[key] = value);

    fetch('http://localhost/awi4_t218/aquabite/webservice/application/controllers/register', { // Cambia esta línea
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            window.location.href = "<?php echo site_url('login'); ?>";
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al conectar con el servidor.');
    });
});
</script>
</body>
</html>
