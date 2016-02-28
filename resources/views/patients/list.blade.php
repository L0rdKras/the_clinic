@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
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
		                <th>Info</th>
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

@endsection