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
			<td><a class="btn btn-default" href="{{ route ('ingresos.show',[$i->in])}}"><em class="fa fa-pencil"></em></a>
			</td>
			<td><p onclick='Eliminar({{$i->in}});' data-placement="top" data-toggle="tooltip" title="Anular"><button class="btn btn-danger btn-xs" data-title="Anular" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
			
		</tr>

		@endforeach
	</tbody>


</table>


<div class="clearfix"></div>
<ul class="pagination pull-right">
	{{$ingresos->render()}}
</ul>


