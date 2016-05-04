@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
    <h1>Presupuestos</h1>
    <div class="page-hader row">
        <div class="panel panel-primary col-md-6">
            <div class="list-group">
            	<a href="{{route('crear-presupuesto')}}" class="list-group-item">Elaborar Presupuesto</a>
            	<a href="{{route('budget-list')}}" class="list-group-item">Ver Lista</a>
            </div>
        </div>
    </div>
</div>
@endsection