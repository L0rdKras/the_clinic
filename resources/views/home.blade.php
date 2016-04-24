@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
<div class="jumbotron">
  <h1>Hola,{{Auth::user()->name}}</h1>
  <p>El valor actual de la UF es ${{$dailyIndicators->uf->valor}}</p>
</div>
    <div class="page-hader row">
        <div class="panel panel-primary col-md-6">
            <ul class="list-group">
            	<li class="list-group-item">
            		<a href="{{route('crear-empresa')}}" class="list-group-item">Registrar</a>
            	</li>
            	<li class="list-group-item">
            		<a href="{{route('lista-empresas')}}" class="list-group-item">Ver Lista</a>
            	</li>
            </ul>
        </div>
    </div>
</div>
@endsection