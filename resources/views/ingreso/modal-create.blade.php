<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Crear Ingreso</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => 'ingresos.store' , 'method' =>'POST','files' => true]) !!}
				<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
				<input type="hidden" id="id">

				<div class="form-group">
					<label>Fecha:</label>
					<input class="form-control" name="fecha" id="fecha" type="date">
				</div>
				<div class="form-group">
					<label for="">Detalle:</label>
					
					<input class="form-control" placeholder="Detalle" name="detalle" id="detalle">

				</div>
				<div class="form-group">
					<label>Estado:</label>
					<select name="estado" class="form-control selectpicker" data-live-search="true">
						<option value="Aprobado">Aprobado</option>
						<option value="Denegado">Denegado</option>
					</select>
				</div>
				<div class="form-group">
					<label>Cantidad:</label>
					<input class="form-control" placeholder="Cantidad" name="pcantidad" id="pcantidad">
				</div>
				<div class="form-group">
					<label>Medio:</label>
					<select name="medio_id" class="form-control selectpicker" data-live-search="true" id="medio_id">
						@foreach ($medios as $m)
						<option value="{{$m->medio_id}}">{{$m->nombre}}</option>
						@endforeach
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

	function agregar()
	{
		medio_id=$('#medio_id').val();
		medio=$('#medio_id option:selected').text();
		cantidad=$('#pcantidad').val();
		//precio_compra=$('#pprecio_compra').val();
		//precio_venta=$('#pprecio_venta').val();

		if (medio!= "" && cantidad!="" && cantidad>0) 
		{
			//subtotal[cont]=(cantidad*precio_compra);
			//total=total+subtotal[cont];

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

