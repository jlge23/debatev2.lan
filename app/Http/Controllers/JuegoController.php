<?php

namespace App\Http\Controllers;

use App\Events\NewJuegoEvent;
use App\Http\Requests\StoreJuegoRequest;
use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Models\Juego;
use App\Models\Evento;
use App\Models\Pregunta;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use SebastianBergmann\LinesOfCode\NegativeValueException;

class JuegoController extends Controller
{
    protected function evento(){
        $evento = Evento::where('status','=',1)->get();//devuelve informacion del Evento activo
        return $evento;
    }

    public function index()
    {
        //return Juego::with('respuesta','respuesta.pregunta','evento','equipo')->get();
        if(count($this->evento()) > 0){
            $actual = DB::table('juegos')
                        ->join('equipos', function ($join) {
                            $join->on('equipos.id', '=', 'juegos.equipo_id');
                        })
                        ->select('equipos.nombre AS name',DB::raw('SUM(juegos.puntos) AS y'))
                        ->where('juegos.evento_id','=',$this->evento()[0]->id)
                        ->groupBy('equipos.nombre','equipos.id')
                        ->orderBy('equipos.id')
                        ->get();
            $juego = Juego::where('juegos.evento_id','=',$this->evento()[0]->id)->orderBy('id','desc')->first();//Devuelve el ultimo juego id con ordenamiento decreciente
            $equipos = Equipo::select(DB::raw('COUNT(id) as id'))->pluck('id')->first();//devuelve la cantidad de equipos registrados
            //esto no se usara puesto que los comodines estaran disponibles en la partida
            /* $progreso = Pregunta::select(\DB::raw('COUNT(preguntas.id) AS cuantos'))->where('status','=',0)->where('puntaje_id','!=',4)->get();
            if($progreso[0]->cuantos == 4){
                Puntaje::where('activo','=',0)->update(['activo'=>1]);
            } */
            $Preg = Pregunta::all();
            $evento = $this->evento();
            if(count($Preg) == 0){
                $preguntas = -1;
                return view('juego.index',compact('preguntas','evento'));
            }else{
                $preguntas = Pregunta::select('id')
                ->where('status','=',1)
                ->whereNotIn('preguntas.id',function($query){
                    $query->select('preguntas.id')->from('preguntas')
                    ->join('respuestas', function ($join) {
                        $join->on('respuestas.pregunta_id', '=', 'preguntas.id');
                    })
                    ->join('juegos', function ($join) {
                        $join->on('juegos.respuesta_id', '=', 'respuestas.id');
                    })
                    ->where('preguntas.status','=',1);
                })->orderBy('id','asc')->first();//devuelve el 'id' de la pregunta, siempre que tenga status=1, de forma ascendente
                if(!(gettype($preguntas) == 'NULL')){
                    $preguntas = 1;
                    switch(true){
                        case (gettype($juego) == 'NULL')://no hay datos en la tabla juego
                            $equipo = Equipo::find(1);
                            return view('juego.index',compact('equipo','evento','preguntas','actual'));
                        break;
                        case ($juego->equipo_id >= 1 and $juego->equipo_id < $equipos):
                            $equipo = Equipo::find(($juego->equipo_id + 1));
                            return view('juego.index',compact('equipo','evento','preguntas','actual'));
                        break;
                        case ($juego->equipo_id == $equipos):
                            $equipo = Equipo::find(1);
                            return view('juego.index',compact('equipo','evento','preguntas','actual'));
                        break;
                    }
                }else{
                    $preguntas = 0;
                    return view('juego.index',compact('preguntas','evento'));
                }
            }
        }else{
            $evento = null;
            return view('juego.index',compact('evento'));
        }
    }

    public function dificultad(){
        $data = array();
        $dificultades = DB::table('dificultades')
            ->join('preguntas', function ($join) {
                $join->on('dificultades.id', '=', 'preguntas.dificultade_id');
            })
            ->select('dificultades.id','dificultades.dificultad','dificultades.puntaje','dificultades.tiempo',DB::raw('COUNT(preguntas.id) AS cantidad'))
            ->where('preguntas.status','=',1)
            ->where('dificultades.status','=',1)
            ->whereNotIn('preguntas.id',function($query){
                $query->select('preguntas.id')->from('preguntas')
                ->join('respuestas', function ($join) {
                    $join->on('respuestas.pregunta_id', '=', 'preguntas.id');
                })
                ->join('juegos', function ($join) {
                    $join->on('juegos.respuesta_id', '=', 'respuestas.id');
                })
                ->where('preguntas.status','=',1);
            })
            ->groupBy('dificultades.id','dificultades.dificultad','dificultades.puntaje','dificultades.tiempo')
            ->orderBy('dificultades.id','ASC')
            ->get();
        if(count($dificultades) > 0){
            foreach($dificultades as $dificultad){
                $data['data'][] = array(
                    'id' => $dificultad->id,
                    'nombre' => $dificultad->dificultad,
                    'puntaje' => $dificultad->puntaje,
                    'tiempo' => $dificultad->tiempo,
                    'cantidad' => $dificultad->cantidad
                );
            }
            return $data;
        }else{
            return $data['data'][] = 'null';
        }
    }

