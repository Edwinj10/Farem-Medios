@extends('layouts.admin')

@section('content')
{{Form::token()}}
<div class="col-md-12">
	<br><br>
	<h4>Periodos</h4>
	<button type="button" class="btn btn-sm btn-primary btn-primary" data-target="#create" data-toggle="modal"><em class="fa fa-pencil">Crear Nuevo</em></button>
	<br><br>
	<div id="message-save" class="alert alert-success success" role="alert" style="display: none ">
		<strong id="save">Guardado Correctamente</strong>
	</div>
	<div id="message-delete" class="alert alert-info" role="alert" style="display: none ">
		<strong>El registro se elimino correctamente</strong>
	</div>
	<div class="table-responsive" id="list-usuarios">


	</div>

</div>
</div>
</div>
@include('periodos.modalcreate')
@include('periodos.modaledit')

<!-- @include('usuarios.modaldelete') -->
@push ('scripts')
<script>
  
  
  $(document).ready(function(){
    listUsuarios();
  });
      // paginacion
      $(document).on("click", ".pagination li a", function(e){
      	e.preventDefault();

      	var url = $(this).attr('href');

      	$.ajax({
      		type: 'get',
      		url: url,
      		success: function(data){
      			$('#list-usuarios').empty().html(data);
      		}
      	});
      });
      // listar
      var listUsuarios = function()
      {

      	$.ajax({
      		type:'get',
      		url: '{{url('listP')}}',
      		success: function(data){
      			$('#list-usuarios').empty().html(data);
      		}
      	});
      }

      $('#GrabarE').click(function(event)
      {
      	var nombre = $('#nombre').val();
      	var hora_inicio = $('#hora_inicio').val();
      	var hora_fin = $('#hora_fin').val();
      	var token = $("input[name=_token]").val();
      	var route = "{{route('periodos.store')}}";

      	$.ajax({
      		url : route ,
      		headers: {'X-CSRF-TOKEN':token},
      		type: 'post',
      		datatype : 'json' ,
      		data: {nombre: nombre, hora_inicio:hora_inicio, hora_fin:hora_fin},
      		success:function(data)
      		{
      			if (data.success == 'true')
      			{

              // alert('Comentario Guardado Correctamente');
              // $('#save').fadeOut(1500);
              $('#nombre').val('');
              
              $('#create').modal('toggle');
              // $('#message-save').fadeIn(1500);
              $('#message-save').show().delay(2000).fadeOut(2);
              listUsuarios();

            }
          },
          error:function(data)
          {
            // console.log(data.responseJSON.comentario);
            $("#errors").html(data.responseJSON.nombre);
            $('#message').show().delay(2000).fadeOut(2);
          }
        })

      });




      var Mostrar = function(id)
      {
      	var route = "{{url('/periodos')}}/" +id+"/edit";
      	$.get(route, function(data){
      		$("#id").val(data.id);
      		$("#nombreedit").val(data.nombre);
      		$("#hora_inicioedit").val(data.hora_inicio);
      		$("#hora_finedit").val(data.hora_fin);

      	});
      }

	     // guardar
	     

      // actualizar
      $('#actualizar').click(function()
      {
      	var id= $('#id').val();
      	var nombreedit = $('#nombreedit').val();
      	var hora_inicioedit = $('#hora_inicioedit').val();
      	var hora_finedit = $('#hora_finedit').val();
      	var route = "{{url('periodos')}}/" +id+"";
      	var token = $('#token').val();

      	$.ajax({
      		url : route ,
      		headers: {'X-CSRF-TOKEN':token},
      		type: 'PUT',
      		datatype : 'json' ,
      		data: {nombre:nombreedit,hora_inicio:hora_inicioedit,hora_fin:hora_finedit},
      		success: function(data){
      			if (data.success == 'true') 
      			{
      				listUsuarios();
            // $("#myModalEditar").modal('toggle');
            
            $('#edit').modal('toggle');
            $('#message-save').show().delay(2000).fadeOut(2);
            // $("#message-update").fadeIn(1500);

          }
        },
        error:function(data)
        {
         $('#error_edit').html(data.responseJSON.nombre);
         $('#message-error_edit').fadeIn();
           // $('#message-error_edit').show().delay(2000).fadeOut(2);
           if (data.status == 422) 
           {
           	console.clear();
           }
         }
       });
      });


      // guardar

      // cuando se cierra la ventana modal
      
      var Eliminar = function(id)
      {
      // Alert Jquery
      $.alertable. confirm ("Está seguro de eliminar el registro?").then(function(){
      	var route = "{{url('periodos')}}/" +id+"";
      	var token = $('#token').val();

      	$.ajax({
      		url : route ,
      		headers: {'X-CSRF-TOKEN':token},
      		type: 'DELETE',
      		datatype : 'json' ,
      		success: function(data){
      			if (data.success == 'true') 
      			{
      				listUsuarios();
              // $("#message-delete").fadeIn();
              $('#message-delete').show().delay(2000).fadeOut(2);
            }
          }
        });
      });
    };

  </script>
  @endpush
  @endsection