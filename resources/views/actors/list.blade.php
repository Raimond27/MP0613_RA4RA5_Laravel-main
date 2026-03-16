<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        /* Reusing common styles from welcome.blade.php for consistency */
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .container {
            flex: 1;
            background: #fff;
            padding: 2rem;
            max-width: 1000px;
            margin: 2rem auto;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        th, td {
            text-align: left;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            color: #2c3e50;
        }

        tr:hover {
            background: #f1f1f1;
        }

        img {
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <header>
        <h1>🎬 Movie Hub - Actores</h1>
    </header>

    <div class="container">
        <h2>{{ $title }}</h2>

        @if($actors->isEmpty())
            <div class="alert">No se han encontrado actores en la base de datos.</div>
        @else
            <h3>Total de actores: {{ $actors->count() }}</h3>

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>País</th>
                        <th>Alias</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actors as $actor)
                        <tr>
                            <td>{{ $actor->name }}</td>
                            <td>{{ $actor->surname }}</td>
                            <td>{{ $actor->birthdate }}</td>
                            <td>{{ $actor->country }}</td>
                            <td>{{ $actor->alias }}</td>
                            <td>
                                @if($actor->img_url)
                                    <img src="{{ $actor->img_url }}" alt="{{ $actor->name }}" style="width: 80px; height: auto;" />
                                @else
                                    No disponible
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="/" class="btn-back">← Volver al Inicio</a>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Movie Hub - Todos los derechos reservados</p>
    </footer>
</body>
</html>
