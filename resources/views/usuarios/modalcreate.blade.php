<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Crear Usuario</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['id' => 'form']) !!}
				<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
				<input type="hidden" id="id">

				<div class="form-group">
					<label>Nombre:</label>
					<input class="form-control" placeholder="Nombre" name="name" id="name">
				</div>
				<div class="form-group">
					<label>Apellido:</label>
					<input class="form-control" placeholder="Apellido" name="apellido" id="apellido">
				</div>
				<div class="form-group">
					<label>Email:</label>
					<input class="form-control" placeholder="Email" name="email" id="email">
				</div>
				<div class="form-group">
					<label>Tipo:</label>
					<!-- <input class="form-control" placeholder="Tipo" name="tipo" id="tipo"> -->
					<select name="tipo" class="form-control selectpicker" data-live-search="true" id="tipo">
						<option value="Usuario">Usuario</option>
						<option value="Administrador">Administrador</option>
					</select>
				</div>
				<div class="form-group">
					<label>Estado:</label>
					<!-- <input class="form-control" placeholder="Estado" name="estadoedit" id="estadoedit"> -->
					<select name="estado" class="form-control selectpicker" data-live-search="true" id="estado">
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
					</select>
				</div>
				<div class="form-group">
					<label>Contraseña:</label>
					<input class="form-control" placeholder="Password" name="password" id="password">
				</div>
				<div class="form-group">
					<input style="margin-left:20px;" type="checkbox" id="mostrar_contrasena" title="clic para mostrar contraseña"/>
				&nbsp;&nbsp;Mostrar Contraseña</div>
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