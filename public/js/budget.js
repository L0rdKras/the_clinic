$(document).ready(function() {
	aceptar();

	anular();
});

var aceptar = function(){
	$("#btn-acepta").on("click",function(event){
		event.preventDefault();

		var id = $(this).data("id");

		var form = $("#formConfirmBudget");

		var data = form.serialize();

		var url = form.attr('action');

		url = url.replace(':ID',id);

		$.post(url,data,function(response){
			console.log(response);

			if(response === "Actualizado"){
				alert("Estado actualizado");
				location.reload();
			}else{
				alert(response);
			}
		});
	});
};

var anular = function(){
	$("#btn-cancela").on("click",function(event){
		event.preventDefault();

		var id = $(this).data("id");

		var form = $("#formCancelBudget");

		var data = form.serialize();

		var url = form.attr('action');

		url = url.replace(':ID',id);

		$.post(url,data,function(response){
			console.log(response);

			if(response === "Actualizado"){
				alert("Estado actualizado");
				location.reload();
			}else{
				alert(response);
			}
		});
	});
};