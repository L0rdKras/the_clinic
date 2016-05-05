@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
    <h1>Editar Paciente</h1>
    <div class="panel panel-default">

		<div class="panel-heading">Datos</div>
		<div class="panel-body">
        	{!! Form::open(array('id'=>'formPatient','route' => ['guarda-empresa'],'method'=>'POST')) !!}
       
        		{!! Form::hidden('dataToSave',$dataToSave,array('id'=>'dataToSave')) !!}

        		<div class="row">
        			<h4>
	        		{!! Form::label('rut', 'Rut',array('class' => 'label label-default col-md-2')); !!}
				    {!! Form::text('rut',$patient->rut,array('id'=>'rut','class'=>'col-md-2 campoIngreso')); !!}
				    </h4>
			    </div>
			    <div class="row">
        			<h4>
	        		{!! Form::label('firstname', 'Nombres',array('class' => 'label label-default col-md-2')); !!}
				    {!! Form::text('firstname',$patient->firstname,array('id'=>'firstname','class'=>'col-md-2 campoIngreso')); !!}
				    </h4>
			    </div>
			    <div class="row">
        			<h4>
	        		{!! Form::label('lastname', 'Apellidos',array('class' => 'label label-default col-md-2')); !!}
				    {!! Form::text('lastname',$patient->lastname,array('id'=>'lastname','class'=>'col-md-2 campoIngreso')); !!}
				    </h4>
			    </div>
			    <div class="row">
        			<h4>
	        		{!! Form::label('address', 'Direccion',array('class' => 'label label-default col-md-2')); !!}
				    {!! Form::text('address',$patient->address,array('id'=>'address','class'=>'col-md-2 campoIngreso')); !!}
				    </h4>
			    </div>
			    <div class="row">
        			<h4>
	        		{!! Form::label('phone', 'Telefono',array('class' => 'label label-default col-md-2')); !!}
				    {!! Form::text('phone',$patient->phone,array('id'=>'phone','class'=>'col-md-2 campoIngreso')); !!}
				    </h4>
			    </div>
			    <div class="row">
        			<h4>
	        		{!! Form::label('email', 'Email',array('class' => 'label label-default col-md-2')); !!}
				    {!! Form::email('email',$patient->email,array('id'=>'email','class'=>'col-md-2 campoIngreso')); !!}
				    </h4>
			    </div>
			    <div class="row">
        			<h4>
	        		{!! Form::label('type', 'Tipo',array('class' => 'label label-default col-md-2')); !!}
	        		{!! Form::select('type', array('' => '', 'Titular' => 'Titular', 'Carga' => 'Carga') , $patient->type, array('id'=>'type','class'=>'col-md-2 campoIngreso')); !!}
				    </h4>
			    </div>
			    <div id="complementaryData" class="row">
			    	@if($patient->type==='Titular')
			    	<h4>
						<button id="btnSelectCompany" class="btn btn-default">Selecciona Empresa</button>
					</h4>
					<div id='dataEmpresa'><h3><label class='label label-info'>Empresa a la que Pertenece: {{$patient->Company->name}}</label></h3><input type='hidden' id='idEmpresaTitular' value='{{$patient->Company->id}}' /><h3><button class='btn btn-success' id='btn-guarda-titular'>Guardar</button></h3></div>
			    	@endif
			    </div>
			{!! Form::close() !!}
		</div>
    </div>
</div>

	<div class="modal fade" id="modal_buscar">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="TituloModal">:TITULO</h4>
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

{!! Form::open(array('route' => ['show-companys-patients'],'id'=>'formCompanys','method'=>'GET')) !!}
{!! Form::close() !!}
{!! Form::open(array('route' => ['show-incumbents-patients'],'id'=>'formIncumbents','method'=>'GET')) !!}
{!! Form::close() !!}
@endsection