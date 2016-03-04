$(document).ready(function() {
	cargaDia();
	seleccionaBloque();
	showModalPatients();
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
	});
};