@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Listado Empresas</h2>
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
		                <th>Info</th>
		              </tr>
		            </thead>
		            <tbody>
		              @foreach($companys as $company)
		              <tr data-id="{{$company->id}}">
		                <td>{{$company->rut}}</td>
		                <td>{{$company->name}}</td>
		                <td>{{$company->phone}}</td>
		                <td>
		                	<a class="btn btn-info" href="#">+ Info</a>
											<a href="{{route('company-edit',$company->id)}}" class="btn btn-primary edit-company">Editar</a>
		                </td>
		              </tr>
		              @endforeach
		            </tbody>
		        </table>
		        {!! $companys->render() !!}
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
