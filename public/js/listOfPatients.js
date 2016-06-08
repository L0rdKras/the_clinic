$(document).ready(function() {
	//guardarPaciente();
	cargaHoras();

});

var cargaHoras = function(){
  $(".btnHorasFuturas").on('click',function(){
    var id = $(this).data("id");

    var ruta = $("#ruta-horas").val();

    ruta = ruta.replace(':ID',id);

    $.getJSON(ruta,function(data){
			//console.log(data);
			$("#tablaResultado .detalleBusqueda").remove();
			$("#tablaResultado").append(data.view).promise().done(function(){
				$("#TituloModal").html("Reservas");
				$('#modal_buscar').modal();
			});
		}).fail(function(){
			alert("Ocurrio un error al intentar cargar la informacion");
		});
  });
};
