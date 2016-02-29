@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Registro de Profecionales</h2>
    <div class="page-hader">
        <div class="panel panel-default">

  			<div class="panel-heading">Datos</div>
  			<div class="panel-body">
	        	{!! Form::open(array('id'=>'formProfecionales','route' => ['guarda-profecional'],'method'=>'POST')) !!}
	        		<div class="row">
	        			<h4>
		        		{!! Form::label('name', 'Nombre',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('name',null,array('id'=>'name','class'=>'col-md-2 campoIngreso')); !!}
					    </h4>
				    </div>
				    
				    <div class="row">
	        			<h4>
		        		{!! Form::label('speciality', 'Especialidad',array('class' => 'label label-default col-md-2')); !!}
					    
					    {!! Form::select('speciality', array(''=>'','Odontologo'=>'Odontologo','Higienista'=>'Higienista'), null, array('id'=>'speciality','class'=>'col-md-2 campoIngreso') ); !!}
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

<script src="{{ asset('js/registerMedic.js')}}"></script>

@endsection