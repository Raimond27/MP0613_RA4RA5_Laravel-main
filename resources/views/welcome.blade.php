<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
</head>

<body>
    <div>
        <h1>Lista de Películas</h1>
        <ul>
            <li>
                <a href="/filmout/oldFilms">Pelis antiguas</a>
            </li>
            <li>
                <a href="/filmout/newFilms">Pelis nuevas</a>
            </li>
            <li>
                <a href="/filmout/films">Pelis</a>
            </li>
            <li>
                <a href="/filmout/films/1994">Pelis ordenadas por año descendente</a>
            </li>
            <li>
                <a href="/filmout/films/null/Action">Pelis de Acción</a>
            </li>
        </ul>
    </div>

    @if(session('success'))
        <div>
            <strong>Éxito:</strong> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div>
            <strong>Error:</strong> {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div>
            <strong>Error en el formulario:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <h2>Añadir Película</h2>
        <form action="{{ route('createFilm') }}" method="POST">
            @csrf
            
            <div>
                <label for="name">Nombre:</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="year">Año:</label>
                <input type="number" 
                       id="year" 
                       name="year" 
                       value="{{ old('year') }}" 
                       min="1900" 
                       max="{{ date('Y') + 5 }}"
                       required>
                @error('year')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="genre">Categoría:</label>
                <input type="text" 
                       id="genre" 
                       name="genre" 
                       value="{{ old('genre') }}" 
                       required>
                @error('genre')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="country">País:</label>
                <input type="text" 
                       id="country" 
                       name="country" 
                       value="{{ old('country') }}" 
                       required>
                @error('country')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="duration">Duración (min):</label>
                <input type="number" 
                       id="duration" 
                       name="duration" 
                       value="{{ old('duration') }}" 
                       min="1"
                       required>
                @error('duration')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="img_url">Imagen URL:</label>
                <input type="url" 
                       id="img_url" 
                       name="img_url" 
                       value="{{ old('img_url') }}" 
                       required>
                @error('img_url')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Enviar</button>
        </form>
    </div>

</body>

</html>
