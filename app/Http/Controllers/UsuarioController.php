<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\User;
/*Declarar estas lbrerias , las uso en el metodo edit*/
use Session;
use DB;
use Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct(){
    //     // para los midelware
    //     $this->middleware('auth');
    //     $this->middleware('admin', ['only'=> ['create', 'edit']]);
    // }

    public function index()
    {
        $usuarios=DB::table('users as u')
        ->select('u.*')
        ->paginate(40);

        return view('usuarios.index', ["usuarios"=>$usuarios]);
    }

    public function listall()
    {
        $usuarios=DB::table('users as u')
        ->select('u.*')
        ->paginate(40);

        return view('usuarios.list', ["usuarios"=>$usuarios]);
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
        if ($request->ajax()) 
        {
            $result = User::create($request->all());
            
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
        $usuarios = User::find($id);
        return response()->json($usuarios);
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
            $usuarios = User::findOrFail($id);
            $input =  $request->all();
            $result = $usuarios->fill($input)->save();

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
        $usuarios=User::findOrFail($id);
        $result = $usuarios->delete();
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
