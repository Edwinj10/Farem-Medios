@extends('layouts.admin')

@section('content')
{{Form::token()}}
<div class="col-md-12">
	<br><br>
	<h4>Reservaciones</h4>
	
	<div id="message-save" class="alert alert-success success" role="alert" style="display: none ">
		<strong id="save">Guardado Correctamente</strong>
	</div>
	<div id="message-delete" class="alert alert-info" role="alert" style="display: none ">
		<strong>El registro se elimino correctamente</strong>
	</div>
  <div id="message" class="alert alert-danger danger" role="alert" style="display: none ">
    <strong id="errors">  
      Hay campos que estan vacios
      <br>  
    </strong>
  </div>
  <div class="container">
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Filtar por fechas</label>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <input type="date" name="fecha" id="datepicker" name="datepicker" onchange="redireccion();">
        
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <button class="btn btn-primary">Buscar</button>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <a href="/reservaciones"><button class="btn btn-primary"> Listar Completa</button></a>
      </div>
    </div>
  </div>


  <div class="table-responsive" id="list-ingresos">
    <table class="table table-bordred table-striped table-hover ">
      <thead>

        <th>Aula</th>
        <th>Carrera</th>
        <th>Turno</th>
        <th>Hora Inicio</th>
        <th>Hora Fin</th>
        <th>Fecha</th>
        <th>Usuario</th>
        <th>Estado</th>
        <th>Detalles</th>
      </thead>
      <tbody>
        <tr>
          @foreach ($reservaciones as $r)
          <td>{{ $r->aula}}</td>
          <td>{{ $r->carrera}}</td>
          <td>{{ $r->turno}}</td>
          <td>{{ $r->hora_inicio}}</td>
          <td>{{ $r->hora_fin}}</td>
          <td>{{ $r->fecha}}</td>
          <td>{{ $r->name}}</td>
          <td>{{ $r->estado}}</td>
          <td>
            <a class="btn btn-default" href="{{ route ('reservaciones.show',[$r->in])}}"><em class="fa fa-pencil"></em></a>
          </td>
        </tr>




        @endforeach
      </tbody>


    </table>


    <div class="clearfix"></div>
    <ul class="pagination pull-right">
      {{$reservaciones->render()}}
    </ul>


  </div>
  
  
  


  
</div>
</div>


</div>


<!-- @include('usuarios.modaldelete') -->
@push ('scripts')
<script type="text/javascript">


  function redireccion()
  {
    // var id=$('#capturar').val();
    var fecha= $('#datepicker').val();
    
    var dia = fecha.substr(8,9);
    var date = fecha.substr(5,7);
    var date2 =date.substr(0,2);
    var anio = fecha.substr(0,4);
    
    // 2017
    //var id= $('#capturar').val();
    var capturar = anio+ '-'+date2+ '-'+dia;
    
    var ruta=  '/list_fechas/'+capturar;
    window.location.href=ruta;
    // var ruta=  '/fechas/'+capturar;
    // window.location.href=ruta;
    
  }



</script>

@endpush
@endsection