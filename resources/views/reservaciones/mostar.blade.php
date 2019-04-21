<label for="">Turnos:</label>
<select name="turnos" class="form-control" id="turnos">
	<option value=""></option>
	@foreach ($periodos as $p)
	<option value="{{$p->turno2}}">{{$p->turno2}}</option>
	@endforeach
</select>