<table class="table table-bordred table-striped table-hover ">
	<thead>

		<th>Fecha</th>
		<th>Usuario</th>
		<th>Estado</th>
		<th>Detalles</th>
		<th>Anular</th>
	</thead>
	<tbody>
		<tr>
			@foreach ($ingresos as $i)
			<td>{{ $i->fecha}}</td>
			<td>{{ $i->name}}</td>
			<td>{{ $i->estado}}</td>
			<td><p onclick='Mostrar({{$i->in}});'   data-placement="top" data-toggle="tooltip" title="Edit"><button  class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#modal-show" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
			<td><a href="{{ route('ingresos.show', $i->in ) }}"><button class="btn btn-danger btn-xs" data-title="Delete"  ><span class="glyphicon glyphicon-trash"></span></button></a></td>
		</tr>
		@endforeach
	</tbody>


</table>

<div class="clearfix"></div>
<ul class="pagination pull-right">
	{{$ingresos->render()}}
</ul>


