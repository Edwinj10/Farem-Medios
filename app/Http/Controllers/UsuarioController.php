<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\User;
/*Declarar estas lbrerias , las uso en el metodo edit*/
use Session;
use DB;
use Auth;
use Validator;

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
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'index', 'listall']);
        // para los midelware
        $this->middleware('admin', ['only' => ['index', 'listall']]);
        
    }


    public function index()
    {
        $usuarios=DB::table('users as u')
        ->select('u.*')
        ->where('u.tipo', '!=', 'SuperAdmin')
        ->paginate(40);

        return view('usuarios.index', ["usuarios"=>$usuarios]);
    }

    public function listall()
    {
        $usuarios=DB::table('users as u')
        ->select('u.*')
        ->where('u.tipo', '!=', 'SuperAdmin')
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
       $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6'],
        'apellido' => ['required', 'string', 'max:255'],
        // 'foto' => 'required|mimes:jpeg,bmp,png',
    ]);


       if ($validator->passes()) {


        $input = $request->all();

            // el mejor codigo
        $input['password']=bcrypt($request->password);
        // $input['foto'] = time().'.'.$request->foto->getClientOriginalExtension();
        // $request->foto->move(public_path('/imagenes/usuarios/'), $input['foto']);

        User::create($input);


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
