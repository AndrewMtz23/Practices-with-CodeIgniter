
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f0f0;
        }
        h1 {
            text-align: center;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #fff;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .ver-todas {
            text-align: center;
            margin-top: 20px;
        }
        .icono {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .icono.bi::before {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <h1><?php echo $titulo; ?></h1>

    <div class="grid">
        <?php foreach ($opciones as $index => $opcion): ?>
            <?php if ($index < 3): ?>
                <div class="card" style="background-color: <?php echo $opcion[2]; ?>; color: #fff;">
                    <i class="icono bi <?php echo $opcion[3]; ?>"></i>
                    <h2><?php echo $opcion[0]; ?></h2>
                    <p><?php echo $opcion[1]; ?></p>
                    <a href="#" class="btn">Ir a <?php echo $opcion[0]; ?></a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div class="grid" style="grid-template-columns: repeat(2, 1fr); margin-top: 20px;">
        <?php foreach ($opciones as $index => $opcion): ?>
            <?php if ($index >= 3): ?>
                <div class="card" style="background-color: <?php echo $opcion[2]; ?>; color: #fff;">
                    <i class="icono bi <?php echo $opcion[3]; ?>"></i>
                    <h2><?php echo $opcion[0]; ?></h2>
                    <p><?php echo $opcion[1]; ?></p>
                    <a href="#" class="btn">Ir a <?php echo $opcion[0]; ?></a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</body>
</html>
