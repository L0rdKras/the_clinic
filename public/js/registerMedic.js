$(document).ready(function() {
	guardarMedico();
});

var guardarMedico = function(){
	$("#guardar").on('click',function(event){
		event.preventDefault();

		//2.- cargar data del form
		var form = $("#formProfecionales");

		var url = form.attr('action');

		var data = form.serialize();

		$.post(url,data,function(response){
			//borrar los alert
			console.log(response);
			cleanAlerts("formProfecionales");
			if(response.respuesta!=undefined){
				var modalWindow = $('#modalTemplate').html();
				if(response.respuesta==="Guardado"){
					//informar y recargar
					modalWindow = modalWindow.replace(':MENSAJE','Profecional Guardado');
					$(modalWindow).modal({
					  keyboard: false,
					  backdrop: 'static'
					});
					setTimeout(location.reload(), 10000);
				}else{
					//informar error
					modalWindow = modalWindow.replace(':MENSAJE',response.respuesta);
					$(modalWindow).modal();
				}
			}else{
				$("#formProfecionales .campoIngreso").each(function (index) 
        		{
        			var id_name = this.id;

        			showError(id_name,response);
        			
        		});
			}
		},'json').fail(function(){
			alert("Ocurrio un error al intentar guardar la informacion");
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