@extends('layouts.admin')

@section('content')
{{Form::token()}}
<div class="col-md-12">
	<br><br>
	<h4>Usuarios</h4>
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
@include('usuarios.modalcreate')
@include('usuarios.modaledit')

<!-- @include('usuarios.modaldelete') -->
@push ('scripts')
<script>
	$(document).ready(function () {
		$('#mostrar_contrasena').click(function () {
			if ($('#mostrar_contrasena').is(':checked')) {
				$('#password').attr('type', 'password');
			} else {
				$('#password').attr('type', 'text');
			}
		});
	});

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
      		url: '{{url('listall')}}',
      		success: function(data){
      			$('#list-usuarios').empty().html(data);
      		}
      	});
      }

      // guardar
      $("body").on("click",".upload-image",function(e){
        $(this).parents("form").ajaxForm(options);
      });

      var options = { 
        complete: function(response) 
        {
          if($.isEmptyObject(response.responseJSON.error)){
            $("input[name='name']").val('');
            $("input[name='email']").val('');
            $("input[name='password']").val('');
            $("input[name='apellido']").val('');
            $("input[name='tipo']").val('');
            $("input[name='estado']").val('');
            
            // alert('Image Upload Successfully.');
            

            $("input[name='name']").val('');
            $("input[name='email']").val('');
            $("input[name='password']").val('');
            $("input[name='apellido']").val('');
            $("input[name='tipo']").val('');
            $("input[name='estado']").val('');
            //$('#create').hide();
            $('#create').modal('toggle');
            // $('#panel').toggle(1000);
            $('#message-save').show().delay(2000).fadeOut(2);
            listUsuarios();
            //$("#save-equipos").hide();

          }else{
            printErrorMsg(response.responseJSON.error);
            $('#message-error').show().delay(4000).fadeOut(2);
          }
        }
      };
      function printErrorMsg (msg) {
        $("#message-error").find("ul").html('');
        $("#message-error").css('display','block');
        $.each( msg, function( key, value ) {
          $("#message-error").find("ul").append('<li>'+value+'</li>');
        });
      }

      // $('#GrabarE').click(function(event)
      // {
      // 	var name = $('#name').val();
      // 	var apellido = $('#apellido').val();
      // 	var email = $('#email').val();
      // 	var tipo = $('#tipo').val();
      // 	var estado = $('#estado').val();
      // 	var password = $('#password').val();
      // 	var token = $("input[name=_token]").val();
      // 	var route = "{{route('usuarios.store')}}";

      // 	$.ajax({
      // 		url : route ,
      // 		headers: {'X-CSRF-TOKEN':token},
      // 		type: 'post',
      // 		datatype : 'json' ,
      // 		data: {name: name, apellido:apellido, email:email, tipo:tipo, estado:estado, password:password},
      // 		success:function(data)
      // 		{
      // 			if (data.success == 'true')
      // 			{

      //         // alert('Comentario Guardado Correctamente');
      //         // $('#save').fadeOut(1500);
      //         $('#name').val('');
      //         $('#apellido').val('');
      //         $('#email').val('');
      //         $('#password').val('');
      //         $('#create').modal('toggle');
      //         // $('#message-save').fadeIn(1500);
      //         $('#message-save').show().delay(2000).fadeOut(2);
      //         listUsuarios();

      //       }
      //     },
      //     error:function(data)
      //     {
      //       // console.log(data.responseJSON.comentario);
      //       $("#errors").html(data.responseJSON.etiqueta);
      //       $('#message').show().delay(2000).fadeOut(2);
      //     }
      //   })

      // });


      var Mostrar = function(id)
      {
      	var route = "{{url('/usuarios')}}/" +id+"/edit";
      	$.get(route, function(data){
      		$("#id").val(data.id);
      		$("#nameedit").val(data.name);
      		$("#apellidoedit").val(data.apellido);
      		$("#emailedit").val(data.email);
      		$("#tipoedit").val(data.tipo);
      		$("#estadoedit").val(data.estado);

      	});
      }

	     // guardar
	     

      // actualizar
      $('#actualizar').click(function()
      {
      	var id= $('#id').val();
      	var nameedit = $('#nameedit').val();
      	var apellidoedit = $('#apellidoedit').val();
      	var emailedit = $('#emailedit').val();
      	var tipoedit = $('#tipoedit').val();
      	var estadoedit = $('#estadoedit').val();
      	var route = "{{url('usuarios')}}/" +id+"";
      	var token = $('#token').val();

      	$.ajax({
      		url : route ,
      		headers: {'X-CSRF-TOKEN':token},
      		type: 'PUT',
      		datatype : 'json' ,
      		data: {name:nameedit,apellido:apellidoedit,email:emailedit,tipo:tipoedit,estado:estadoedit },
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
         $('#error_edit').html(data.responseJSON.name);
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
      	var route = "{{url('usuarios')}}/" +id+"";
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