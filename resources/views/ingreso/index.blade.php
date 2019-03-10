@extends('layouts.admin')

@section('content')
{{Form::token()}}
<div class="col-md-12">
	<br><br>
	<h4>Ingresos</h4>
	<button type="button" class="btn btn-sm btn-primary btn-primary" data-target="#create" data-toggle="modal"><em class="fa fa-pencil">Crear Nuevo</em></button>
	<br><br>
	<div id="message-save" class="alert alert-success success" role="alert" style="display: none ">
		<strong id="save">Guardado Correctamente</strong>
	</div>
	<div id="message-delete" class="alert alert-info" role="alert" style="display: none ">
		<strong>El registro se elimino correctamente</strong>
	</div>

  <div class="table-responsive" id="list-ingresos">


  </div>
  @include('ingreso.modal-create')
  @include('ingreso.show')

  
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
          url: '{{url('listallingresos')}}',
          success: function(data){
            $('#list-ingresos').empty().html(data);
          }
        });
      }

      var Mostrar = function(id)
      {
        var route = "{{url('/ingresos')}}/" +id;
        $.get(route, function(data){
          $("#id").val(data.id);
          $("#nombre").val(data.nombre);
          $("#apellidoedit").val(data.apellido);
          $("#emailedit").val(data.email);
          $("#tipoedit").val(data.tipo);
          $("#estadoedit").val(data.estado);

        });
      }


    </script>

    @endpush
    @endsection