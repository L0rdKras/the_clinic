@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Revisar Dias</h2>
    <div class="page-hader">
        <div class="panel panel-default">
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
  				Medico: 
  				<select name="medic" id="medic">
  					<option value="0"></option>
  					@foreach($medics as $medic)
  						<option value="{{$medic->id}}">{{$medic->name}}</option>
  					@endforeach
  				</select>
  				<button id="btnCargaDia" class="btn btn-default">Carga</button>
  			</div>
  			<div class="panel-body" id="muestraAgenda">
  				<table class="table table-hover table-bordered" id="data-table">
					<thead>
						<tr>
							<th>Bloque</th>
							<th>Paciente</th>
							<th>Atencion</th>
							<th>Profecional</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
  			</div>
        </div>
    </div>
</div>

{!! Form::open(array('route' => ['info-day-room2',':DATE',':ROOM',':MEDIC'],'id'=>'formDataTable')) !!}
{!! Form::close() !!}

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

<template id="datosReserva">
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

<script src="{{ asset('js/showDay.js')}}"></script>

@endsection