<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Periodo;
/*Declarar estas lbrerias , las uso en el metodo edit*/
use Session;
use DB;
use Auth;
use Validator;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth', ['only' => 'index', 'listall']);
        // para los midelware
        $this->middleware('admin', ['only' => ['index', 'listall']]);
        
    }

    public function index()
    {
        $periodos=DB::table('periodos as p')
        ->select('p.*')
        ->orderBy('p.nombre', 'asc')
        ->paginate(40);

        return view('periodos.index', ["periodos"=>$periodos]);
    }

    public function listall()
    {
       $periodos=DB::table('periodos as p')
       ->select('p.*')
       ->orderBy('p.nombre', 'asc')
       ->paginate(40);

       return view('periodos.list', ["periodos"=>$periodos]);
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
        $request->validate([
            'nombre' => 'required|string|max:90',
           'hora_inicio' => 'required|string|max:90',
           'hora_fin' => 'required|string|max:90',
        ]);
        if ($request->ajax()) 
        {
            //$result = User::create($request->all());
            $result =Periodo::create([
                'nombre' => $request['nombre'],
                'hora_inicio' => $request['hora_inicio'],
                'hora_fin' => $request['hora_fin'],
            ]);

            if ($result) {
                Session::flash('save', 'Se ha creado Correctamente');
                return response()->json(['success' => 'true']);
            }
            else
            {
                return response()->json(['success' => 'false']);
            }
        } 
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
         $periodos = Periodo::find($id);
        return response()->json($periodos);
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
        $request->validate([
            'nombre' => 'required|string|max:90',
           'hora_inicio' => 'required|string|max:90',
           'hora_fin' => 'required|string|max:90',
        ]);
        if ($request->ajax()) 
        {
            //$result = User::create($request->all());
            $periodos = Periodo::findOrFail($id);
            $input =  $request->all();
            $result = $periodos->fill($input)->save();

            if ($result) 
            {
                Session::flash('save', 'Se ha creado Correctamente');
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
        $periodos=Periodo::findOrFail($id);
        $result = $periodos->delete();
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
