

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Reservar Medio</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => 'reservaciones.store' , 'method' =>'POST','files' => true]) !!}
				<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
				<input type="hidden" id="id">

				<div class="form-group">
					<label>Fecha:</label>
					<input class="form-control" name="fecha" id="fecha" type="date" required="">
				</div>
				<div class="form-group">
					<label for="">Aula:</label>
					<!-- <textarea class="form-control" rows="3" name="detalle" id="detalle"></textarea> -->
					<input class="form-control" placeholder="Aula" name="aula" id="aula" required="">
				</div>
				<div class="form-group">
					<label for="">Carrera:</label>
					<!-- <textarea class="form-control" rows="3" name="detalle" id="detalle"></textarea> -->
					<input class="form-control" placeholder="Carrera" name="carrera" id="carrera" required="">
				</div>
				<div class="form-group">
					<label for="">Medios:</label> 
					<select name="medio_id" class="form-control selectpicker" data-live-search="true" id="medio_id">
						<option value="	">Seleccione</option>
						@foreach ($medios as $m)
						<option value="{{$m->medio_id}}_{{$m->stock}}">{{$m->nombre}} / {{$m->departamento}}</option>
						
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="stock">Stock</label>
					<!-- para que un valor no se pueda modificaar poner la propiedad disabled="" -->
					<input type="number" disabled name="pstock" id="pstock"  class="form-group" placeholde="Stock">
				</div>
				<div class="form-group">
					<label>Cantidad:</label>
					<input class="form-control" placeholder="Cantidad" name="pcantidad" id="pcantidad">
				</div>
				<div class="form-group">
					<label>Detalle:</label>
					<input class="form-control" placeholder="Detalle" name="detalle" id="detalle">
				</div>
				
				
				<input class="form-control" placeholder="Cantidad" name="periodo_id" id="periodo_id" type="hidden">
				
				<div class="form-group">
					<label for="">Turnos:</label>
					<select name="turnos" class="form-control" id="turnos">
						<option value=""></option>
						@foreach ($periodos as $p)
						<option value="{{$p->turno2}}">{{$p->turno2}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group" id="matutino2">
					<label>Matutino</label>
					<select name="matutino" class="form-control" id="matutino">
						<option value=""></option>
						@foreach ($matutino as $m)
						<option value="{{$m->id}}">{{$m->hora_inicio}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group" id="vespertino2">
					<label>Vespertino</label>
					<select name="vespertino" class="form-control" id="vespertino">
						<option value=""></option>
						@foreach ($vespertino as $v)
						<option value="{{$v->id}}">{{$v->hora_inicio}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group" id="nocturno2">
					<label>Nocturno</label>
					<select name="nocturno" class="form-control" id="nocturno">
						<option value=""></option>
						@foreach ($nocturno as $n)
						<option value="{{$n->id}}">{{$n->hora_inicio}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group" id="sabatino2">
					<label>Sabatino</label>
					<select name="sabatino" class="form-control" id="sabatino">
						<option value=""></option>
						@foreach ($sabatino as $s)
						<option value="{{$s->id}}">{{$s->hora_inicio}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group" id="dominical2">
					<label>Dominical</label>
					<select name="dominical" class="form-control" id="dominical">
						<option value=""></option>
						@foreach ($dominical as $d)
						<option value="{{$d->id}}">{{$d->hora_inicio}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group" id="estado">
					<label>Estado:</label>
					<select name="estado" class="form-control selectpicker" data-live-search="true">
						<option value="Espera">Espera</option>
						
					</select>
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
				{!!Form::close()!!}
			</div>		
		</div>
		<!-- /.modal-content --> 
	</div>
	<!-- /.modal-dialog --> 
</div>


@push ('scripts')
<script>

	$(document).ready(function(){
		$('#bt_add').click(function(){
			agregar();

		});
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

	$(document).on("change","#turnos",function(){

		var Capturar = $("#turnos option:selected").val();
		console.log(Capturar);

		if(Capturar == "Matutino")
		{
			$("#matutino2").show();
			$("#vespertino2").hide();
			$("#nocturno2").hide();
			$("#sabatino2").hide();
			$("#dominical2").hide();
			

		}
		else if (Capturar =="Vespertino")
		{


			$("#vespertino2").show();
			$("#matutino2").hide();
			$("#nocturno2").hide();
			$("#sabatino2").hide();
			$("#dominical2").hide();
			

		}

		else if (Capturar =="Nocturno")
		{

			$("#nocturno2").show();
			$("#matutino2").hide();
			$("#vespertino2").hide();
			$("#sabatino2").hide();
			$("#dominical2").hide();
			

		}
		else if (Capturar =="Sabatino")
		{


			$("#sabatino2").show();
			$("#matutino2").hide();
			$("#vespertino2").hide();
			$("#nocturno2").hide();
			$("#dominical2").hide();
			

		}

		else if (Capturar =="Dominical")
		{


			$("#dominical2").show();
			$("#matutino2").hide();
			$("#vespertino2").hide();
			$("#nocturno2").hide();
			$("#sabatino2").hide();
			
		}
	});
	

	function agregar()
	{
		
		datosArticulo=document.getElementById('medio_id').value.split('_')
		medio_id=datosArticulo[0];
		// medio_id=$('#medio_id').val();
		medio=$('#medio_id option:selected').text();
		cantidad=$('#pcantidad').val();
		stock=$('#pstock').val();

		matutino=$('#matutino option:selected').text();
		vespertino=$('#vespertino option:selected').text();
		nocturno=$('#nocturno option:selected').text();
		sabatino=$('#sabatino option:selected').text();
		dominical=$('#dominical option:selected').text();
		var periodo;
		console.log(matutino);
		console.log(vespertino);

		if (periodo!= "" && cantidad!= "" )
		{
			if (vespertino=== "" && nocturno=== "" && sabatino=== "" && dominical === "") 
			{
				periodo_id=$('#matutino').val();
				periodo=$('#matutino option:selected').text();

			}

			if (matutino=== "" && nocturno==="" && sabatino==="" && dominical==="") 
			{
				periodo_id=$('#vespertino').val();
				periodo=$('#vespertino option:selected').text();

			}

			if (matutino=== "" && vespertino==="" && sabatino==="" && dominical==="") 
			{
				periodo_id=$('#nocturno').val();
				periodo=$('#nocturno option:selected').text();

			}

			if (matutino=== "" && vespertino==="" && nocturno=="" && dominical==="") 
			{
				periodo_id=$('#sabatino').val();
				periodo=$('#sabatino option:selected').text();

			}

			if (matutino=== "" && vespertino==="" && nocturno==="" && sabatino==="") 
			{
				periodo_id=$('#dominical').val();
				periodo=$('#dominical option:selected').text();

			}	
		}

		else {
			alert('Seleccione un periodo');
		}

		if (medio!= "" && cantidad!="" && cantidad>0) 
		{
			//subtotal[cont]=(cantidad*precio_compra);
			//total=total+subtotal[cont];
			if (stock>=cantidad) 
			{
				var peri=periodo_id;
				$('input[name=periodo_id]').prop({'value': peri});

				var fila='<tr class="selected" id="fila' +cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="medio_id[]" value="'+medio_id+'">'+medio+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td></tr>';
				cont++;
				limpiar();
				evaluar();

				$('#detalles').append(fila);
			}
			else
			{
				alert('La Cantidad a reservar supera el stock');
			}			

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

</script>
@endpush

