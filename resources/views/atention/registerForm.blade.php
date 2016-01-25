@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Registro de Atenciones</h2>
    <div class="page-hader">
        <div class="panel panel-default">

  			<div class="panel-heading">Datos</div>
  			<div class="panel-body">
	        	{!! Form::open(array('url' => 'foo/bar')) !!}
				    <div class="row">
	        			<h4>
		        		{!! Form::label('Name', 'Nombre',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('Name',null,array('id'=>'name','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
	        		<div class="row">
	        			<h4>
		        		{!! Form::label('blocks', 'Numero Bloques',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('blocks',null,array('id'=>'blocks','class'=>'col-md-2')); !!}
					    </h4>
				    </div>
				    
				    <div class="row">
				    	<h4>
				    		{!! Form::submit('Guardar',array('id'=>'save_atention','class'=>'btn-success')); !!}
				    	</h4>
				    </div>
				{!! Form::close() !!}
			</div>
        </div>
    </div>
</div>
@endsection