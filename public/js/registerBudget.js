$(document).ready(function() {
	
	showModalPatients();
	showModalAtentions();
	showModalMedics();

	selectPatient();
	selectAtention();
	selectMedic();

	cambioValor();

	eliminarDelListado();

	guardarPresupuesto();

});

var showModalPatients = function(){
	$("#btnSearchPatient").on("click",function(e){
		e.preventDefault();
		var modalview = $("#modalTemplate").html();

		var estructuraTabla = $("#tablaMostrarPacientes").html();

		var ruta = $("#rutaListaPacientes").val();

		$.getJSON(ruta,function(response){
			var filas = "";
			$.each(response, function(i,item){
				//console.log(response[i].firstname);
				filas = filas+"<tr data-id-patient='"+response[i].id+"' data-firstname-patient='"+response[i].firstname+"' data-lastname-patient='"+response[i].lastname+"'><th>"+response[i].rut+"</th><th>"+response[i].firstname+"</th><th>"+response[i].lastname+"</th><th><a class='btn btn-warning botonCargaPaciente'>Carga</a></th></tr>";
			});

			estructuraTabla=estructuraTabla.replace('<tr><td>:DATAPACIENTES</td></tr>',filas);

			modalview = modalview.replace(':MENSAJE',estructuraTabla);

			$(modalview).modal();
		});
	});
};

var showModalAtentions = function(){
	$("#btnSearchAtention").on("click",function(e){
		e.preventDefault();
		var modalview = $("#modalTemplate").html();

		var estructuraTabla = $("#tablaMostrarAtenciones").html();

		var ruta = $("#rutaListaAtenciones").val();

		$.getJSON(ruta,function(response){
			var filas = "";
			$.each(response, function(i,item){
				//console.log(response[i].firstname);
				filas = filas+"<tr data-id-atention='"+response[i].id+"' data-price='"+response[i].price+"' data-name-atention='"+response[i].name+"' ><th>"+response[i].name+"</th><th><a class='btn btn-warning botonCargaAtencion'>Carga</a></th></tr>";
			});

			estructuraTabla=estructuraTabla.replace('<tr><td>:DATAATENCIONES</td></tr>',filas);

			modalview = modalview.replace(':MENSAJE',estructuraTabla);

			$(modalview).modal();
		});
	});
};

var showModalMedics = function(){
	$("#btnSearchMedic").on("click",function(e){
		e.preventDefault();
		var modalview = $("#modalTemplate").html();

		var estructuraTabla = $("#tablaMostrarProfecionales").html();

		var ruta = $("#rutaListaProfecionales").val();

		$.getJSON(ruta,function(response){
			var filas = "";
			$.each(response, function(i,item){
				//console.log(response[i].firstname);
				filas = filas+"<tr data-id-medic='"+response[i].id+"' data-name-medic='"+response[i].name+"' data-speciality-medic='"+response[i].speciality+"' ><th>"+response[i].name+"</th><th>"+response[i].speciality+"</th><th><a class='btn btn-warning botonCargaProfecional'>Carga</a></th></tr>";
			});

			estructuraTabla=estructuraTabla.replace('<tr><td>:DATAPROFECIONALES</td></tr>',filas);

			modalview = modalview.replace(':MENSAJE',estructuraTabla);

			$(modalview).modal();
		});
	});
};

var selectPatient = function(){
	$("body").on('click',"#modal-confirmation #tablaElejirPaciente tbody tr th .botonCargaPaciente",function(e){
		e.preventDefault();
		var objeto = $(this);

		var padre = objeto.parent();
		var abuelo = $(padre).parent();

		var nombre = abuelo.data('firstnamePatient')+" "+abuelo.data("lastnamePatient");

		var form = $("#formDataPatient");

		var ruta = form.attr('action');

		ruta = ruta.replace(":ID",abuelo.data('idPatient'));

		var template = $("#showDataPatient").html();

		//load data
		$.getJSON(ruta,function(response){
			template = template.replace(':NOMBRE',response.firstname+" "+response.lastname);
			template = template.replace(':RUT',response.rut);
			template = template.replace(':EMPRESA',response.companyName);

			$("#patientArea").html("");
			$("#patientArea").html(template);
			$("#btnSearchPatient").fadeOut();
			$("#patient_id").val(abuelo.data('idPatient'));
		});

		$("#modal-confirmation").modal('hide');
	});
};

