@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
	<h2>Registro de Atenciones</h2>
    <div class="page-hader">
        <div class="panel panel-default">

  			<div class="panel-heading">Datos</div>
  			<div class="panel-body">
	        	{!! Form::open(array('id'=>'formAtention','route' => ['guarda-atencion'],'method'=>'POST')) !!}
				    <div class="row">
	        			<h4>
		        		{!! Form::label('name', 'Nombre',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('name',null,array('id'=>'name','class'=>'col-md-2 campoIngreso')); !!}
					    </h4>
				    </div>
	        		<div class="row">
	        			<h4>
		        		{!! Form::label('block_numbers', 'Numero Bloques',array('class' => 'label label-default col-md-2')); !!}
					    {!! Form::text('block_numbers',null,array('id'=>'block_numbers','class'=>'col-md-2 campoIngreso')); !!}
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

@section('scripts')

<script type="text/javascript">
$(document).ready(function() {
	guardarAtention();
});

var guardarAtention = function(){
	$("#save_atention").on('click',function(event){
		event.preventDefault();
		var form = $("#formAtention");

		var url = form.attr('action');

		var data = form.serialize();

		$.post(url,data,function(response){
			cleanAlerts("formAtention");
			if(response.respuesta!=undefined){
				var modalWindow = $('#modalTemplate').html();
				if(response.respuesta==="Guardado"){
					//informar y recargar
					modalWindow = modalWindow.replace(':MENSAJE','Atencion Guardada');
					$(modalWindow).modal({
					  keyboard: false,
					  backdrop: 'static'
					});
					setTimeout(location.reload(), 5000);
				}else{
					//informar error
					modalWindow = modalWindow.replace(':MENSAJE',response.respuesta);
					$(modalWindow).modal();
				}
			}else{
				$("#formAtention .campoIngreso").each(function (index) 
        		{
        			var id_name = this.id;

        			showError(id_name,response);
        			
        		});
			}
		}).fail(function(){
			alert("Ocurrio un error al intentar guardar");			
		});
	});
};

var cleanAlerts = function(object){
	$("#"+object+" .alert").remove();
};

var showError = function(fieldName,response){
	if(response[fieldName]!=undefined){
		//console.log(response[fieldName][0]);
		$("#"+fieldName).after('<div class="label alert alert-danger" role="alert">'+response[fieldName][0]+'</div>');
	}
};
</script>

@endsection