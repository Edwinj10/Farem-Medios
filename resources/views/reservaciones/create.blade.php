@extends('layouts.admin')

@section('content')


<br>	<br>	<br>	
<div class="row">
	<div class="col-md-12">	
		{!! Form::open(['route' => 'reservaciones.store' , 'method' =>'POST','files' => true]) !!}
		<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
		<input type="hidden" id="id">
		<div class="col-md-4">	
			<div class="form-group">
				<label>Fecha:</label>
				<input class="form-control" name="fecha" id="fecha" type="date" required="">
			</div>
		</div>
		<div class="col-md-4">	
			<div class="form-group">
				<label for="">Aula:</label>
				<!-- <textarea class="form-control" rows="3" name="detalle" id="detalle"></textarea> -->
				<input class="form-control" placeholder="Aula" name="aula" id="aula" required="">
			</div>
		</div>
		<div class="col-md-4">	
			<div class="form-group">
				<label for="">Carrera:</label>
				<!-- <textarea class="form-control" rows="3" name="detalle" id="detalle"></textarea> -->
				<input class="form-control" placeholder="Carrera" name="carrera" id="carrera" required="">
			</div>
		</div>
		<div class="col-md-4">	
			<div class="form-group">
				<label for="">Medios:</label> 
				<select name="medio_id" class="form-control selectpicker" onchange="Capturar();" data-live-search="true" id="medio_id">
					@foreach ($medios as $m)
					<option value="{{$m->medio_id}}" id="medio_id2">{{$m->nombre}} / {{$m->departamento}}</option>

					@endforeach
				</select>
			</div>
		</div>
		<dic class="col-md-4" >	
			<div class="form-group" hidden="">
				<label for="stock">Stock</label>
				
				<input type="number" disabled name="pstock" id="pstock"  class="form-group" placeholde="Stock">
			</div>
		</dic>

		<div class="col-md-4" hidden="">	
			<div class="form-group">
				<label>Cantidad:</label>
				<input class="form-control" placeholder="Cantidad" name="pcantidad" id="pcantidad" value="1">
			</div>
		</div>
		<!--<div class="col-md-4">	-->
		<!--	<div class="form-group">-->
		<!--		<label>Detalle:</label>-->
		<!--		<input class="form-control" placeholder="Detalle" name="detalle" id="detalle">-->
		<!--		<input class="form-control" placeholder="Cantidad" name="periodo_id" id="periodo_id" type="hidden">-->
		<!--	</div>-->

		<!--</div>-->
		<div class="form-md-4">	

			<div class="form-group">
				<label for="">Turnos:</label>
				<select name="turnos" id="turnos">
					<option value=""></option>
					@foreach ($periodos as $p)
					<option value="{{$p->id}}">{{$p->turno2}} {{$p->hora_inicio}} {{$p->hora_fin}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="md-4">
			
		</div>
		<div class="md-4"></div>
		<div class="md-4"></div>
		<div class="md-4"></div>
		<div class="md-4"></div>
		<div class="md-4"></div>
		<div class="md-4"></div>

		<div class="col-md-4">	
			<div class="form-group" id="estado">
				<label>Estado:</label>
				<select name="estado" class="" data-live-search="true">
					<option value="Espera">Espera</option>

				</select>
			</div>
		</div>
	</div>	
	<div class="form-group">
		<div align="center">
			<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:#A9D0F5">
					<th>Opciones</th>
					<th>Articulos</th>
					<th>Cantidad</th>

				</thead>

				<tfoot>
					<th></th>
					<th></th>
					<th></th>


				</tfoot>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
	<div class="modal-footer ">

		<button type="submit" class="btn btn-primary" id="GrabarE">Guardar</button>

	</div>
{!!Form::close()!!}</div>
</div>		
@endsection


@push ('scripts')
<script>

	$(document).ready(function(){
		$('#bt_add').click(function(){
			agregar();

		});
		var URLActual = window.location.pathname;
		
		var medio = URLActual.substr(12,13);
		var susmedio = medio.substr(0,2);
		var fecha = URLActual.substr(15,18);
		$('input[name=fecha]').prop({'value': fecha});
		//$('input[name=medio_id2]').prop({'text': susmedio});

	});

	var cont=0;
	total=0;
	subtotal=[];
	$("#GrabarE").hide();
	$("#matutino2").hide();
	$("#vespertino2").hide();
	$("#nocturno2").hide();
	$("#sabatino2").hide();
	$("#dominical2").hide();
	$('#medio_id').change(mostrarValores);
	$('#estado').hide();

	function mostrarValores()
	{
		datosArticulo=document.getElementById('medio_id').value.split('_')
		$('#pstock').val(datosArticulo[1]);
	}

	

	function agregar()
	{

		datosArticulo=document.getElementById('medio_id').value.split('_')
		medio_id=datosArticulo[0];
		// medio_id=$('#medio_id').val();
		medio=$('#medio_id option:selected').text();
		periodo=$('#turnos option:selected').val();
		cantidad=$('#pcantidad').val();
		stock=$('#pstock').val();

		
		

		

		if (periodo!= "" && medio!= "" && cantidad!="" && cantidad>0) 
		{
			//subtotal[cont]=(cantidad*precio_compra);
			//total=total+subtotal[cont];
			
			
				var peri=periodo;
				$('input[name=periodo_id]').prop({'value': peri});

				var fila='<tr class="selected" id="fila' +cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="medio_id[]" value="'+medio_id+'">'+medio+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td></tr>';
				cont++;
				limpiar();
				evaluar();

				$('#detalles').append(fila);
			
					

		}
		else
		{
			alert("Error al ingresar detalle de ingreso, revise los datos");
		}
	}

	function limpiar()
	{
		$("#pcantidad").val("");
		$("#pmedio").val("");
		$("#detalle").val("");
		//$("#pprecio_venta").val("");
	}

	function evaluar()
	{
		if (cantidad>0) 
		{
			$("#GrabarE").show();
		}
		else
		{
			$("#GrabarE").hide();
		}
	}

	function eliminar(index){
		total=total-subtotal[index];
		$("#total").html("C$: " + total);
		$("#fila" + index).remove();
		evaluar();
	}

	function Capturar()
	{
    // declaramos un arreglo y lo recorremos
    
    datosArticulo=document.getElementById('medio_id').value.split('_')
    medio=datosArticulo[0];
    var fecha=$('#fecha').val();
    if (fecha!= "" ) 
    {
    	var auxiliar= medio+ '/'+fecha;
    
    var ruta='/list_fecha/'+ auxiliar;
    // var fechas= $('#datepicker').val();
    
    window.location.href=ruta;
    }
    else
    {
    	alert("Error, seleccione una fecha");

    }

    
}

</script>
@endpush

