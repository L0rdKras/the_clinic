@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Registro Horas</h2>
    <div class="page-hader row">
        <div class="panel panel-default col-md-6">

  			<div class="panel-heading">Datos</div>
  			<div class="panel-body">
  				<input type="hidden" id="rutaListaPacientes" value="{{route('lista-todos-pacientes')}}">
  				<input type="hidden" id="rutaListaAtenciones" value="{{route('lista-todas-atenciones')}}">
  				<input type="hidden" id="rutaListaProfecionales" value="{{route('lista-todos-profecionales')}}">
  				<input type="hidden" id="rutaDatosHoraSeleccionada" value="{{route('datos-hora-seleccionada')}}">

	        	{!! Form::open(array('id'=>'formDummy','method'=>'POST')) !!}
	        		<div class="row">
	        			<h4>
		        		{!! Form::label('patient', 'Paciente',array('class' => 'label label-default col-md-4')); !!}
					    {!! Form::text('patient',null,array('id'=>'patient','class'=>'col-md-4 campoIngreso','readonly'=>'true')); !!}
					    <a href="#" id="btnSearchPatient" class="btn btn-primary">Buscar</a>
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('atention', 'Atencion',array('class' => 'label label-default col-md-4')); !!}
					    {!! Form::text('atention',null,array('id'=>'atention','class'=>'col-md-4 campoIngreso','readonly'=>'true')); !!}
					    <a href="#" id="btnSearchAtention" class="btn btn-primary">Buscar</a>
					    </h4>
				    </div>
				    
				    <div class="row">
	        			<h4>
		        		{!! Form::label('medic', 'Profecional',array('class' => 'label label-default col-md-4')); !!}
					    {!! Form::text('medic',null,array('id'=>'medic','class'=>'col-md-4 campoIngreso','readonly'=>'true')); !!}
					    <a href="#" id="btnSearchMedic" class="btn btn-primary">Buscar</a>
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('roominfo', 'Pabellon',array('class' => 'label label-default col-md-4')); !!}
					    {!! Form::text('roominfo',null,array('id'=>'roomInfo','class'=>'col-md-4 campoIngreso','readonly'=>'true')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('date', 'Fecha',array('class' => 'label label-default col-md-4')); !!}
					    {!! Form::text('date',null,array('id'=>'date','class'=>'col-md-4 campoIngreso','readonly'=>'true')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('init_hour', 'Hora Inicio',array('class' => 'label label-default col-md-4')); !!}
					    {!! Form::text('init_hour',null,array('id'=>'init_hour','class'=>'col-md-4 campoIngreso','readonly'=>'true')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('finish_hour', 'Hora Termino',array('class' => 'label label-default col-md-4')); !!}
					    {!! Form::text('finish_hour',null,array('id'=>'finish_hour','class'=>'col-md-4 campoIngreso','readonly'=>'true')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('text_default', 'Comentario',array('class' => 'label label-default col-md-4')); !!}
					    {!! Form::textarea('text_default',null,array('id'=>'text_default','class'=>'col-md-4 campoIngreso','size'=>'10x3')); !!}
					    </h4>
				    </div>
				    
				    <div class="row">
				    	<h4>
				    		{!! Form::submit('Guardar',array('id'=>'guardar','class'=>'btn-success')); !!}
				    	</h4>
				    </div>
				{!! Form::close() !!}

				{!! Form::open(array('id'=>'formReserv','method'=>'POST','route'=>['save-reservation'])) !!}
				{!! Form::hidden('reservationDate',null,array('id'=>'reservationDate')) !!}
				{!! Form::hidden('room',null,array('id'=>'room')) !!}
				{!! Form::hidden('patient_id',null,array('id'=>'patient_id')) !!}
				{!! Form::hidden('medic_id',null,array('id'=>'medic_id')) !!}
				{!! Form::hidden('atention_id',null,array('id'=>'atention_id')) !!}
				{!! Form::hidden('block_id',null,array('id'=>'block_id')) !!}
				{!! Form::hidden('comment',null,array('id'=>'comment')) !!}
				{!! Form::close() !!}

				{!! Form::open(array('route' => ['datos-hora-seleccionada',':ROOM',':BLOCK',':DATE',':ATENTION',':MEDIC'],'id'=>'formConsulta')) !!}
				{!! Form::close() !!}

				{!! Form::open(array('route' => ['info-day-room',':DATE',':ROOM'],'id'=>'formDataTable')) !!}
				{!! Form::close() !!}
			</div>
        </div>
        <div class="panel panel-default col-md-6">
        	<div class="panel-heading">Calendario</div>
  			<div class="panel-body">
  				<input type='hidden' name='formato_fecha' id="formato_fecha" value='yyyy/mm/dd'/>
  				Fecha: <input type="text" id="fechaReserva" name="fecha" readonly size="10"/>
  				<button type='button' onclick='displayCalendar(document.getElementById("fechaReserva"),document.getElementById("formato_fecha").value,this)'><span class="glyphicon glyphicon-search"></span></button>
  				Pabellon: 
  				<select name="sala" id="sala">
  					<option value=""></option>
  					<option value="1">1</option>
  					<option value="2">2</option>
  				</select>
  				<button id="btnCargaDia" class="btn btn-default">Carga</button>
  			</div>
  			<div class="panel-body" id="muestraAgenda">
  				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Bloque</th>
							<th>Paciente</th>
							<th>Atencion</th>
							<th>Info</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
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

<template id="tablaDia">
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Bloque</th>
				<th>Paciente</th>
				<th>Atencion</th>
				<th>Info</th>
			</tr>
		</thead>
		<tbody>
			@foreach($blocks as $block)
			<tr id="bloque{{$block->id}}" data-id-block="{{$block->id}}" class="filaAgenda">
				<th>{{$block->startBlock}} a {{$block->finishBlock}}</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			@endforeach
		</tbody>
	</table>
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

<script src="{{ asset('js/registerReservation.js')}}"></script>

@endsection