<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
//use App\Http\Requests\IngresoRequest;
use App\Reservacione;
use App\Detalle_Reservacione;
use DB;
use Auth;
use Carbon\Carbon;
use Response;
use Session;

class ReservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'index', 'listar', 'index2', 'listar2']);
        // para los midelware
        $this->middleware('admin', ['only' => ['index', 'listar']]);
        Carbon::setLocale('es');  
    }

    public function index(Request $request)
    {
       if ($request) 
       {
            // trim para borrar espacios al incio y a final en la busqueda
        $query=trim($request->get('searchText'));
        $reservaciones=DB::table('reservaciones as r')
        ->join('users as u', 'r.usuario_id', '=', 'u.id')
        ->join('detalle__reservaciones as dr', 'r.id', '=', 'dr.reservacion_id')
        ->join('periodos as p', 'p.id', '=', 'dr.periodo_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
        ->select('r.id as in','r.aula', 'r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre as turno','p.hora_inicio', 'p.hora_fin')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
        ->orderBy('r.id', 'desc')
        ->groupBy('r.id','r.aula', 'r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre','p.hora_inicio', 'p.hora_fin')
            // agrupamos las dos tabas
        ->paginate(20);


        $medios=DB::table('medios as m')
        ->select('m.id as medio_id', 'm.nombre', 'm.stock', 'm.departamento')
        ->get();

        $periodos=DB::table('periodos as p')
        ->select('p.nombre as turno2')
        ->groupBy('p.nombre')
        ->orderBy('p.nombre', 'asc')
        ->get();
        
        $matutino=DB::table('periodos as p2')
        ->select('p2.*')
        ->where('p2.nombre', '=', 'Matutino')
        ->orderBy('p2.hora_inicio', 'asc')
        ->get();

        $vespertino=DB::table('periodos as p3')
        ->select('p3.*')
        ->where('p3.nombre', '=', 'Vespertino')
        ->orderBy('p3.hora_inicio', 'asc')
        ->get();

        $nocturno=DB::table('periodos as p6')
        ->select('p6.*')
        ->where('p6.nombre', '=', 'Nocturno')
        ->orderBy('p6.hora_inicio', 'asc')
        ->get();

        $sabatino=DB::table('periodos as p4')
        ->select('p4.*')
        ->where('p4.nombre', '=', 'Sabatino')
        ->orderBy('p4.hora_inicio', 'asc')
        ->get();

        $dominical=DB::table('periodos as p5')
        ->select('p5.*')
        ->where('p5.nombre', '=', 'Dominical')
        ->orderBy('p5.hora_inicio', 'asc')
        ->get();


        return view('reservaciones.index',['reservaciones'=>$reservaciones, 'medios'=>$medios, 'periodos'=>$periodos, 'matutino'=>$matutino,'vespertino'=>$vespertino, 'nocturno'=>$nocturno, 'sabatino'=>$sabatino, 'dominical'=>$dominical, "searchText"=>$query]);

    }
}
public function listar(Request $request)
{
 if ($request) 
 {
            // trim para borrar espacios al incio y a final en la busqueda
    $query=trim($request->get('searchText'));
    $reservaciones=DB::table('reservaciones as r')
    ->join('users as u', 'r.usuario_id', '=', 'u.id')
    ->join('detalle__reservaciones as dr', 'r.id', '=', 'dr.reservacion_id')
    ->join('periodos as p', 'p.id', '=', 'dr.periodo_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
    ->select('r.id as in','r.aula', 'r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre as turno','p.hora_inicio', 'p.hora_fin')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
    ->orderBy('r.id', 'desc')
    ->groupBy('r.id','r.aula', 'r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre','p.hora_inicio', 'p.hora_fin')
            // agrupamos las dos tabas
    ->paginate(20);

    $medios=DB::table('medios as m')
    ->select('m.id as medio_id', 'm.nombre', 'm.stock', 'm.departamento')
    ->get();

    $periodos=DB::table('periodos as p')
    ->select('p.*', 'p.nombre as turno2')
    ->get();

    $matutino=DB::table('periodos as p2')
    ->select('p2.*')
    ->where('p2.nombre', '=', 'Matutino')
    ->orderBy('p2.hora_inicio', 'asc')
    ->get();

    $vespertino=DB::table('periodos as p3')
    ->select('p3.*')
    ->where('p3.nombre', '=', 'Vespertino')
    ->orderBy('p3.hora_inicio', 'asc')
    ->get();

    $nocturno=DB::table('periodos as p6')
    ->select('p6.*')
    ->where('p6.nombre', '=', 'Nocturno')
    ->orderBy('p6.hora_inicio', 'asc')
    ->get();

    $sabatino=DB::table('periodos as p4')
    ->select('p4.*')
    ->where('p4.nombre', '=', 'Sabatino')
    ->orderBy('p4.hora_inicio', 'asc')
    ->get();

    $dominical=DB::table('periodos as p5')
    ->select('p5.*')
    ->where('p5.nombre', '=', 'Dominical')
    ->orderBy('p5.hora_inicio', 'asc')
    ->get();

    return view('reservaciones.list',['reservaciones'=>$reservaciones, 'medios'=>$medios, 'periodos'=>$periodos, 'matutino'=>$matutino,'vespertino'=>$vespertino, 'nocturno'=>$nocturno, 'sabatino'=>$sabatino, 'dominical'=>$dominical, "searchText"=>$query]);

}
}

public function list_fechas (Request $request, $fecha)
{
    if ($request) 
    {
            // trim para borrar espacios al incio y a final en la busqueda
        $query=trim($request->get('searchText'));
         // $ax='2019-04-25';
        $reservaciones=DB::table('reservaciones as r')
        ->join('users as u', 'r.usuario_id', '=', 'u.id')
        ->join('detalle__reservaciones as dr', 'r.id', '=', 'dr.reservacion_id')
        ->join('periodos as p', 'p.id', '=', 'dr.periodo_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
        ->select('r.id as in','r.aula', 'r.usuario_id','r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre as turno','p.hora_inicio', 'p.hora_fin')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
        ->orderBy('r.id', 'desc')
        ->groupBy('r.id','r.aula','r.usuario_id', 'r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre','p.hora_inicio', 'p.hora_fin')

       
        ->where('r.fecha', '=', $fecha)
            // agrupamos las dos tabas
       
        ->paginate(20);
         // return $reservaciones;




        return view('reservaciones.fechas',['reservaciones'=>$reservaciones, "searchText"=>$query]);

    }

}

public function list_fechas2 (Request $request, $fecha)
{
    if ($request) 
    {
            // trim para borrar espacios al incio y a final en la busqueda
        $query=trim($request->get('searchText'));
         // $ax='2019-04-25';
        $reservaciones=DB::table('reservaciones as r')
        ->join('users as u', 'r.usuario_id', '=', 'u.id')
        ->join('detalle__reservaciones as dr', 'r.id', '=', 'dr.reservacion_id')
        ->join('periodos as p', 'p.id', '=', 'dr.periodo_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
        ->select('r.id as in','r.aula', 'r.usuario_id','r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre as turno','p.hora_inicio', 'p.hora_fin')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
        ->orderBy('r.id', 'desc')
        ->groupBy('r.id','r.aula','r.usuario_id', 'r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre','p.hora_inicio', 'p.hora_fin')

       
        ->where('r.fecha', '=', $fecha)
            // agrupamos las dos tabas
       
        ->paginate(20);
         // return $reservaciones;




        return view('reservaciones.fechas2',['reservaciones'=>$reservaciones, "searchText"=>$query]);

    }

}

public function index2(Request $request)
{
   if ($request) 
   {
            // trim para borrar espacios al incio y a final en la busqueda
    $query=trim($request->get('searchText'));
    $id = Auth::id();
    $reservaciones=DB::table('reservaciones as r')
    ->join('users as u', 'r.usuario_id', '=', 'u.id')
    ->join('detalle__reservaciones as dr', 'r.id', '=', 'dr.reservacion_id')
    ->join('periodos as p', 'p.id', '=', 'dr.periodo_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
    ->select('r.id as in','r.aula', 'r.usuario_id','r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre as turno','p.hora_inicio', 'p.hora_fin')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
    ->orderBy('r.id', 'desc')
    ->groupBy('r.id','r.aula','r.usuario_id', 'r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre','p.hora_inicio', 'p.hora_fin')
    ->where('r.usuario_id', '=', $id)
            // agrupamos las dos tabas
    ->paginate(20);

    

    $medios=DB::table('medios as m')
    ->select('m.id as medio_id', 'm.nombre', 'm.stock', 'm.departamento')
    ->get();

    $periodos=DB::table('periodos as p')
    ->select('p.nombre as turno2')
    ->groupBy('p.nombre')
    ->orderBy('p.nombre', 'asc')
    ->get();

    $matutino=DB::table('periodos as p2')
    ->select('p2.*')
    ->where('p2.nombre', '=', 'Matutino')
    ->orderBy('p2.hora_inicio', 'asc')
    ->get();

    $vespertino=DB::table('periodos as p3')
    ->select('p3.*')
    ->where('p3.nombre', '=', 'Vespertino')
    ->orderBy('p3.hora_inicio', 'asc')
    ->get();

    $nocturno=DB::table('periodos as p6')
    ->select('p6.*')
    ->where('p6.nombre', '=', 'Nocturno')
    ->orderBy('p6.hora_inicio', 'asc')
    ->get();

    $sabatino=DB::table('periodos as p4')
    ->select('p4.*')
    ->where('p4.nombre', '=', 'Sabatino')
    ->orderBy('p4.hora_inicio', 'asc')
    ->get();

    $dominical=DB::table('periodos as p5')
    ->select('p5.*')
    ->where('p5.nombre', '=', 'Dominical')
    ->orderBy('p5.hora_inicio', 'asc')
    ->get();


    return view('reservaciones.index2',['reservaciones'=>$reservaciones, 'medios'=>$medios, 'periodos'=>$periodos, 'matutino'=>$matutino,'vespertino'=>$vespertino, 'nocturno'=>$nocturno, 'sabatino'=>$sabatino, 'dominical'=>$dominical, "searchText"=>$query]);

}
}
public function listar2(Request $request)
{
 if ($request) 
 {
            // trim para borrar espacios al incio y a final en la busqueda
    $query=trim($request->get('searchText'));
    $id = Auth::id();
    $reservaciones=DB::table('reservaciones as r')
    ->join('users as u', 'r.usuario_id', '=', 'u.id')
    ->join('detalle__reservaciones as dr', 'r.id', '=', 'dr.reservacion_id')
    ->join('periodos as p', 'p.id', '=', 'dr.periodo_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
    ->select('r.id as in','r.aula', 'r.usuario_id','r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre as turno','p.hora_inicio', 'p.hora_fin')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
    ->orderBy('r.id', 'desc')
    ->groupBy('r.id','r.aula','r.usuario_id', 'r.carrera', 'r.estado', 'r.fecha', 'r.detalle', 'u.name','u.apellido','p.nombre','p.hora_inicio', 'p.hora_fin')
    ->where('r.usuario_id', '=', $id)
            // agrupamos las dos tabas
    ->paginate(20);

    $medios=DB::table('medios as m')
    ->select('m.id as medio_id', 'm.nombre', 'm.stock', 'm.departamento')
    ->get();

    $periodos=DB::table('periodos as p')
    ->select('p.*', 'p.nombre as turno2')
    ->get();

    $matutino=DB::table('periodos as p2')
    ->select('p2.*')
    ->where('p2.nombre', '=', 'Matutino')
    ->orderBy('p2.hora_inicio', 'asc')
    ->get();

    $vespertino=DB::table('periodos as p3')
    ->select('p3.*')
    ->where('p3.nombre', '=', 'Vespertino')
    ->orderBy('p3.hora_inicio', 'asc')
    ->get();

    $nocturno=DB::table('periodos as p6')
    ->select('p6.*')
    ->where('p6.nombre', '=', 'Nocturno')
    ->orderBy('p6.hora_inicio', 'asc')
    ->get();

    $sabatino=DB::table('periodos as p4')
    ->select('p4.*')
    ->where('p4.nombre', '=', 'Sabatino')
    ->orderBy('p4.hora_inicio', 'asc')
    ->get();

    $dominical=DB::table('periodos as p5')
    ->select('p5.*')
    ->where('p5.nombre', '=', 'Dominical')
    ->orderBy('p5.hora_inicio', 'asc')
    ->get();

    return view('reservaciones.list2',['reservaciones'=>$reservaciones, 'medios'=>$medios, 'periodos'=>$periodos, 'matutino'=>$matutino,'vespertino'=>$vespertino, 'nocturno'=>$nocturno, 'sabatino'=>$sabatino, 'dominical'=>$dominical, "searchText"=>$query]);

}
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $reservaciones=new Reservacione;
            $reservaciones['usuario_id']=Auth::user()->id;
            $reservaciones->fecha=$request->get('fecha');
            $reservaciones->aula=$request->get('aula');
            $reservaciones->carrera=$request->get('carrera');
            $reservaciones->estado=$request->get('estado');
            $reservaciones->detalle=$request->get('detalle');

            $reservaciones->save();
            $max= DB::table('reservaciones')->max('id');
            $reservacion_id=$max;
            $medio_id=$request->get('medio_id');
            $cantidad=$request->get('cantidad');
            $periodo_id=$request->get('periodo_id');
         // return $ingreso_id;



            // while es para ir recorriendo el arreglo de todos datalles
            $cont = 0;
            while ($cont < count($medio_id)) {
             $detalle =  new Detalle_Reservacione();
             $detalle->reservacion_id=$max;
             $detalle->medio_id=$medio_id[$cont];
             $detalle->periodo_id=$periodo_id;
             $detalle->cantidad=$cantidad[$cont];
             $detalle->save();

             $cont=$cont+1;

         }


         DB::commit();

     } catch (Exception $e) {


        DB::rollback();
    }

    return back();

}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $reservaciones=DB::table('reservaciones as r')
     ->join('users as u', 'r.usuario_id', '=', 'u.id')
     ->join('detalle__reservaciones as dr', 'r.id', '=', 'dr.reservacion_id')
     ->join('periodos as p', 'p.id', '=', 'dr.periodo_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
     ->select('r.*','r.id as in', 'u.name','u.apellido' ,'dr.*', 'p.*', 'p.nombre as turno')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
     ->orderBy('r.id', 'desc')
     ->where('r.id', '=', $id)
            // agrupamos las dos tabas
     ->first();




     $detalles=DB::table('reservaciones as r')
     ->join('users as u', 'r.usuario_id', '=', 'u.id')
     ->join('detalle__reservaciones as dr', 'r.id', '=', 'dr.reservacion_id')
     ->join('periodos as p', 'p.id', '=', 'dr.periodo_id')
     ->join('medios as m', 'm.id', '=', 'dr.medio_id')
            // la calse db raw es para que multiplique por cada detalles de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
     ->select('r.*','r.id as in', 'u.name','u.id' ,'dr.*', 'p.*', 'p.nombre as turno', 'm.*')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
     ->orderBy('r.id', 'desc')
     ->where('r.id', '=', $id)
            // agrupamos las dos tabas
     ->get();


     return view('reservaciones.show',['reservaciones'=>$reservaciones, "detalles"=>$detalles]);
 }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservaciones = Reservacione::find($id);
        return response()->json($reservaciones);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $reservaciones= Reservacione::findOrFail($id);
        
        $reservaciones->estado=$request->get('estado2');
        
        $reservaciones->update(); 
        
        Session::flash('message','Actualizado Correctamente');
        return back();
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

    }
}
