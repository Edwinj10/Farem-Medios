


<div class="modal fade" id="edit"" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Editar Medio</h4>
			</div>
			<div class="modal-body">
				<div id="message" class="alert alert-danger danger" role="alert" style="display: none ">
					<strong id="error">	
						Hay campos que estan vacios
						
					</strong>
				</div>


				{!! Form::open(['id' => 'form','enctype'=>'multipart/form-data'] ) !!}
				<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
				<input type="hidden" id="id">

				<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
				<input type="hidden" id="id">

				<div class="form-group">
					<label>Nombre:</label>
					<input class="form-control" placeholder="Nombre" name="nombreedit" id="nombreedit" required="">
				</div>
				<div class="form-group">
					<label>Descripcion:</label>
					<input class="form-control" placeholder="Descripcion" name="descripcionedit" id="descripcionedit" required="">
				</div>
				<div class="form-group">
					<label>Marca:</label>
					<input class="form-control" placeholder="Marca" name="marcaedit" id="marcaedit" required="">
				</div>
				<div class="form-group">
					<label>Color:</label>
					<input class="form-control" placeholder="Color" name="coloredit" id="coloredit" required="">
				</div>
				<div class="form-group">
					<label>Capacidad:</label>
					<input class="form-control" placeholder="Capacidad" name="capacidadedit" id="capacidadedit" required="">
				</div>
				<div class="form-group">
					<label>Estado:</label>
					<input class="form-control" placeholder="Estado" name="estadoedit" id="estadoedit" required="">
				</div>
				<div class="form-group">
					<label>Departamento:</label>
					<input class="form-control" placeholder="Departamento" name="departamentoedit" id="departamentoedit" required="">
				</div>
				<div class="modal-footer ">
					{!!link_to('##', $title='Actualizar',$attributes = ['id' => 'actualizar', 'class' => 'btn btn-primary'])!!}

				</div>
				{{Form::close()}}
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>