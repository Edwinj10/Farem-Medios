<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Crear Medio</h4>
			</div>
			<div class="modal-body">
				<form action="{{ route('medios.store') }}" enctype="multipart/form-data" method="POST">
					<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
					<input type="hidden" id="id">

					<div class="form-group">
						<label>Nombre:</label>
						<input class="form-control" placeholder="Nombre" name="nombre" id="nombre" required="">
					</div>
					<div class="form-group">
						<label>Descripcion:</label>
						<input class="form-control" placeholder="Descripcion" name="descripcion" id="descripcion" required="">
					</div>
					<div class="form-group">
						<label>Marca:</label>
						<input class="form-control" placeholder="Marca" name="marca" id="marca">
					</div>
					<div class="form-group">
						<label>Color:</label>
						<input class="form-control" placeholder="Color" name="color" id="color" >
					</div>
					<div class="form-group">
						<label>Stock:</label>
						<input class="form-control" placeholder="Color" name="stock" id="stock" required="" value="0">
					</div>
					<div class="form-group">
						<label>Departamento:</label>
						<input class="form-control" placeholder="Departamento" name="departamento" id="departamento" required="">
					</div>
					<div class="form-group">
						<label>Capacidad:</label>
						<input class="form-control" placeholder="Capacidad" name="capacidad" id="capacidad"  value="0">
					</div>
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

