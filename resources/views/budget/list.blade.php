@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
    <h1>Lista de Presupuestos</h1>
    <div class="panel panel-default">
    	<div class="panel-body">
    		<table class="table table-hover">
    			<thead>
    				<tr>
    					<th>Numero</th>
    					<th>Fecha</th>
    					<th>Estado</th>
    					<th></th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($budgets as $budget)
    				<tr>
    					<th>{{$budget->id}}</th>
    					<th>{{date_format($budget->created_at,'d-m-Y')}}</th>
    					<th>{{$budget->status}}</th>
    					<th><a href="{{route('show-budget',$budget->id)}}" class="btn btn-info">Ver</a></th>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
    		{!! $budgets->render() !!}
    	</div>
    </div>
</div>
@endsection