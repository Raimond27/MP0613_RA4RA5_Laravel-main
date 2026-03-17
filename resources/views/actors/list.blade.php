<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
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
                        <th>Acciones</th>
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
                            <td>
                                <form action="{{ route('deleteActor', $actor->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este actor?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #e74c3c; padding: 0.5rem 1rem; font-size: 0.9rem;">Borrar</button>
                                </form>
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
