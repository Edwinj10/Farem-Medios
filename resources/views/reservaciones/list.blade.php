<table class="table table-bordred table-striped table-hover ">
	<thead>

		<th>Aula</th>
		<th>Carrera</th>
		<th>Turno</th>
		<th>Hora Inicio</th>
		<th>Hora Fin</th>
		<th>Fecha</th>
		<th>Usuario</th>
		<th>Estado</th>
		<th>Detalles</th>
	</thead>
	<tbody>
		<tr>
			@foreach ($reservaciones as $r)
			<td>{{ $r->aula}}</td>
			<td>{{ $r->carrera}}</td>
			<td>{{ $r->turno}}</td>
			<td>{{ $r->hora_inicio}}</td>
			<td>{{ $r->hora_fin}}</td>
			<td>{{ $r->fecha}}</td>
			<td>{{ $r->name}}</td>
			<td>{{ $r->estado}}</td>
			<td>
				<a class="btn btn-default" href="{{ route ('reservaciones.show',[$r->in])}}"><em class="fa fa-pencil"></em></a>
			</td>
		</tr>


		

		@endforeach
	</tbody>


</table>


<div class="clearfix"></div>
<ul class="pagination pull-right">
	{{$reservaciones->render()}}
</ul>


