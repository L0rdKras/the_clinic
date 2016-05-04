@extends('layout')

@section('content')
{!! Form::open(array('route' => ['confirm-budget',':ID'],'id'=>'formConfirmBudget','method'=>'POST')) !!}
{!! Form::close() !!}
{!! Form::open(array('route' => ['cancel-budget',':ID'],'id'=>'formCancelBudget','method'=>'POST')) !!}
{!! Form::close() !!}
<div class="container theme-showcase" style="padding-top:80px" role="main">
    <h1>Presupuesto</h1>
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h3>Datos Paciente</h3>
    	</div>
    	<div class="panel-body">
    		<h4 class="row">
    			<label for="" class="label label-default col-md-3">
    				Nombre
    			</label>
    			<span class="col-md-3">
    				{{$budget->Patient->firstname}} {{$budget->Patient->lastname}}
    			</span>
    			<label for="" class="label label-default col-md-3">
    				Empresa
    			</label>
    			<span class="col-md-3">
    				{{$budget->Company->name}}
    			</span>
    		</h4>
    		<h4 class="row">
    			<label for="" class="label label-default col-md-3">
    				Telefono
    			</label>
    			<span class="col-md-3">
    				{{$budget->Patient->phone}}
    			</span>
    			<label for="" class="label label-default col-md-3">
    				Email
    			</label>
    			<span class="col-md-3">
    				{{$budget->Patient->email}}
    			</span>
    		</h4>
    	</div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h3>Datos Presupuesto</h3>
    	</div>
    	<div class="panel-body">
    		<h4 class="row">
    			<label for="" class="label label-default col-md-3">
    				Profecional
    			</label>
    			<span class="col-md-3">
    				{{$budget->Medic->name}}
    			</span>
    			<label for="" class="label label-default col-md-3">
    				Fecha
    			</label>
    			<span class="col-md-3">
    				{{date_format($budget->created_at,'d-m-Y')}}
    			</span>
    		</h4>
    		<h4 class="row">
    			<label for="" class="label label-default col-md-3">
    				Monto Atenciones
    			</label>
    			<span class="col-md-3">
    				{{$budget->total_atentions}}
    			</span>
    			<label for="" class="label label-default col-md-3">
    				Descuento Empresa
    			</label>
    			<span class="col-md-3">
    				{{$budget->discount}}
    			</span>
    		</h4>
    		<h4 class="row">
    			<label for="" class="label label-default col-md-3">
    				Total a Pagar
    			</label>
    			<span class="col-md-3">
    				{{$budget->total}}
    			</span>
    			<label for="" class="label label-default col-md-3">
    				Estado
    			</label>
    			<span class="col-md-3">
    				{{$budget->status}}
    			</span>
    		</h4>
    		@if($budget->status == 'Pendiente')
    		<h4 class="row">
    			<a href="" class="btn btn-warning col-md-6" id="btn-acepta" data-id="{{$budget->id}}">
    				Confirma Realizacion
    			</a>
    			<a href="" class="btn btn-danger col-md-6" id="btn-anula" data-id="{{$budget->id}}">
    				No Se Realizara
    			</a>
    		</h4>
    		@endif
    	</div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h3>Detalle Presupuesto</h3>
    	</div>
    	<div class="panel-body">
    		<table class="table table-hover">
    			<thead>
    				<tr>
    					<th>Atencion</th>
    					<th>Costo</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($budget->BudgetDetails as $detail)
    				<tr>
    					<th>{{$detail->Atention->name}}</th>
    					<th>{{$detail->price}}</th>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/budget.js')}}"></script>
@endsection