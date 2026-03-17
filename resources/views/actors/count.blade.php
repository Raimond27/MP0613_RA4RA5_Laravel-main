<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuento de Actores</title>
    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Hoja de estilos central -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>🎬 Movie Hub - Actores</h1>
    </header>

    <div class="container">
        <h2>Recuento Total de Actores</h2>
        <p>Actualmente hay un total de:</p>
        <div class="count-badge">{{ $count }}</div>
        <p>actores registrados en el sistema.</p>

        <a href="/" class="btn-back">← Volver al Inicio</a>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Movie Hub - Todos los derechos reservados</p>
    </footer>
</body>
</html>
