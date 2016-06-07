$(document).ready(function() {
	cargaDia();

	imprimirDia();

	//clickHour();

	showInfo();

	changeStatus();

	updateStatus();

	deleteReservation();

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

		if(dia !== "" && sala !== ""){
			muestraInfoDia(dia,sala,medic);
		}
	});
};

var imprimirDia = function(){
	$("#btnImprimirDia").on("click",function(e){
		e.preventDefault();
		var dia = $("#fechaReserva").val();
		var sala = $("#sala").val();
		//var medic = $("#medic").val();

		if(dia !== "" && sala !== ""){
			printDay(dia,sala);
		}
	});
};

var printDay = function(day,room){

	var ruta = $("#printRoute").val();

	ruta = ruta.replace(':DATE',day);
	ruta = ruta.replace(':ROOM',room);

	window.open(ruta);

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

var changeStatus = function(){
	$("#data-table tbody").on("click",".filaAgenda th .editBloque",function(event){
		event.preventDefault();

		var padre = $(this).parent();
		var abuelo = $(padre).parent();

		idReservation = abuelo.data('reservationId');

		statusReservation = abuelo.data('reservationStatus');

		$("#idCambiar").val(idReservation);

		$("#modal-for-update").modal();

		$("#newStatus").val(statusReservation);
		$("#commit").val("");
	});
};

var updateStatus = function(){
	$("body").on('click',"#btnChangeStatus",function(event){
		event.preventDefault();

		var form = $("#formChangeStatus");

		var ruta = form.attr('action');

		var id = $("#idCambiar").val();

		ruta = ruta.replace(':ID',id);

		var formDummy = $("#formDummyChangeStatus");

		var data = formDummy.serialize();

		//console.log(ruta);
		$.post(ruta,data,function(response){
			//console.log(response);
			if(response.respuesta==="Actualizado"){
				$("#modal-for-update").modal('hide');
				actualizarData(response);
			}
		},'json');

	});
};

var actualizarData = function(data){
	var objeto = $(".statusReservation"+data.id);

	objeto.removeClass('Confirmada Cancelada Inasistencia Realizada Reservada').addClass(data.status);

	objeto.html(data.status);

	var padre = objeto.parent();

	padre.data('reservationStatus',data.status);
};


var deleteReservation = function(){
	$("#data-table tbody").on("click",".filaAgenda th .deleteBloque",function(event){
		event.preventDefault();

		var padre = $(this).parent();
		var abuelo = $(padre).parent();

		idReservation = abuelo.data('reservationId');

		statusReservation = abuelo.data('reservationStatus');

		//$("#idCambiar").val(idReservation);

		if(confirm("Confirma la eliminacion de este registro?")){
			var formDelete = $("#formDeleteReservation");

			var ruta = formDelete.attr('action');

			ruta = ruta.replace(':ID', idReservation);

			var data = formDelete.serialize();

			$.post(ruta,data,function(response){

				$(".filaReservation"+idReservation).fadeOut();
			});

		}


	});
};
