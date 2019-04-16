<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\IngresoRequest;
use App\Ingreso;
use App\Detalle_Ingreso;
use DB;
use Auth;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;



class IngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'index', 'listar']);
        // para los midelware
        $this->middleware('admin', ['only' => ['index', 'listar']]);
        
    }
    public function index(Request $request)
    {
        if ($request) 
        {
        	// trim para borrar espacios al incio y a final en la busqueda
        	$query=trim($request->get('searchText'));
        	$ingresos=DB::table('ingresos as i')
        	->join('users as u', 'i.usuario_id', '=', 'u.id')
        	->join('detalle__ingresos as di', 'i.id', '=', 'di.ingreso_id')
        	// la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
          ->select('i.*','i.id as in', 'u.name','u.id' ,'di.ingreso_id', 'medio_id', 'cantidad')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
          ->orderBy('i.id', 'desc')
        	// agrupamos las dos tabas
          ->paginate(20);

          $medios=DB::table('medios as m')
          ->select('m.id as medio_id', 'm.nombre')
          ->get();

          $detalle=DB::table('ingresos as i')
          ->join('users as u', 'i.usuario_id', '=', 'u.id')
          ->join('detalle__ingresos as di', 'i.id', '=', 'di.ingreso_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
          ->select('i.*','i.id as in','di.*')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
          ->orderBy('i.id', 'desc')
          ->get();

          return view('ingreso.index',['ingresos'=>$ingresos, 'medios'=>$medios, "searchText"=>$query, 'detalle'=>$detalle]);

      }
  }

  public function listar(Request $request)
  {
    if ($request) 
    {
            // trim para borrar espacios al incio y a final en la busqueda
        $query=trim($request->get('searchText'));
        $ingresos=DB::table('ingresos as i')
        ->join('users as u', 'i.usuario_id', '=', 'u.id')
        ->join('detalle__ingresos as di', 'i.id', '=', 'di.ingreso_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
        ->select('i.id as in','i.fecha','i.estado','i.detalle', 'u.name','u.id' ,'di.ingreso_id')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
        ->orderBy('i.id', 'desc')
        ->groupBy('i.id','i.fecha','i.estado','i.detalle', 'u.name','u.id' ,'di.ingreso_id')
            // agrupamos las dos tabas
        ->paginate(20);

        $medios=DB::table('medios as m')
        ->select('m.id as medio_id', 'm.nombre')
        ->get();

        $detalle=DB::table('ingresos as i')
        ->join('users as u', 'i.usuario_id', '=', 'u.id')
        ->join('detalle__ingresos as di', 'i.id', '=', 'di.ingreso_id')
        ->join('medios as m', 'm.id', '=', 'medio_id')
            // la calse db raw es para que multiplique por cada detalle de ingreso la cantidad por el precio de compra y lo guadara en ul total para mostralo despues
        ->select('i.*','i.id as in','di.*', 'm.*', 'u.*')
            //->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
        ->orderBy('i.id', 'desc')
        ->paginate(6);




        return view('ingreso.list',['ingresos'=>$ingresos, 'medios'=>$medios, "searchText"=>$query, 'detalle'=>$detalle]);

    }
}


public function store(Request $request)

{       
   try {
      DB::beginTransaction();
      $ingreso=new Ingreso;

      $ingreso['usuario_id']=Auth::user()->id;
      $ingreso->fecha=$request->get('fecha');
      $ingreso->estado=$request->get('estado');
      $ingreso->detalle=$request->get('detalle');

      $ingreso->save();
      $max= DB::table('ingresos')->max('id');


      $ingreso_id=$request->get('medio_id');
      $cantidad=$request->get('cantidad');
         // return $ingreso_id;



    		// while es para ir recorriendo el arreglo de todos datalles
      $cont = 0;
      while ($cont < count($ingreso_id)) {
         $detalle =  new Detalle_Ingreso();
         $detalle->ingreso_id=$max;
         $detalle->medio_id=$ingreso_id[$cont];
         $detalle->cantidad=$cantidad[$cont];
         $detalle->save();

         $cont=$cont+1;
     }

     DB::commit();

 } catch (Exception $e) {


  DB::rollback();
}

return Redirect::to('/ingresos');
}




public function show($id)
{
    $i=DB::table('ingresos as i')
    ->join('users as u', 'i.usuario_id', '=', 'u.id')
    ->join('detalle__ingresos as di', 'i.id', '=', 'di.ingreso_id')
    ->select('i.*', 'u.name','u.id','u.apellido', 'di.*')
    ->where('i.id', '=',$id)

    ->first();




    $detalles=DB::table('detalle__ingresos as d')
    ->join('medios as m', 'd.medio_id', '=', 'm.id')
    ->select('d.*', 'm.*')
    ->where('d.ingreso_id', '=',$id)
    ->get();


    return view ('ingreso.show', ['i'=>$i, 'detalles'=>$detalles]);



}

public function destroy($id)
{
    $ingreso=Ingreso::findOrFail($id);
    $ingreso->estado='Anulado';
    $result = $ingreso->update();
    if ($result) 
    {
        return response()->json(['success' => 'true']);
    }
    else
    {
        return response()->json(['success'=>'false']);
    }
}



}
