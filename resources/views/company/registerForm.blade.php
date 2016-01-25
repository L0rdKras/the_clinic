@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Registro de Empresas</h2>
    <div class="page-hader">
        <div class="panel panel-default">

  			<div class="panel-heading">Datos</div>
  			<div class="panel-body">
	        	{!! Form::open(array('id'=>'formEmpresa','route' => ['guarda-empresa'],'method'=>'POST')) !!}
	        		<div class="row">
	        			<h4>
		        		{!! Form::label('rut', 'Rut',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('rut',null,array('id'=>'rut','class'=>'col-md-2 campoIngreso')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('name', 'Nombre',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('name',null,array('id'=>'name','class'=>'col-md-2 campoIngreso')); !!}
					    </h4>
				    </div>
				    
				    <div class="row">
	        			<h4>
		        		{!! Form::label('phone', 'Telefono',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('phone',null,array('id'=>'phone','class'=>'col-md-2 campoIngreso')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('email', 'Email',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::email('email',null,array('id'=>'email','class'=>'col-md-2 campoIngreso')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('amount', 'Monto Cobertura(U.F.)',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('amount',null,array('id'=>'amount','class'=>'col-md-2 campoIngreso')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('benefit', 'Porcentaje Cobertura(%)',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('benefit',null,array('id'=>'benefit','class'=>'col-md-2 campoIngreso')); !!}
					    </h4>
				    </div>
				    <div class="row">
	        			<h4>
		        		{!! Form::label('month', 'Mes Cambio Cobertura',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('month',null,array('id'=>'month','class'=>'col-md-2 campoIngreso')); !!}
					    </h4>
				    </div>
				    <div class="row">
				    	<h4>
				    		{!! Form::submit('Guardar',array('id'=>'guardar','class'=>'btn-success')); !!}
				    	</h4>
				    </div>
				{!! Form::close() !!}
			</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
$(document).ready(function() {
	guardarEmpresa();
	enterRut();
	dejarRut();
});

var guardarEmpresa = function(){
	$("#guardar").on('click',function(event){
		event.preventDefault();
		//1.- validar campos
		var rut = $("#rut").val();
		var nombre = $('#name').val();
		var telefono = $('#phone').val();
		var email = $('#email').val();
		var monto = $('#amount').val();
		var porcentaje = $('#benefit').val();
		var mes = $('#month').val();
		//2.- cargar data del form
		var form = $("#formEmpresa");

		var url = form.attr('action');

		var data = form.serialize();

		$.post(url,data,function(response){
			//borrar los alert
			cleanAlerts("formEmpresa");
			if(response.respuesta!=undefined){
				console.log(response.respuesta);
			}else{
				$("#formEmpresa .campoIngreso").each(function (index) 
        		{
        			var id_name = this.id;

        			showError(id_name,response);
        			
        		});
			}
		},'json');

	});
};

var cleanAlerts = function(object){
	$("#"+object+" .alert").remove();
};

var showError = function(fieldName,response){
	if(response[fieldName]!=undefined){
		//console.log(response[fieldName][0]);
		$("#"+fieldName).after('<div class="alert alert-danger" role="alert">'+response[fieldName][0]+'</div>');
	}
};

var enterRut = function(){
	$("#rut").on("keypress",function(e){
		if(e.which == 13){
			e.preventDefault();
			var rut = $(this).val();
			formatearRevisarRut(rut);
		}
	});
};

var dejarRut = function(){
	$("#rut").on("focusout",function(){
		var rut = $(this).val();
		formatearRevisarRut(rut);
	});
};

var formatearRevisarRut = function(rut){
	rut = daformator(rut);

	if(valida_cadena(rut)){
		$("#rut").val(rut);
	}else{
		$("#rut").select();
	}
};
</script>

@endsection