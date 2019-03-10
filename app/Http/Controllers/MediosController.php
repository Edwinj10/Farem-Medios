<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Medio;
/*Declarar estas lbrerias , las uso en el metodo edit*/
use Session;
use DB;
use Auth;
use Image;
use Validator;

class MediosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medios=DB::table('medios as m')
        ->select('m.*')
        ->paginate(40);

        return view('medios.index', ["medios"=>$medios]);
    }

    public function listall()
    {
        $medios=DB::table('medios as m')
        ->select('m.*')
        ->paginate(40);

        return view('medios.list', ["medios"=>$medios]);
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
       $validator = Validator::make($request->all(), [
            // 'nombre' => 'required',
            // 'apodo' => 'required',
            // 'sitio_web' => 'required',
            // 'pais' => 'required',
            // 'historia' => 'required',
            // 'descripcion' => 'required',
            // 'nombre_estadio' => 'required',
            // 'ligas_id' => 'required',
       ]);


       if ($validator->passes()) {


        $input = $request->all();


        $input['foto'] = time().'.'.$request->foto->getClientOriginalExtension();
        $request->foto->move(public_path('/imagenes/medios/'), $input['foto']);

        Medio::create($input);


        return response()->json(['success'=>'done']);
    }


    return response()->json(['error'=>$validator->errors()->all()]);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medios = Medio::find($id);
        return response()->json($medios);
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
        if ($request->ajax())
        {
            $medios = User::findOrFail($id);
            $input =  $request->all();
            $result = $medios->fill($input)->save();

            if ($result) 
            {
              return response()->json(['success' => 'true']);
          }
          else 
          {
            return response()->json(['success' => 'false']);
        }

    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medios=Medio::findOrFail($id);
        $medios_foto =public_path('imagenes/medios').'/'.$medios->foto;
        unlink($medios_foto);
        $result = $medios->delete();
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

