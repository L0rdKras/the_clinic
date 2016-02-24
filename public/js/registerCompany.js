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
				var modalWindow = $('#modalTemplate').html();
				if(response.respuesta==="Guardado"){
					//informar y recargar
					modalWindow = modalWindow.replace(':MENSAJE','Empresa Guardada');
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
		$("#"+fieldName).after('<div class="label alert alert-danger" role="alert">'+response[fieldName][0]+'</div>');
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