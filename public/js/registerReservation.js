$(document).ready(function() {
	cargaDia();
	seleccionaBloque();
	
	showModalPatients();
	showModalAtentions();
	showModalMedics();

	selectPatient();
	selectAtention();
	selectMedic();

});

var cargaDia = function(){
	$("#btnCargaDia").on("click",function(e){
		e.preventDefault();
		var dia = $("#fechaReserva").val();

		if(dia != ""){
			muestraInfoDia(dia);
		}
	});
};

var muestraInfoDia = function(dia){
	var tabla = $("#tablaDia").html();

	$("#muestraAgenda").html(tabla);
};

var seleccionaBloque = function(){
	$("#muestraAgenda").on("dblclick","table tbody .filaAgenda",function(){
		var objeto = $(this);
		//console.log(objeto.data("idBlock"));
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
	});
};