var revisarListaAtenciones = function(id){
	var check = true;
	//$("#tableOfAtentions tbody .atencionCargada th input").each(function(index){
	$("#tableOfAtentions tbody .atencionCargada").each(function(index){
		//console.log($(this).val());
		if(id === $(this).data('id')){
			check = false;
		}
	});

	return check;
};
var selectAtention = function(){
	$("body").on('click',"#modal-confirmation #tablaElejirAtenciones tbody tr th .botonCargaAtencion",function(e){
		e.preventDefault();
		var objeto = $(this);

		var padre = objeto.parent();
		var abuelo = $(padre).parent();

		var nombre = abuelo.data('nameAtention');

		var template = $("#tFilaAtenciones").html();

		template = template.replace(/:ID/gi,abuelo.data('idAtention'));
		template = template.replace(/:NOMBRE/gi,abuelo.data('nameAtention'));
		template = template.replace(":PRECIO",abuelo.data('price'));

		$.when(revisarListaAtenciones(abuelo.data('idAtention'))).promise().done(function(message){
			if(message){
				$("#tableOfAtentions tbody").append(template).promise().done(function(){
					//calcular Total
					calcularTotal();
				});
			}else{
				alert("Esta atencion ya se encuentra en el listado");
			}
		});

		//$("#atention").val(nombre);
		//$("#atention_id").val(abuelo.data('idAtention'));
	});
};

var selectMedic = function(){
	$("body").on('click',"#modal-confirmation #tablaElejirProfecionales tbody tr th .botonCargaProfecional",function(e){
		e.preventDefault();
		var objeto = $(this);

		var padre = objeto.parent();
		var abuelo = $(padre).parent();

		var nombre = abuelo.data('nameMedic');

		var especialidad = abuelo.data('specialityMedic');

		//$("#medic").val(nombre);
		$("#medic_id").val(abuelo.data('idMedic'));
		var template = $("#showDataMedic").html();

		template = template.replace(":NOMBRE",nombre);
		template = template.replace(":ESPECIALIDAD",especialidad);

		$("#medicArea").html("");
		$("#medicArea").html(template);

		$("#modal-confirmation").modal('hide');
	});
};

var calcularTotal = function(){
	var total = 0;
	$("#tableOfAtentions tbody .atencionCargada th input").each(function(index){
		total += parseInt($(this).val());
	});

	var id = $("#patient_id").val();

	$("#total_atentions").val(total);
};

var cambioValor = function(){
	$("#tableOfAtentions tbody").on("keyup",".atencionCargada th input",function(){
		calcularTotal();
	});
};

var eliminarDelListado =  function(){
	$("#tableOfAtentions tbody").on("click",".atencionCargada th .delete-atention", function(event){
		event.preventDefault();
		var padre = $(this).parent();
		var abuelo = $(padre).parent();

		$(abuelo).fadeOut("slow",function(){
			$(abuelo).remove();
			calcularTotal();
		});
	});
};

var guardarPresupuesto = function(){
	$("#guardar").on("click",function(e){
		e.preventDefault();
		var arreglo = [];
		$("#tableOfAtentions tbody .atencionCargada th input").each(function(index){
			//total += parseInt($(this).val());
			var padre = $(this).parent();
			var abuelo = $(padre).parent();

			idAtention = abuelo.data("id");
			arreglo.push({valor:parseInt($(this).val()),id:idAtention});
		});

		detail = JSON.stringify(arreglo);

		$("#detail").val(detail);

		var form = $("#formDummy");

		var data = form.serialize();

		var url = form.attr('action');

		$.post(url,data,function(response){
			//borrar los alert
			cleanAlerts("formDummy");
			if(response.respuesta!=undefined){
				var modalWindow = $('#modalTemplate').html();
				if(response.respuesta==="Guardado"){
					//informar y recargar
					modalWindow = modalWindow.replace(':MENSAJE','Presupuesto Guardado');
					$(modalWindow).modal({
					  keyboard: false,
					  backdrop: 'static'
					});
					setTimeout(location.reload(), 5000);
					rutaImpresion = $("#rutaImpresion").val();
					rutaImpresion = rutaImpresion.replace(':ID',response.numero);
					window.open(rutaImpresion);
				}else{
					//informar error
					modalWindow = modalWindow.replace(':MENSAJE',response.respuesta);
					$(modalWindow).modal();
				}
			}else{
				$("#formDummy .campoIngreso").each(function (index) 
        		{
        			var id_name = this.id;

        			showError(id_name,response);

        			alert("Falta informacion");
        			
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