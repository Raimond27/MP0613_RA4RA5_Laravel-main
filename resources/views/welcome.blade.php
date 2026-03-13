<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
    <style>
        /* Estilos base */
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

        /* Cabecera */
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

        /* Contenedor principal */
        .container {
            flex: 1;
            background: #fff;
            padding: 2rem;
            max-width: 900px;
            margin: 2rem auto;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Pie de página */
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

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 0.8rem 0;
        }

        a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        a:hover {
            color: #2980b9;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        form {
            display: grid;
            gap: 1rem;
            max-width: 500px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 0.3rem;
        }

        input {
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        button {
            padding: 0.8rem 1.5rem;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        button:hover {
            background: #2980b9;
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
    </style>
</head>

<body>
    <header>
        <h1>🎬 Movie Hub - Mi Lista de Películas</h1>
    </header>

    <div class="container">
        @if(!isset($films) && !isset($total))
        <div>
            <h2>Lista de Películas</h2>
            <ul>
                <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
                <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
                <li><a href="/filmout/films">Pelis</a></li>
                <li><a href="/filmout/films">Pelis ordenadas por año descendente</a></li>
                <li><a href="{{ route('countFilms') }}">Ver total de películas</a></li>
            </ul>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <strong>Éxito:</strong> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
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
                
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <div style="color: red; font-size: 0.8rem;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="year">Año:</label>
                    <input type="number" id="year" name="year" value="{{ old('year') }}" min="1900" max="{{ date('Y') + 5 }}" required>
                    @error('year') <div style="color: red; font-size: 0.8rem;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="genre">Categoría:</label>
                    <input type="text" id="genre" name="genre" value="{{ old('genre') }}" required>
                    @error('genre') <div style="color: red; font-size: 0.8rem;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="country">País:</label>
                    <input type="text" id="country" name="country" value="{{ old('country') }}" required>
                    @error('country') <div style="color: red; font-size: 0.8rem;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="duration">Duración (min):</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration') }}" min="1" required>
                    @error('duration') <div style="color: red; font-size: 0.8rem;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="img_url">Imagen URL:</label>
                    <input type="url" id="img_url" name="img_url" value="{{ old('img_url') }}" required>
                    @error('img_url') <div style="color: red; font-size: 0.8rem;">{{ $message }}</div> @enderror
                </div>

                <button type="submit">Enviar</button>
            </form>
        </div>
        <div>
            <h2>Buscar Actores por Década</h2>
            <form id="decadeForm" onsubmit="event.preventDefault(); window.location.href='/actorout/listActorsByDecade/' + document.getElementById('decade').value;">
                <div class="form-group">
                    <label for="decade">Seleccionar Década:</label>
                    <select id="decade" name="decade" style="padding: 0.6rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; width: 100%;">
                        <option value="1980">1980 - 1989</option>
                        <option value="1990">1990 - 1999</option>
                        <option value="2000">2000 - 2009</option>
                        <option value="2010">2010 - 2019</option>
                        <option value="2020">2020 - 2029</option>
                    </select>
                </div>
                <button type="submit">Buscar Actores</button>
            </form>
        </div>
        @endif

        @if(isset($films))
            <h2>{{$title}}</h2>

            @if(empty($films))
                <div class="alert alert-error">No se ha encontrado ninguna película</div>
            @else
                <h3>Total de películas: {{ count($films) }}</h3>

                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Año</th>
                            <th>Género</th>
                            <th>País</th>
                            <th>Duración</th>
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($films as $film)
                            <tr>
                                <td>{{$film['name']}}</td>
                                <td>{{$film['year']}}</td>
                                <td>{{$film['genre']}}</td>
                                <td>{{$film['country']}}</td>
                                <td>{{$film['duration']}} min</td>
                                <td><img src="{{$film['img_url']}}" alt="{{$film['name']}}" style="width: 80px; height: auto;" /></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif

        @if(isset($total))
            <div>
                <h2>Recuento Total de Películas</h2>
                <p>Actualmente hay un total de <strong>{{ $total }}</strong> películas registradas en el sistema.</p>
            </div>
        @endif

        @if(isset($films) || isset($total))
            <div style="margin-top: 2rem;">
                <a href="/" class="btn-back">← Volver al Inicio</a>
            </div>
        @endif
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Movie Hub - Todos los derechos reservados</p>
    </footer>
</body>

</html>
