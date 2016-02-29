@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
    <h1>Atenciones</h1>
    <div class="page-hader row">
        <div class="panel panel-primary col-md-6">
            <div class="list-group">
            	<a href="{{route('crear-atencion')}}" class="list-group-item">Registrar</a>
            	<a href="{{route('lista-atenciones')}}" class="list-group-item">Ver Lista</a>
            </div>
        </div>
    </div>
</div>
@endsection