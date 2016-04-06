$(document).ready(function() {
	cargaDia();
	
	showModalPatients();
	showModalAtentions();
	showModalMedics();

	selectPatient();
	selectAtention();
	selectMedic();

	clickHour();

	saveReservation();
});

var clickHour = function(){
	$("body #muestraAgenda").on("dblclick","table tbody .filaAgenda",function(){
		var dia = $("#fechaReserva").val();
		var sala = $("#sala").val();
		var objeto = $(this);
		var idbloque = objeto.data("idBlock");
		var idAtention = $("#atention_id").val();
		var idMedic = $("#medic_id").val();

		var formConsulta = $("#formConsulta");

		var url = formConsulta.attr('action').replace(":ROOM",sala);
		url = url.replace(":BLOCK",idbloque);
		url = url.replace(":DATE",dia);
		url = url.replace(":ATENTION",idAtention);
		url = url.replace(":MEDIC",idMedic);
		console.log(url);

		$.get(url,function(response){
			if(response.estado==='valido'){
				$("#room").val(sala);
				$("#roomInfo").val(sala);
				$("#date").val(dia);
				$("#reservationDate").val(dia);
				$("#init_hour").val(response.inicio);
				$("#finish_hour").val(response.fin);
				$("#block_id").val(idbloque);
			}else{
				alert(response.mensaje);
			}
		});
	});
};

var cargaDia = function(){
	$("#btnCargaDia").on("click",function(e){
		e.preventDefault();
		var dia = $("#fechaReserva").val();
		var sala = $("#sala").val();

		if(dia != "" && sala != ""){
			muestraInfoDia(dia,sala);
		}
	});
};

var muestraInfoDia = function(dia,sala){
	//var tabla = $("#tablaDia").html();

	//$("#muestraAgenda").html(tabla);

	//buscar data
	var form = $("#formDataTable");

	var ruta = form.attr('action');

	ruta = ruta.replace(':DATE',dia);
	ruta = ruta.replace(':ROOM',sala);

	$.get(ruta,function(response){
		$("#muestraAgenda table tbody").html(response);
	});
};

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

		$("#patient").val(nombre);
		$("#patient_id").val(abuelo.data('idPatient'));

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

		$("#medic").val(nombre);
		$("#medic_id").val(abuelo.data('idMedic'));
	});
};

var saveReservation = function(){
	$("#guardar").on('click',function(e){
		e.preventDefault();

		$("#comment").val($("#text_default").val());

		var form = $("#formReserv");

		var data = form.serialize();

		var url = form.attr('action');

		$.post(url,data,function(response){
			//console.log(response);
			if(response.respuesta=="Guardado"){
				var dia = $("#fechaReserva").val();
				var sala = $("#sala").val();
				muestraInfoDia(dia,sala);
			}
		},'json');
	});
};