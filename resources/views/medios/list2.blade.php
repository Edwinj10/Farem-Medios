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
	<div class="form-group">
    <label for="">Departamentos:</label> 
    <select name="depto" class="form-control selectpicker"  data-live-search="true" id="depto">
      <option value="">Eliga el departamento</option>
      @foreach ($medios2 as $m2)
      <option value="{{$m2->departamento}}">{{$m2->departamento}}</option>

      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="">Nombre:</label> 
    <select name="estado" class="form-control selectpicker" onchange="Capturar();" data-live-search="true" id="estado">
      <option value="">Eliga el Estado</option>
      @foreach ($medios2 as $m)
      <option value="{{$m->nombre}}">{{$m->nombre}}</option>

      @endforeach
    </select>
  </div>

  <div class="table-responsive" id="list-medios">

    <table class="table table-bordred table-striped table-hover ">
     <thead>

      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Marca</th>
      <th>Color</th>
      <th>Capacidad</th>
      <th>Stock</th>
      <th>Foto</th>
      <th>Departamento</th>
      <th>Editar</th>
      <th>Borrar</th>
    </thead>
    <tbody>
      <tr>
       @foreach ($medios as $m)
       <td>{{ $m->nombre}}</td>
       <td>{{ $m->descripcion}}</td>
       <td>{{ $m->marca}}</td>
       <td>{{ $m->color}}</td>
       <td>{{ $m->capacidad}}</td>
       <td>{{ $m->stock}}</td>
       <td><img src="{{asset('imagenes/medios/'.$m->foto)}}" alt="{{ $m->nombre}}" height="100px" width="100px" class="img-thumbail">
       </td>
       <td>{{ $m->departamento}}</td>
       <td><p onclick='Mostrar({{$m->id}});'   data-placement="top" data-toggle="tooltip" title="Edit"><button  class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
       <td><p onclick='Eliminar({{$m->id}});' data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
     </tr>
     @endforeach
   </tbody>


 </table>

 <div class="clearfix"></div>
 <ul class="pagination pull-right">
   {{$medios->render()}}
 </ul>


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
      			$("input[name='stock']").val('');
      			$("input[name='departamento']").val('');
            // alert('Image Upload Successfully.');
            
            $('#message-save').show().delay(2000).fadeOut(2);
            $("input[name='nombre']").val('');
            $("input[name='descripcion']").val('');
            $("input[name='marca']").val('');
            $("input[name='color']").val('');
            $("input[name='capacidad']").val('');
            $("input[name='stock']").val('');
            $("input[name='departamento']").val('');
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
      $("#descripcionedit").val(data.descripcion);
      $("#marcaedit").val(data.marca);
      $("#coloredit").val(data.color);
      $("#capacidadedit").val(data.capacidad);
      $("#stockedit").val(data.stock);
      $("#departamentoedit").val(data.departamento);
      $("#fotoedit").val(data.foto);
    });
   }


    //editar
    $('#actualizar').click(function()
    {
    	var id= $('#id').val();
    	var nombreedit = $('#nombreedit').val();
    	var descripcionedit = $('#descripcionedit').val();
    	var marcaedit = $('#marcaedit').val();
    	var coloredit = $('#coloredit').val();
    	var capacidadedit = $('#capacidadedit').val();
    	var stockedit = $('#stockedit').val();
    	var departamentoedit = $('#departamentoedit').val();
    	var route = "{{url('medios')}}/" +id+"";
    	var token = $('#token').val();

    	$.ajax({
    		url : route ,
    		headers: {'X-CSRF-TOKEN':token},
    		type: 'PUT',
    		datatype : 'json' ,
    		data: {nombre:nombreedit,descripcion:descripcionedit,marca:marcaedit,color:coloredit,capacidad:capacidadedit, stock:stockedit, departamento:departamentoedit },
    		success: function(data){
    			if (data.success == 'true') 
    			{
    				listMedios();
            // $("#myModalEditar").modal('toggle');
            
            $('#edit').modal('toggle');
            $('#message-save').show().delay(2000).fadeOut(2);
            // $("#message-update").fadeIn(1500);

          }
        },
        error:function(data)
        {
         $('#error').html(data.responseJSON.nombre);
         $('#message').fadeIn();
           // $('#message-error_edit').show().delay(2000).fadeOut(2);
           if (data.status == 422) 
           {
           	console.clear();
           }
         }
       });
    });


    function Capturar()
    {
    // declaramos un arreglo y lo recorremos
    var depto=$('#depto option:selected').val();
    var estado=$('#estado option:selected').val();

    var auxiliar= depto+ '/'+estado;
    
    var ruta='/list_depto/'+ auxiliar;
    // var fechas= $('#datepicker').val();
    
    window.location.href=ruta;
  }
</script>

@endpush
@endsection




