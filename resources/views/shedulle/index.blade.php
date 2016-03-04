@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
    <h1>Agenda</h1>
    <div class="page-hader row">
        <div class="panel panel-primary col-md-6">
            <div class="list-group">
            	<a href="{{route('registrar-hora')}}" class="list-group-item">Registrar Hora</a>
            	<a href="" class="list-group-item">Ver Calendario</a>
            </div>
        </div>
    </div>
</div>
@endsection