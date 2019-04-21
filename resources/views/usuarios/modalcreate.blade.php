<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Crear Usuario</h4>
			</div>
			<div id="message-error" class="alert alert-danger danger" role="alert" style="display: none ">
				<strong id="error"></strong>
				Posibles errores:
				<br>	Hay campos obligatorios que estan vacios
				<br>	El campo email no corresponde con una direccion de e-mail valida
				<br>	El campo imagen no tiene un formato valido
			</div>
			<div class="modal-body">
				<form action="{{ route('usuarios.store') }}" enctype="multipart/form-data" method="POST">
					<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
					<input type="hidden" id="id">

					<div class="form-group">
						<label>Nombre:</label>
						<input class="form-control" placeholder="Nombre" name="name" id="name" required="">
					</div>
					<div class="form-group">
						<label>Apellidos:</label>
						<input class="form-control" placeholder="Apellidos" name="apellido" id="apellido" required="">
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input class="form-control" placeholder="Email" name="email" id="email" required="">
					</div>
					<div class="form-group">
						<label>Tipo:</label>
						<!-- <input class="form-control" placeholder="Tipo" name="tipo" id="tipo"> -->
						<select name="tipo" class="form-control selectpicker" data-live-search="true" id="tipo">
							<option value="Usuario">Usuario</option>
							<option value="Administrador">Administrador</option>
							<option value="SuperAdmin">SuperAdministrador</option>
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
						<input class="form-control" placeholder="Password" name="password" id="password" required="">
					</div>
					<div class="form-group">
						<input style="margin-left:20px;" type="checkbox" id="mostrar_contrasena" title="clic para mostrar contraseña"/>
					&nbsp;&nbsp;Mostrar Contraseña</div>
					<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
						<div class="form-group">
							<label>Foto:</label>
							<input type="file" id="addfotoarea" name="foto" class="form-control">

							<output id="list"></output>
						</div>
					</div>
					<div class="modal-footer ">
						<button class="btn btn-success upload-image" type="submit">Guardar</button>
						
					</div>
				</form>

			</div>		
		</div>
		<!-- /.modal-content --> 
	</div>
	<!-- /.modal-dialog --> 
</div>

