@extends('layouts.admin')

@section('content')

<br><br>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Nombre del Usuario:</label>
        <input class="form-control" name="name" id="name"  required value="{{$i->name}} {{$i->apellido}}">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Fecha:</label>
        <input class="form-control" name="fecha" id="fecha" type="date" required value="{{$i->fecha}}">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Estado:</label>
        <input class="form-control" name="estado" id="estado" required value="{{$i->estado}}">
      </div>
    </div>  
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Detalle:</label>
        <!-- <textarea class="form-control" rows="3" name="detalle" id="detalle"></textarea> -->
        <input class="form-control" placeholder="Detalle" name="detalle" id="detalle" required value="{{$i->detalle}}">

      </div>
    </div>
  </div>
  <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">

        <thead>
          <th>Medio</th>
          <th>Cantidad</th>
          <th>Marca</th>
          <th>Color</th>
          <th>Descripcion</th>
          <th>Capacidad</th>
          <th>Foto</th>
        </thead>
        @foreach ($detalles as $d)
        <tr>

          <td>{{ $d->nombre}}</td>
          <td>{{ $d->cantidad}}</td>
          <td>{{ $d->marca}}</td>
          <td>{{ $d->color}}</td>
          <td>{{ $d->descripcion}}</td>
          <td>{{ $d->capacidad}}</td>
          <td>
            <img src="{{asset('imagenes/medios/'.$d->foto)}}" alt="{{ $d->nombre}}" height="100px" width="100px" class="img-thumbail">
          </td>
          
        </tr>
        
        @endforeach
      </table>
    </div>
  </div>
</div>


@endsection