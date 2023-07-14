@extends('layouts.app')
@section('title','Agregar nueva Iglesia')
@vite(['resources/sass/app.scss','resources/css/app.css','resources/js/app.js'])
@section('content')
    @isset($evento)
        @if(count($evento) == 0)
            <div class="container">
                <h1 class="alert alert-warning text text-dark">No hay eventos activos. Dirijase al menu <a href="evento">Eventos</a></h1>
            </div>
        @else
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="alert alert-primary">Resultados del juego. <small class="text text dark"></small></h1>
                        <table class="table table-bordered table-striped table-hover table-responsive" id="DT_informe" width="100%">
                            <thead>
                                <tr>
                                    <th>Turno</th>
                                    <th>Equipo</th>
                                    <th>Pregunta N°</th>
                                    <th>Dificultad</th>
                                    <th>Tipo de pregunta</th>
                                    <th>Pregunta</th>
                                    <th>Respuesta correcta</th>
                                    <th>Respuesta del equipo</th>
                                    <th>¿Acierto?</th>
                                    <th>Puntos</th>
                                    <th>Tiempo de respuesta</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Turno</th>
                                    <th>Equipo</th>
                                    <th>Pregunta N°</th>
                                    <th>Dificultad</th>
                                    <th>Tipo de pregunta</th>
                                    <th>Pregunta</th>
                                    <th>Respuesta correcta</th>
                                    <th>Respuesta del equipo</th>
                                    <th>¿Acierto?</th>
                                    <th>Puntos</th>
                                    <th>Tiempo de respuesta</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <figure class="highcharts-figure">
                            <div id="container1"></div>
                            <p class="highcharts-description">
                                Puntaje alcanzado por equipo.
                            </p>
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <figure class="highcharts-figure">
                            <div id="container0"></div>
                            <p class="highcharts-description">
                                Progreso general del Juego, Aciertos y desaciertos por equipo.
                            </p>
                        </figure>

                    </div>
                </div>
                <hr>
                <div class="row">
                    {{-- <div class="col-md-6">
                        <figure class="highcharts-figure">
                            <div id="container4"></div>
                            <p class="highcharts-description">
                                Porcentaje de avance del Juego, las preguntas activas al 100% representan el juego en su inicio.
                            </p>
                        </figure>
                    </div> --}}
                    <div class="col-md-12">
                        <figure class="highcharts-figure">
                            <div id="container2"></div>
                            <p class="highcharts-description">
                                Porcentaje en puntaje alcanzado por equipos
                            </p>
                        </figure>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <figure class="highcharts-figure">
                            <div id="container3"></div>
                            <p class="highcharts-description">
                                Este grafico muestra el tiempo consumido por equipo al responder sus respectivas preguntas en su turno.
                            </p>
                        </figure>
                    </div>
                </div>
            </div>
            @vite(['resources/js/informes.js'])
            @vite(['resources/js/graficos.js'])
        @endif
    @endisset
@endsection
