@extends('layouts.admin')

@section('content')
{{Form::token()}}
<div class="col-md-12">
	<br><br>
	<h4>Medios</h4>
	<button type="button" class="btn btn-sm btn-primary btn-primary" data-target="#create" data-toggle="modal"><em class="fa fa-pencil">Crear Nuevo</em></button>
	<br><br>
	<div id="message-save" class="alert alert-success success" role="alert" style="display: none ">
		<strong id="save">Guardado Correctamente</strong>
	</div>
	<div id="message-delete" class="alert alert-info" role="alert" style="display: none ">
		<strong>El registro se elimino correctamente</strong>
	</div>

  <div class="table-responsive" id="list-medios">


  </div>
  @include('medios.modalcreate')
  @include('medios.modaledit')
</div>
</div>


</div>


<!-- @include('usuarios.modaldelete') -->
@push ('scripts')
<script type="text/javascript">

  $(document).ready(function(){
    listMedios();
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
        $('#list-medios').empty().html(data);
      }
    });
  });
      // listar
      var listMedios = function()
      {

        $.ajax({
          type:'get',
          url: '{{url('listallmedios')}}',
          success: function(data){
            $('#list-medios').empty().html(data);
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
            $("input[name='nombre']").val('');
            $("input[name='descripcion']").val('');
            $("input[name='marca']").val('');
            $("input[name='color']").val('');
            $("input[name='capacidad']").val('');
            
            // alert('Image Upload Successfully.');
            
            $('#message-save').show().delay(2000).fadeOut(2);
            $("input[name='nombre']").val('');
            $("input[name='descripcion']").val('');
            $("input[name='marca']").val('');
            $("input[name='color']").val('');
            $("input[name='capacidad']").val('');
            //$('#create').hide();
            $('#create').modal('toggle');
            // $('#panel').toggle(1000);
            $('#message-save').show().delay(2000).fadeOut(2);
            listMedios();
            //$("#save-equipos").hide();

          }else{
            printErrorMsg(response.responseJSON.error);
            $('.print-error-msg').show().delay(4000).fadeOut(2);
          }
        }
      };
      function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
          $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
      }


      var Eliminar = function(id)
      {
      // Alert Jquery
      $.alertable. confirm ("Está seguro de eliminar el registro?").then(function(){
        var route = "{{url('medios')}}/" +id+"";
        var token = $('#token').val();

        $.ajax({
          url : route ,
          headers: {'X-CSRF-TOKEN':token},
          type: 'DELETE',
          datatype : 'json' ,
          success: function(data){
            if (data.success == 'true') 
            {
              listMedios();
              // $("#message-delete").fadeIn();
              $('#message-delete').show().delay(2000).fadeOut(2);
            }
          }
        });
      });
    };


    var Mostrar = function(id)
    {
      var route = "{{url('medios')}}/" +id+"/edit";
      $.get(route, function(data){
        $("#id").val(data.id);
        $("#nombreedit").val(data.nombre);
        $("#apodoedit").val(data.apodo);
        $("#nombre_estadioedit").val(data.nombre_estadio);
        $("#sitio_webedit").val(data.sitio_web);
        $("#paisedit").val(data.pais);
        $("#paisedit").val(data.pais);
        $("#bodyField").val(data.descripcion);
        $("#bodyField2").val(data.historia);



      });
    }
  </script>

  @endpush
  @endsection