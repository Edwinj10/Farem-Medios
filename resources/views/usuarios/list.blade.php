<table class="table table-bordred table-striped table-hover ">
	<thead>

		<th>Nombre</th>
		<th>Apellido</th>
		<th>Correo</th>
		<th>Estado</th>
		<th>Tipo</th>
		<th>Editar</th>
		<th>Borrar</th>
	</thead>
	<tbody>
		<tr>
			@foreach ($usuarios as $u)
			<td>{{ $u->name}}</td>
			<td>{{ $u->apellido}}</td>
			<td>{{ $u->email}}</td>
			<td>{{ $u->estado}}</td>
			<td>{{ $u->tipo}}</td>
			<td><p onclick='Mostrar({{$u->id}});'   data-placement="top" data-toggle="tooltip" title="Edit"><button  class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
			<td><p onclick='Eliminar({{$u->id}});' data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>


		</tr>
		@endforeach
	</tbody>


</table>

<div class="clearfix"></div>
<ul class="pagination pull-right">
	{{$usuarios->render()}}
</ul>


