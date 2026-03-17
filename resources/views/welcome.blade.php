<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Hoja de estilos central -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <li><a href="{{ route('listActors') }}">Listar Actores</a></li>
                <li><a href="{{ route('countActors') }}">Ver total de actores</a></li>
                <li><a href="{{ route('countFilms') }}">Ver total de películas</a></li>
            </ul>
        </div>

        <div>
            <h2>Listar Actores por Década</h2>
            <form action="#" method="GET" onsubmit="event.preventDefault(); window.location.href='/actorout/listActorsByDecade/' + document.getElementById('decade').value;">
                <div class="form-group">
                    <label for="decade">Selecciona una década:</label>
                    <select id="decade" name="decade" style="padding: 0.6rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
                        <option value="1980">1980 - 1989</option>
                        <option value="1990">1990 - 1999</option>
                        <option value="2000">2000 - 2009</option>
                        <option value="2010">2010 - 2019</option>
                        <option value="2020">2020 - 2029</option>
                    </select>
                </div>
                <button type="submit">Filtrar</button>
            </form>
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
                            <th>Acciones</th>
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
                                <td>
                                    <form action="{{ route('deleteFilm', $film['id']) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta película?');">
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
