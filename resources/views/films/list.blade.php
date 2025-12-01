<h1>{{$title}}</h1>

@if(empty($films))
    <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
@else
    <!-- Contador de pelis -->
    <h3>Total de películas: {{ count($films) }}</h3>

    <div align="center">
    <table border="1">
        <tr>
            <!-- Encabezados de la tabla -->
            @foreach($films as $film)
                @foreach(array_keys($film) as $key)
                    <th>{{$key}}</th>
                @endforeach
                @break
            @endforeach
        </tr>

        <!-- Filas de la tabla -->
        @foreach($films as $film)
            <tr>
                <td>{{$film['name']}}</td>
                <td>{{$film['year']}}</td>
                <td>{{$film['genre']}}</td>
                <td>{{$film['country']}}</td>
                <td>{{$film['duration']}}</td>
                <td><img src={{$film['img_url']}} style="width: 100px; height: 120px;" /></td>
            </tr>
        @endforeach
    </table>
    </div>
@endif