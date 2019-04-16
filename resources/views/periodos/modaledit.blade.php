<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Editar Periodos</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['id' => 'form']) !!}
				<input type="hidden" name="_token" value="{{csrf_token() }}" id="token">
				<input type="hidden" id="id">

				<div class="form-group">
					<label>Nombre:</label>
					<input class="form-control" placeholder="Nombre" name="nombreedit" id="nombreedit" required="">
				</div>
				<div class="form-group">
					<label>Hora Inicio:</label>
					<input class="form-control" type="time" name="hora_inicioedit" id="hora_inicioedit" required="" >
				</div>
				<div class="form-group">
					<label>Hora Fin:</label>
					<input class="form-control" type="time" name="hora_finedit" id="hora_finedit" required="" step="3600">
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