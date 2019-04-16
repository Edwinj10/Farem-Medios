<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Crear Periodo</h4>
			</div>
			
			<div class="modal-body">
				<div id="message" class="alert alert-danger danger" role="alert" style="display: none ">
					<strong id="errors">	
						Hay campos que estan vacios
						<br>	
					</strong>
				</div>
				{!! Form::open(['id' => 'form']) !!}
				<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
				<input type="hidden" id="id">

				<div class="form-group">
					<label>Nombre:</label>
					<select name="nombre" id="nombre" class="form-control selectpicker" data-live-search="true">
						<option value="Matutino">Matutino</option>
						<option value="Vespertino">Vespertino</option>
						<option value="Nocturno">Nocturno</option>
						<option value="Sabatino">Sabatino</option>
						<option value="Dominical">Dominical</option>
					</select>
				</div>
				<div class="form-group">
					<label>Hora Inicio:</label>
					<input class="form-control" type="time" name="hora_inicio" id="hora_inicio" value="08:00" required="" >
				</div>
				<div class="form-group">
					<label>Hora Fin:</label>
					<input class="form-control" type="time" name="hora_fin" id="hora_fin" value="09:45" required="" >
				</div>
			</div>
		</div>
		<div class="modal-footer ">
			{!!link_to('##', 'Grabar', ['id' => 'GrabarE', 'class' => 'btn btn-primary'])!!}
		</div>
		{!!Form::close()!!}
	</div>
	<!-- /.modal-content --> 
</div>
<!-- /.modal-dialog --> 
</div>