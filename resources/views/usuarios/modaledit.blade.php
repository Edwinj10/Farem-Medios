<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Editar Usuario</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['id' => 'form']) !!}
				<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
				<input type="hidden" id="id">

				<div class="form-group">
					<label>Nombre:</label>
					<input class="form-control" placeholder="Nombre" name="nameedit" id="nameedit" required="">
				</div>
				<div class="form-group">
					<label>Telefono:</label>
					<input class="form-control" placeholder="Apellido" name="apellidoedit" id="apellidoedit" required="">
				</div>
				<div class="form-group">
					<label>Email:</label>
					<input class="form-control" placeholder="Email" name="emailedit" id="emailedit" required="">
				</div>
				<div class="form-group">
					<label>Tipo:</label>
					
					<input class="form-control" placeholder="Estado" name="tipoedit" id="tipoedit">
					
					<div class="form-group">
						<label>Estado:</label>
						<input class="form-control" placeholder="Estado" name="estadoedit" id="estadoedit">
					<!-- select class="form-control">
						<option ></option>
						<option>Administrador</option>
						<option>Usuario</option>
						
					</select> -->
				</div>
			</div>
			<div class="modal-footer ">
				{!!link_to('##', $title='Actualizar',$attributes = ['id' => 'actualizar', 'class' => 'btn btn-primary'])!!}
			</div>
			{!!Form::close()!!}
		</div>
		<!-- /.modal-content --> 
	</div>
	<!-- /.modal-dialog --> 
</div>