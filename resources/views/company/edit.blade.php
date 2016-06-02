@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
  @if(session()->has('message'))
  <span class="alert alert-success">
  {{session('message')}}
  </span>
  @endif
	<h2>Edicion de Empresa</h2>
    <div class="page-hader">
        <div class="panel panel-default">

  			<div class="panel-heading">Datos</div>
  			<div class="panel-body">
	        	{!! Form::open(array('id'=>'formEmpresa','route' => ['company-update',$company->id],'method'=>'PATCH')) !!}
	        		<div class="row">
	        			<h4>
		        		{!! Form::label('rut', 'Rut',array('class' => 'label label-default col-md-2')); !!}
					      {!! Form::text('rut',$company->rut,array('id'=>'rut','class'=>'col-md-2 campoIngreso')); !!}
                @if($errors->any('rut'))
                <span class="alert alert-danger">
                {{$errors->first('rut')}}
                </span>
                @endif
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('name', 'Nombre',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('name',$company->name,array('id'=>'name','class'=>'col-md-2 campoIngreso')); !!}
              @if($errors->any('name'))
              <span class="alert alert-danger">
              {{$errors->first('name')}}
              </span>
              @endif
					    </h4>
				    </div>

				    <div class="row">
	        			<h4>
		        		{!! Form::label('phone', 'Telefono',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('phone',$company->phone,array('id'=>'phone','class'=>'col-md-2 campoIngreso')); !!}
              @if($errors->any('phone'))
              <span class="alert alert-danger">
                {{$errors->first('phone')}}
              </span>
              @endif
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('email', 'Email',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::email('email',$company->email,array('id'=>'email','class'=>'col-md-2 campoIngreso')); !!}
              @if($errors->any('email'))
              <span class="alert alert-danger">
                {{$errors->first('email')}}
              </span>
              @endif
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('amount', 'Monto Cobertura(U.F.)',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('amount',$company->amount,array('id'=>'amount','class'=>'col-md-2 campoIngreso')); !!}
              @if($errors->any('amount'))
              <span class="alert alert-danger">
                {{$errors->first('amount')}}
              </span>
              @endif
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('benefit', 'Porcentaje Cobertura(%)',array('class' => 'label label-default col-md-2')); !!}
					      {!! Form::text('benefit',$company->benefit,array('id'=>'benefit','class'=>'col-md-2 campoIngreso')); !!}
                @if($errors->any('benefit'))
                <span class="alert alert-danger">
                  {{$errors->first('benefit')}}
                </span>
                @endif
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('month', 'Mes Cambio Cobertura',array('class' => 'label label-default col-md-2')); !!}

					      {!! Form::select('month', $months, $company->month, array('id'=>'month','class'=>'col-md-2 campoIngreso') ); !!}
                @if($errors->any('month'))
                <span class="alert alert-danger">
                  {{$errors->first('month')}}
                </span>
                @endif
					    </h4>
				    </div>
				    <div class="row">
				    	<h4>
				    		{!! Form::submit('Guardar',array('id'=>'guardar','class'=>'btn-success')); !!}
				    	</h4>
				    </div>
				{!! Form::close() !!}
			</div>
        </div>
    </div>
</div>
<template id="modalTemplate">
	<div class="modal fade bs-example-modal-lg" id="modal-confirmation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Sistema Clinica</h4>
	      </div>
	      <div class="modal-body">
	        <p>:MENSAJE</p>
	      </div>

	    </div>
	  </div>
	</div>
</template>
@endsection

@section('scripts')

<script src="{{ asset('js/editCompany.js')}}"></script>

@endsection
