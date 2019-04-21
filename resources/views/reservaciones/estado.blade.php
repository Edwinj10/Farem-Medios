<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$reservaciones->in}}">
	{{Form::open(array('action'=>array('ReservacionController@update', $reservaciones->in), 'method'=>'put', 'files'=> 'true'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Editar Estado</h4>
			</div>
			<div class="modal-body">
				{{Form::token()}}
				<div class="row">			
					<div class="col-lg-6 col-sm-6 col-m-6 col-xs-12">
						<div class="form-group">
							<label for="name">Estado</label>
							<input type="text" disabled name="estado" maxlength="50" required value="{{$reservaciones->estado}}" class="form-control" placeholder="Ingrese el Estado">
						</div>

					</div>
					<div class="col-lg-6 col-sm-6 col-m-6 col-xs-12">
						<div class="form-group">
							<label for="">Estado</label>
							<select name="estado2" class="form-control" data-live-search="true">
								<option value="">Eliga una opcion</option>
								<option value="Espera">Espera</option>
								<option value="Aprobado">Aprobado</option>
								<option value="Recepcionado">Recepcionado</option>
								<option value="Anulado">Anulado</option>
							</select>
						</div>
						
						<div class="form-group" hidden="">	
						</div>

						
					</div>
					<div class="col-lg-10 col-md-8 col-sm-8 col-xs-12" hidden="">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-condensed table-hover">

								<thead>
									<th>Medio</th>
									<th>Cantidad</th>
									<th>Stock</th>
									<th>Marca</th>
									<th>Color</th>
									<th>Descripcion</th>
									<th>Capacidad</th>
									<th>Foto</th>
								</thead>
								@foreach ($detalles as $d)
								<tr>

									<td>{{ $d->nombre}}</td>
									<td>{{ $d->cantidad}}</td>
									<td>{{ $d->stock}}</td>
									<td>{{ $d->marca}}</td>
									<td>{{ $d->color}}</td>
									<td>{{ $d->descripcion}}</td>
									<td>{{ $d->capacidad}}</td>
									<td>
										<img src="{{asset('imagenes/medios/'.$d->foto)}}" alt="{{ $d->nombre}}" height="100px" width="100px" class="img-thumbail">
									</td>

								</tr>

								@endforeach

							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Confirmar</button>
					<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
				</div>
			</div>
		</div>

		{{Form::close()}}
	</div>

	@push ('scripts')
	<script>
		(document).ready(function(){
			$('#bt_add').click(function(){
				agregar();

			});
		});

		var cont=0;

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
		medio=$('#medio').text();
		cantidad=$('#pcantidad').val();
		stock=$('#pstock').val();




		var fila='<tr class="selected" id="fila' +cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="medio_id[]" value="'+medio_id+'">'+medio+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td></tr>';
		cont++;
		limpiar();
		evaluar();

		$('#detalles').append(fila);
	}

	function limpiar()
	{
		$("#pcantidad").val("");
		$("#pmedio").val("");
		$("#detalle").val("");
		//$("#pprecio_venta").val("");
	}

</script>
@endpush
