@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Registro de Pacientes</h2>
    <div class="page-hader">
        <div class="panel panel-default">

  			<div class="panel-heading">Datos</div>
  			<div class="panel-body">
	        	{!! Form::open(array('id'=>'formPatient','route' => ['guarda-empresa'],'method'=>'POST')) !!}
	        		{!! Form::hidden('dataToSave','null',array('id'=>'dataToSave')) !!}
	        		<div class="row">
	        			<h4>
		        		{!! Form::label('rut', 'Rut',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('rut',null,array('id'=>'rut','class'=>'col-md-2')); !!}
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
		        		{!! Form::label('address', 'Direccion',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('address',null,array('id'=>'address','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('phone', 'Telefono',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('phone',null,array('id'=>'phone','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('email', 'Email',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::email('email',null,array('id'=>'email','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('type', 'Tipo',array('class' => 'label label-default col-md-2')); !!}
		        		{!! Form::select('type', array('' => '', 'Titular' => 'Titular', 'Carga' => 'Carga')); !!}
					    </h4>
				    </div>
				    <div id="complementaryData" class="row"></div>
				{!! Form::close() !!}
			</div>
        </div>
    </div>
</div>

	<div class="modal fade" id="modal_buscar">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Busca Empresa</h4>
	      </div>
	      
	      <div class="modal-body" style="height:300px; overflow:auto" id="ver_articulos">
	        <table class="table table-striped" id="tablaResultado">
	            <thead>
	              <tr>
	                <th>Nombre</th>
	                <th>RUT</th>
	                <th>Sel.</th>
	              </tr>
	            </thead>
	            
	        </table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div>

<template id="isIncumbent">
	<h4>
		<button id="btnSelectCompany" class="btn btn-default">Selecciona Empresa</button>
	</h4>
</template>
<template id="isBurden">
	<h4>
		<button id="btnSelectIncumbent" class="btn btn-default">Selecciona Titular</button>
	</h4>
</template>

{!! Form::open(array('route' => ['show-companys-patients'],'id'=>'formCompanys','method'=>'GET')) !!}
{!! Form::close() !!}
{!! Form::open(array('route' => ['show-incumbents-patients'],'id'=>'formIncumbents','method'=>'GET')) !!}
{!! Form::close() !!}
{!! Form::open(array('route' => ['save-incumbents-patients'],'id'=>'formSaveIncumbents','method'=>'POST')) !!}
{!! Form::close() !!}

@endsection

@section('scripts')

<script src="{{ asset('js/registerPatient.js')}}"></script>

@endsection