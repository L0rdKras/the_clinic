@foreach($incumbents as $incumbent)
	<tr class="detalleBusqueda" data-id="{{$incumbent->id}}" data-name="{{$incumbent->name}}">
		<td>{{$incumbent->firstname}} {{$incumbent->lastname}}</td>
		<td>{{$incumbent->rut}}</td>
		<td>
			<a class="btn btn-info botonElijeTitular" href="#">Carga</a>
		</td>
	</tr>
@endforeach