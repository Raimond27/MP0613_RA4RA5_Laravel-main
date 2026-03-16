<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuento de Actores</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .container {
            flex: 1;
            background: #fff;
            padding: 2rem;
            max-width: 600px;
            margin: 2rem auto;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 0.5rem;
        }

        .count-badge {
            font-size: 3rem;
            font-weight: bold;
            color: #3498db;
            margin: 1.5rem 0;
        }

        .btn-back {
            display: inline-block;
            margin-top: 2rem;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
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
