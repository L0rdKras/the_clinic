@foreach($companys as $company)
	<tr class="detalleBusqueda" data-id="{{$company->id}}" data-name="{{$company->name}}">
		<td>{{$company->name}}</td>
		<td>{{$company->rut}}</td>
		<td>
			<a class="btn btn-info botonElijeEmpresa" href="#">Carga</a>
		</td>
	</tr>
@endforeach