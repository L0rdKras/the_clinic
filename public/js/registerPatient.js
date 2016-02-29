$(document).ready(function() {
	//guardarPaciente();
	enterRut();
	dejarRut();
	seleccionTipo();
	seleccionEmpresa();
	seleccionTitular();

	guardaTitular();

});

var guardaTitular = function(){
	$("#formPatient #complementaryData").on('click',"#dataEmpresa h3 #btn-guarda-titular",function(e){
		e.preventDefault();

		var form = $("#formPatient");
		var formRuta = $("#formSaveIncumbents");

		var url = formRuta.attr('action');

		var data = form.serialize();

		/*$.post(url,data,function(response){
			console.log(response);
		}).fail(function(){
			alert("Ocurrio un error al intentar guardar la informacion");
		});*/
		$.post(url,data,function(response){
			//borrar los alert
			cleanAlerts("formPatient");
			if(response.respuesta!=undefined){
				var modalWindow = $('#modalTemplate').html();
				if(response.respuesta==="Guardado"){
					//informar y recargar
					modalWindow = modalWindow.replace(':MENSAJE','Paciente Guardado');
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
				$("#formPatient .campoIngreso").each(function (index) 
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

var seleccionTipo = function()
{
	$("#type").on('change',function(){
		$("#complementaryData").html("");
		if($(this).val() == "Titular")
		{
			var viewHtml = $("#isIncumbent").html();
			//muesta boton seleccionar cliente
			$("#complementaryData").append(viewHtml).promise().done(function(){
				buscarEmpresa()
			});
		}else if($(this).val() == "Carga"){
			var viewHtml = $("#isBurden").html();
			//muesta boton seleccionar cliente
			$("#complementaryData").append(viewHtml).promise().done(function(){
				buscaTitular();
			});
		}else{
			//oculta boton seleccionar cliente
			$("#complementaryData").html("");
		}
	});
};

var buscarEmpresa = function(){
	$("#btnSelectCompany").on('click',function(e){
		e.preventDefault();

		var form = $("#formCompanys");

		var url = form.attr('action');

		$.get(url,function(data){
			//console.log(data);
			$("#tablaResultado .detalleBusqueda").remove();
			$("#tablaResultado").append(data).promise().done(function(){
				$("#TituloModal").html("Buscar Empresa");
				$('#modal_buscar').modal();
			});
		}).fail(function(){
			alert("Ocurrio un error al intentar cargar la informacion");			
		});

	});
};

var buscaTitular = function(){
	$("#btnSelectIncumbent").on('click',function(e){
		e.preventDefault();

		var form = $("#formIncumbents");

		var url = form.attr('action');

		$.get(url,function(data){
			//console.log(data);
			$("#tablaResultado .detalleBusqueda").remove();
			$("#tablaResultado").append(data).promise().done(function(){
				$("#TituloModal").html("Buscar Titular");
				$('#modal_buscar').modal();
			});
		}).fail(function(){
			alert("Ocurrio un error al intentar cargar la informacion");			
		});

	});
};

var seleccionEmpresa = function(){
	$("body").on('click',"#modal_buscar #tablaResultado tbody .detalleBusqueda td .botonElijeEmpresa",function(e){
		e.preventDefault();
		var padre = $(this).parent();
		var abuelo = $(padre).parent();

		cargarDataEmpresa(abuelo);
	});
};

var seleccionTitular = function(){
	$("body").on('click',"#modal_buscar #tablaResultado tbody .detalleBusqueda td .botonElijeTitular",function(e){
		e.preventDefault();
		var padre = $(this).parent();
		var abuelo = $(padre).parent();

		cargarDataTitular(abuelo);
	});
};

var cargarDataEmpresa = function(objeto){
	var idEmpresa = $(objeto).data("id");
	var nombreEmpresa = $(objeto).data("name");

	$("#dataToSave").val(idEmpresa);

	var vista = "<div id='dataEmpresa'><h3><label class='label label-info'>Empresa a la que Pertenece: "+nombreEmpresa+"</label></h3><input type='hidden' id='idEmpresaTitular' value='"+idEmpresa+"' /><h3><button class='btn btn-success' id='btn-guarda-titular'>Guardar</button></h3></div>";

	$("#dataEmpresa").remove();
	$("#dataTitular").remove();

	$("#complementaryData").append(vista);
	$('#modal_buscar').modal('hide');
};

var cargarDataTitular = function(objeto){
	var idTitular = $(objeto).data("id");
	var nombreTitular = $(objeto).data("name");

	$("#dataToSave").val(idTitular);

	var vista = "<div id='dataEmpresa'><h3><label class='label label-info'>Es carga de: "+nombreTitular+"</label></h3><input type='hidden' id='idEmpresaTitular' value='"+idTitular+"' /><h3><button class='btn btn-success' id='btn-guarda-titular'>Guardar</button></h3></div>";

	$("#dataTitular").remove();
	$("#dataEmpresa").remove();

	$("#complementaryData").append(vista);
	$('#modal_buscar').modal('hide');

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