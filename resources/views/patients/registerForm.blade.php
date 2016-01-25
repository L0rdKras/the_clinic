@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Registro de Pacientes</h2>
    <div class="page-hader">
        <div class="panel panel-default">

  			<div class="panel-heading">Datos</div>
  			<div class="panel-body">
	        	{!! Form::open(array('url' => 'foo/bar')) !!}
	        		<div class="row">
	        			<h4>
		        		{!! Form::label('rut', 'Rut',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('rut',null,array('id'=>'patient_rut','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('firstName', 'Nombres',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('firstName',null,array('id'=>'firstname','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('lastName', 'Apellidos',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('lastName',null,array('id'=>'lastname','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('patientAddress', 'Direccion',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('patientAddress',null,array('id'=>'patient_address','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('patientPhone', 'Telefono',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('patientPhone',null,array('id'=>'patient_phone','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('patientEmail', 'Email',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::email('patientEmail',null,array('id'=>'patient_email','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('patientType', 'Tipo',array('class' => 'label label-default col-md-2')); !!}
		        		{!! Form::select('patientType', array('' => '', 'Titular' => 'Titular', 'Carga' => 'Carga')); !!}
					    </h4>
				    </div>
				{!! Form::close() !!}
			</div>
        </div>
    </div>
</div>
@endsection