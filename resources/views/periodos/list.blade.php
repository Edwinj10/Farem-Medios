<table class="table table-bordred table-striped table-hover ">
	<thead>

		<th>Nombre</th>
		<th>Hora Inicio</th>
		<th>Hora Fin</th>
		<th>Editar</th>
		<!-- <th>Borrar</th> -->
	</thead>
	<tbody>
		<tr>
			@foreach ($periodos as $p)
			<td>{{ $p->nombre}}</td>
			<td>{{ $p->hora_inicio}}</td>
			<td>{{ $p->hora_fin}}</td>
			<td><p onclick='Mostrar({{$p->id}});'   data-placement="top" data-toggle="tooltip" title="Edit"><button  class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
			<!-- <td><p onclick='Eliminar({{$p->id}});' data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
 -->

		</tr>
		@endforeach
	</tbody>


</table>

<div class="clearfix"></div>
<ul class="pagination pull-right">
	{{$periodos->render()}}
</ul>


