$(document).ready(function() {
	
	showModalPatients();
	showModalAtentions();
	showModalMedics();

	selectPatient();
	selectAtention();
	selectMedic();

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
				filas = filas+"<tr data-id-atention='"+response[i].id+"' data-name-atention='"+response[i].name+"' ><th>"+response[i].name+"</th><th><a class='btn btn-warning botonCargaAtencion'>Carga</a></th></tr>";
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
				filas = filas+"<tr data-id-medic='"+response[i].id+"' data-name-medic='"+response[i].name+"' ><th>"+response[i].name+"</th><th>"+response[i].speciality+"</th><th><a class='btn btn-warning botonCargaProfecional'>Carga</a></th></tr>";
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
		});

		$("#modal-confirmation").modal('hide');
	});
};

var selectAtention = function(){
	$("body").on('click',"#modal-confirmation #tablaElejirAtenciones tbody tr th .botonCargaAtencion",function(e){
		e.preventDefault();
		var objeto = $(this);

		var padre = objeto.parent();
		var abuelo = $(padre).parent();

		var nombre = abuelo.data('nameAtention');

		$("#atention").val(nombre);
		$("#atention_id").val(abuelo.data('idAtention'));
	});
};

var selectMedic = function(){
	$("body").on('click',"#modal-confirmation #tablaElejirProfecionales tbody tr th .botonCargaProfecional",function(e){
		e.preventDefault();
		var objeto = $(this);

		var padre = objeto.parent();
		var abuelo = $(padre).parent();

		var nombre = abuelo.data('nameMedic');

		//$("#medic").val(nombre);
		//$("#medic_id").val(abuelo.data('idMedic'));
		$("#modal-confirmation").modal('hide');
	});
};