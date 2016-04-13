$(document).ready(function() {
	cargaDia();

	//clickHour();

	showInfo();

	changeStatus();

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
		var medic = $("#medic").val();

		if(dia != "" && sala != ""){
			muestraInfoDia(dia,sala,medic);
		}
	});
};

var muestraInfoDia = function(dia,sala,medic){
	//var tabla = $("#tablaDia").html();

	//$("#muestraAgenda").html(tabla);

	//buscar data
	var form = $("#formDataTable");

	var ruta = form.attr('action');

	ruta = ruta.replace(':DATE',dia);
	ruta = ruta.replace(':ROOM',sala);
	ruta = ruta.replace(':MEDIC',medic);

	$.get(ruta,function(response){
		$("#muestraAgenda table tbody").html(response);
	});
};

//mostrar info

var showInfo = function(){
	$("#data-table tbody").on("click",".filaAgenda th .infoBloque",function(event){
		event.preventDefault();

		var padre = $(this).parent();
		var abuelo = $(padre).parent();

		idReservation = abuelo.data('reservationId');

		var form = $("#formDataReservation");

		var ruta = form.attr('action');

		ruta = ruta.replace(':ID',idReservation);

		var modalview = $("#modalTemplate").html();

		var modalInfo = $("#datosReserva").html();

		$.getJSON(ruta,function(response){
			modalInfo = modalInfo.replace(":PACIENTE",response.patient);

			modalInfo = modalInfo.replace(":MEDIC",response.medic);

			modalInfo = modalInfo.replace(":ATENCION",response.atention);

			modalInfo = modalInfo.replace(":DATE",response.date);

			modalInfo = modalInfo.replace(":HORARIO",response.start+" a "+response.finish);

			modalInfo = modalInfo.replace(":PABELLON",response.room);

			modalInfo = modalInfo.replace(":STATUS",response.status);

			modalInfo = modalInfo.replace(":COMMENT",response.comment);

			modalview = modalview.replace(":MENSAJE",modalInfo);

			$(modalview).modal();
		});
	});
}

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

var changeStatus = function(){
	$("#data-table tbody").on("click",".filaAgenda th .editBloque",function(event){
		event.preventDefault();

		var padre = $(this).parent();
		var abuelo = $(padre).parent();

		idReservation = abuelo.data('reservationId');

		statusReservation = abuelo.data('reservationStatus');

		/*var form = $("#formDataReservation");

		var ruta = form.attr('action');

		ruta = ruta.replace(':ID',idReservation);*/

		var modalview = $("#modalTemplate").html();

		var modalInfo = $("#cambiarEstado").html();

		modalInfo = modalInfo.replace(':ID',idReservation);

		modalview = modalview.replace(":MENSAJE",modalInfo);

		$(modalview).modal();

		$("#newStatus").val(statusReservation);
	});
};