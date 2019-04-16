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
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Confirmar</button>
				</div>
			</div>
		</div>

		{{Form::close()}}
	</div>