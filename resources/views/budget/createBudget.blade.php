@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Presupuesto</h2>
    <div class="page-hader">
	    {!! Form::open(array('id'=>'formDummy','method'=>'POST')) !!}
		<input type="hidden" id="rutaListaPacientes" value="{{route('lista-todos-pacientes')}}">
		<input type="hidden" id="rutaListaAtenciones" value="{{route('lista-todas-atenciones')}}">
		<input type="hidden" id="rutaListaProfecionales" value="{{route('lista-todos-profecionales')}}">
        <div class="panel panel-default">

  			<div class="panel-heading">Paciente</div>
  			<div class="panel-body">

        		<div class="row">
        			<h4>
	        		   <a href="#" id="btnSearchPatient" class="btn btn-primary">Buscar Paciente</a>
				    </h4>
			    </div>
			</div>
        </div>
        <div class="panel panel-default">

  			<div class="panel-heading">Profecional</div>
  			<div class="panel-body">

        		<div class="row">
        			<h4>
	        		   <a href="#" id="btnSearchMedic" class="btn btn-primary">Buscar Profecional</a>
				    </h4>
			    </div>		    
			</div>
        </div>

        <div class="panel panel-default">

  			<div class="panel-heading">Detalle Atenciones</div>
  			<div class="panel-body">

        		<div class="row">
        			<h4>
	        		   <a href="#" id="btnSearchAtention" class="btn btn-primary">+ Atencion</a>
				    </h4>
			    </div>		    
			    <div class="row">
			    	<h4>
			    		{!! Form::submit('Guardar',array('id'=>'guardar','class'=>'btn btn-success')); !!}
			    	</h4>
			    </div>
			</div>
        </div>
		{!! Form::close() !!}
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

<template id="tablaMostrarPacientes">
	<div style="height:400px; overflow:auto;">
		<table class="table table-hover table-bordered" id="tablaElejirPaciente">
			<thead>
				<tr>
					<th>RUT</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Carga</th>
				</tr>
			</thead>
			<tbody>
				<tr><td>:DATAPACIENTES</td></tr>
			</tbody>
		</table>
		
	</div>
</template>

<template id="tablaMostrarAtenciones">
	<div style="height:400px; overflow:auto;">
		<table class="table table-hover table-bordered" id="tablaElejirAtenciones">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Carga</th>
				</tr>
			</thead>
			<tbody>
				<tr><td>:DATAATENCIONES</td></tr>
			</tbody>
		</table>
		
	</div>
</template>

<template id="tablaMostrarProfecionales">
	<div style="height:400px; overflow:auto;">
		<table class="table table-hover table-bordered" id="tablaElejirProfecionales">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Especialidad</th>
					<th>Carga</th>
				</tr>
			</thead>
			<tbody>
				<tr><td>:DATAPROFECIONALES</td></tr>
			</tbody>
		</table>
		
	</div>
</template>
@endsection

@section('scripts')

<script src="{{ asset('js/registerBudget.js')}}"></script>

@endsection