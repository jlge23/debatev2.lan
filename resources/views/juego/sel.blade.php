@vite(['resources/js/relog.js'])
<form id="FRM_seleccion" class="form-horizontal" action="{{route('juego.update')}}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="tiempo" id="tiempo" value="{{$pregunta[0]->dificultad->tiempo}}">
    <input type="hidden" name="equipo" id="equipo" value="{{$equipo->id}}">
    <input type="hidden" name="duracion" id="duracion" value="">
{{--     <input type="hidden" name="pregunta_id" id="pregunta_id" value="{{$pregunta[0]->id}}"> --}}
    @foreach ($pregunta[0]->respuestas as $respuesta)
        @if($respuesta->validez == 1)
            <input type="hidden" name="respuesta_id" id="respuesta_id" value="{{$respuesta->id}}">
        @endif
    @endforeach
    <input type="hidden" name="validez" id="validez" value="0">
    <input type="hidden" name="seleccion" id="seleccion" value="0">
    <input type="hidden" name="puntos" id="puntos" value="{{$pregunta[0]->dificultad->puntaje}}">
    <input type="hidden" name="tipo" id="tipo" value="{{$pregunta[0]->tipo_id}}">

    <h3 class="text text-uppercase">Pregunta N°: [<b>{{$pregunta[0]->numero}}</b>] - <b>{{$pregunta[0]->pregunta}}</b></h3>
    <div class="row">
        <div class="col-md-4">
            @include('juego.relog')
        </div>
        <div class="col-md-4">
            <br>
            <center>
                <button type="button" id="start2" class="btn btn-primary">Iniciar cuenta regresiva</button>&nbsp;&nbsp;
                <button type="button" id="stop2" class="btn btn-warning" disabled>Detener cuenta regresiva</button>
            </center>
        </div>
        <div class="col-md-4">
            <div id="OPT" style="display: none">
                <br>
                <select class="form-control" name="opcion" id="opcion">
                    <option value="" selected>SELECCIONE</option>
                    {{$i=1;}}
                    @foreach ($pregunta[0]->respuestas as $respuesta)
                        <option value="{{$respuesta->id}}">Opción {{$i++}}:&nbsp;{{strtoupper($respuesta->respuesta)}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <hr>
    <div id="resp" style="display: none">
        <hr>
        @foreach ($pregunta[0]->respuestas as $respuesta)
            @if($respuesta->validez == 1)
                <h2 class="alert alert-dark text text-uppercase">Respuesta correcta:&nbsp;<b>{{$respuesta->respuesta}}</b></h2>
            @endif
        @endforeach
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h1 id="mensaje" class=""></h1>
            </div>
        </div>
        <center><button type="submit" class="btn btn-success">Guardar y continuar</button></center>
    </div>
</form>
