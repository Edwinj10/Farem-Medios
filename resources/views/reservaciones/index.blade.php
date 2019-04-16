@extends('layouts.admin')

@section('content')
{{Form::token()}}
<div class="col-md-12">
	<br><br>
	<h4>Reservaciones</h4>
	<button type="button" class="btn btn-sm btn-primary btn-primary" data-target="#create" data-toggle="modal"><em class="fa fa-pencil">Crear Nuevo</em></button>
	<br><br>
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
  </div>


  <div class="table-responsive" id="list-ingresos">


  </div>
  @include('reservaciones.modal-create')
  
  


  
</div>
</div>


</div>


<!-- @include('usuarios.modaldelete') -->
@push ('scripts')
<script type="text/javascript">



  $(document).ready(function(){
    listIngresos();
  });

  // mostra create y ocultar lista
  // paginacion
  $(document).on("click", ".pagination li a", function(e){
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
      type: 'get',
      url: url,
      success: function(data){
        $('#list-ingresos').empty().html(data);
      }
    });
  });
      // listar
      var listIngresos = function()
      {

        $.ajax({
          type:'get',
          url: '{{url('listallreservacion')}}',
          success: function(data){
            $('#list-ingresos').empty().html(data);
          }
        });
      }

      // var Mostrar = function(id)
      // {
      //   var route = "{{url('/ingresos')}}/" +id;
      //   $.get(route, function(data){
      //     $("#id").val(data.id);
      //     $("#nombre").val(data.nombre);
      //     $("#apellidoedit").val(data.apellido);
      //     $("#emailedit").val(data.email);
      //     $("#tipoedit").val(data.tipo);
      //     $("#estadoedit").val(data.estado);

      //   });
      // }

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
    var fecha = anio+ '-'+date2+ '-'+dia;
    var ruta=  '/list_fechas/'+fecha;
    window.location.href=ruta;
    // var ruta=  '/fechas/'+fecha;
    // window.location.href=ruta;
    
  }



</script>

@endpush
@endsection