    public function store(StoreJuegoRequest $request)
    {
        Pregunta::create($request->post());
        return redirect()->route('pregunta.index');
    }

    public function edit($e, $d)
    {
        $evento = $this->evento();//devuelve informacion del Evento activo
        $equipo = Equipo::find($e);
        //User::orderByRaw("RAND()")->get();

        $pregunta = Pregunta::with('dificultad','tipo','respuestas')
        ->where('dificultade_id',$d)
        ->where('status',1)
        ->whereNotIn('preguntas.id',function($query){
            $query->select('preguntas.id')->from('preguntas')
            ->join('respuestas', function ($join) {
                $join->on('respuestas.pregunta_id', '=', 'preguntas.id');
            })
            ->join('juegos', function ($join) {
                $join->on('juegos.respuesta_id', '=', 'respuestas.id');
            })
            ->where('preguntas.status','=',1);
        })->get()->random(1);
        return view('juego.edit', compact('pregunta','equipo','evento'));
    }

    public function update(Request $request)
    {
        //return $request->all();die();
        $evento = $this->evento();//devuelve informacion del Evento activo
        $existe = Juego::select(DB::raw('COUNT(*) AS cuantos'))->where('respuesta_id','=',$request->respuesta_id)->get();
        if($existe[0]->cuantos == 0){
            switch($request->tipo){
                case 1:
                    //return $request->all();die();
                    $juego = new Juego([
                        'fecha' => date('Y-m-d'),
                        'puntos' => ($request->validez == 1) ? $request->puntos : 0,
                        'tiempo' => $request->duracion,
                        'acierto' => ($request->validez == 1) ? 1 : 0,
                        'equipo_id' => $request->equipo,
                        'evento_id' => $evento[0]->id,
                        'respuesta_id' => $request->respuesta_id,
                        'seleccion' => $request->seleccion
                    ]);
                    $juego->save();
                    //Pregunta::where('id',$juego->respuesta->pregunta->id)->update(['status'=>0]);
                    event(new NewJuegoEvent('¡Nueva Jugada! '.$juego->equipo->nombre));
                    unset($juego);
                    return redirect(route('juego.index'));
                break;
                case 2:
                    //return $request->all();die();
                    $juego = new Juego([
                        'fecha' => date('Y-m-d'),
                        'puntos' => ($request->validez == 1 and $request->puntos > 0) ? $request->puntos : 0,
                        'tiempo' => $request->duracion,
                        'acierto' => ($request->validez == 1) ? 1 : 0,
                        'equipo_id' => $request->equipo,
                        'evento_id' => $evento[0]->id,
                        'respuesta_id' => $request->respuesta_id,
                        'seleccion' => $request->seleccion
                    ]);
                    $juego->save();
                    //Pregunta::where('id',$juego->respuesta->pregunta->id)->update(['status'=>0]);
                    event(new NewJuegoEvent('¡Nueva Jugada! '.$juego->equipo->nombre));
                    unset($juego);
                    return redirect(route('juego.index'));
                break;
                case 3:
                    //return $request->all();die();
                    if($request->opcion){
                        $puntos = ($request->validez == 1 and $request->opcion > 0) ? $request->opcion : 0;
                    }else{
                        $puntos = 0;
                    }
                    $juego = new Juego([
                        'fecha' => date('Y-m-d'),
                        'puntos' => $puntos,
                        'tiempo' => $request->duracion,
                        'acierto' => ($request->validez == 1) ? 1 : 0,
                        'equipo_id' => $request->equipo,
                        'evento_id' => $evento[0]->id,
                        'respuesta_id' => $request->respuesta_id,
                        'seleccion' => ($request->seleccion == 0)? "No fue válida" : $request->seleccion
                    ]);
                    $juego->save();
                    //Pregunta::where('id',$juego->respuesta->pregunta->id)->update(['status'=>0]);
                    event(new NewJuegoEvent('¡Nueva Jugada! '.$juego->equipo->nombre));
                    unset($juego);
                    return redirect(route('juego.index'));
                break;
            }
        }else{
            return redirect(route('juego.index'));
        }
    }

    public function reset() //reiniciar juego
    {
        $evento = $this->evento();//devuelve informacion del Evento activos
        $juegos = Juego::where('evento_id',$evento[0]->id)->delete();
        event(new NewJuegoEvent('Juego reiniciado!'));
        return redirect()->route('juego.index');
    }
}
