@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<input type="hidden" id="ruta-horas" value="{{route('reservas-paciente',':ID')}}">
	<h2>Listado Pacientes</h2>
    <div class="page-hader">
        <div class="panel panel-default">
        	<div class="panel-heading">
              <h3 class="panel-title">Información</h3>
            </div>
            <div class="panel-body">
            	<table class="table table-striped">
		            <thead>
		              <tr>
		                <th>Rut</th>
		                <th>Nombre</th>
		                <th>Telefono</th>
		                <th>Tipo</th>
		                <th></th>
		              </tr>
		            </thead>
		            <tbody>
		              @foreach($patients as $patient)
		              <tr data-id="{{$patient->id}}">
		                <td>{{$patient->rut}}</td>
		                <td>{{$patient->firstname}} {{$patient->lastname}}</td>
		                <td>{{$patient->phone}}</td>
		                <td>{{$patient->type}}</td>
		                <td>
		                	<a class="btn btn-info" href="#">Ver</a>
		                	<a class="btn btn-success" href="{{route('patient-edit',$patient->id)}}">Editar</a>
											<a class="btn btn-primary btnHorasFuturas" data-id="{{$patient->id}}" href="#">
												Horas
											</a>
		                </td>
		              </tr>
		              @endforeach
		            </tbody>
		        </table>
		        {!! $patients->render() !!}
            </div>
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
	                <th>
										Fecha
									</th>
	                <th>
										Horario
									</th>
	                <th>
	                	Profesional
	                </th>
									<th>
										Estado
									</th>
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

@endsection

@section('scripts')
<script src="{{ asset('js/listOfPatients.js')}}"></script>
@endsection
