<table class="table table-bordred table-striped table-hover ">
	<thead>

		<th>Nombre</th>
		<th>Descripcion</th>
		<th>Marca</th>
		<th>Color</th>
		<th>Capacidad</th>
		<th>Stock</th>
		<th>Estado</th>
		<th>Foto</th>
		<th>Departamento</th>
		<th>Editar</th>
		<th>Borrar</th>
	</thead>
	<tbody>
		<tr>
			@foreach ($medios as $m)
			<td>{{ $m->nombre}}</td>
			<td>{{ $m->descripcion}}</td>
			<td>{{ $m->marca}}</td>
			<td>{{ $m->color}}</td>
			<td>{{ $m->capacidad}}</td>
			<td>{{ $m->stock}}</td>
			<td>{{ $m->estado}}</td>
			<td><img src="{{asset('imagenes/medios/'.$m->foto)}}" alt="{{ $m->nombre}}" height="100px" width="100px" class="img-thumbail">
			</td>
			<td>{{ $m->departamento}}</td>
			<td><p onclick='Mostrar({{$m->id}});'   data-placement="top" data-toggle="tooltip" title="Edit"><button  class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
			<td><p onclick='Eliminar({{$m->id}});' data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
		</tr>
		@endforeach
	</tbody>


</table>

<div class="clearfix"></div>
<ul class="pagination pull-right">
	{{$medios->render()}}
</ul>


