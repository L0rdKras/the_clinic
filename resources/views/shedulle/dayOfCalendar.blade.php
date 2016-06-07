@extends('layout')

@section('content')
<div class="modal fade bs-example-modal-lg" id="modal-for-update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sistema Clinica</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<h2>Cambiar Estado</h2>
					<div class="panel-body">
						{!! Form::open(array('route' => ['cambia-estado',':ID'],'id'=>'formDummyChangeStatus','method'=>'PATCH')) !!}
						<h4 class="row">
							{!! Form::label('newStatus', 'Estado',array('class' => 'label label-default col-md-4')); !!}
							<select name="newStatus" id="newStatus" class="col-md-4">
								<option value="Reservada">Reservada</option>
								<option value="Confirmada">Confirmada</option>
								<option value="Cancelada">Cancelada</option>
								<option value="Realizada">Atencion realizada</option>
								<option value="Inasistencia">Inasistencia</option>
							</select>
						</h4>
						<h4 class="row">
							{!! Form::label('commit', 'Comentario',array('class' => 'label label-default col-md-4')); !!}
							{!! Form::textarea('commit', null, ['size' => '30x5','id'=>'commit']) !!}
						</h4>
						<h4 class="row">
							<a href="#" id="btnChangeStatus" class="btn btn-primary col-md-3">Actualizar</a>
						</h4>
					{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Revisar Dias</h2>
    <div class="page-hader">
        <div class="panel panel-default">
        	<div class="panel-heading">Calendario</div>
  			<div class="panel-body">
					<input type="hidden" id="printRoute" value="{{route('print-day',[':DATE',':ROOM'])}}">
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
					<button id="btnImprimirDia" class="btn btn-default">Imprimir</button>
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

{!! Form::open(array('route' => ['all-data-reservation',':ID'],'id'=>'formDataReservation')) !!}
{!! Form::close() !!}

{!! Form::open(array('route' => ['delete-reservation',':ID'],'id'=>'formDeleteReservation')) !!}
{!! Form::close() !!}

{!! Form::open(array('route' => ['cambia-estado',':ID'],'id'=>'formChangeStatus','method'=>'PATCH')) !!}
{!! Form::hidden('idCambiar',null,array('id'=>'idCambiar'))!!}
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
	<div class="panel panel-default">
		<h2>Reserva</h2>
	  <div class="panel-body row">
	    <h3>
	    	<span class="label label-default col-md-6">Paciente</span> :PACIENTE
	    </h3>
	    <h3>
	    	<span class="label label-default col-md-6">Profecional</span> :MEDIC
	    </h3>
	    <h3>
	    	<span class="label label-default col-md-6">Atencion</span> :ATENCION
	    </h3>
	    <h3>
	    	<span class="label label-default col-md-6">Fecha</span> :DATE
	    </h3>
	    <h3>
	    	<span class="label label-default col-md-6">Horario</span> :HORARIO
	    </h3>
	    <h3>
	    	<span class="label label-default col-md-6">Pabellon</span> :PABELLON
	    </h3>
	    <h3>
	    	<span class="label label-default col-md-6">Estado</span> :STATUS
	    </h3>
	    <h3>
	    	<span class="label label-default col-md-6">Comentario</span> :COMMENT
	    </h3>
	  </div>
	</div>
</template>


@endsection

@section('scripts')

<script src="{{ asset('js/showDay.js')}}"></script>

@endsection
