import"./app.68b88f4c2.js";import"./jquery.validate.ca30e8c3.js";import"./jquery.a90e4a85.js";import"./_commonjsHelpers.b8add541.js";$(document).ready(function(){$("table#respuesta").DataTable({language:{sProcessing:"Procesando...",sLengthMenu:"Mostrar _MENU_ registros",sZeroRecords:"No se encontraron resultados",sEmptyTable:"Ning\xFAn dato disponible en esta tabla",sInfo:"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",sInfoEmpty:"Mostrando registros del 0 al 0 de un total de 0 registros",sInfoFiltered:"(filtrado de un total de _MAX_ registros)",sInfoPostFix:"",sSearch:"Buscar:",sUrl:"",sInfoThousands:",",sLoadingRecords:"Cargando...",oPaginate:{sFirst:"Primero",sLast:"\xC3\u0161ltimo",sNext:"Siguiente",sPrevious:"Anterior"},oAria:{sSortAscending:": Activar para ordenar la  columna de manera ascendente",sSortDescending:": Activar para ordenar la columna de manera descendente"}},order:[[1,"desc"]],columns:[{data:"id"},{data:"pregunta"},{data:"nombre"},{data:"respuesta"},{data:"validez",render:function(e,a,r){switch(e){case"0":return"<label class='text text-danger'><strong>no valida</strong></label>";case"1":return"<label class='text text-success'><strong>Valida</strong></label>"}}},{data:"status",render:function(e,a,r){switch(e){case"0":return"<label class='text text-danger'><strong>Inactivo</strong></label>";case"1":return"<label class='text text-success'><strong>Activo</strong></label>"}}}]}),$("form#nueva_respuesta").validate({rules:{pregunta_id:{required:!0},respuesta:{required:!0},validez:{required:!0},status:{required:!0}},messages:{pregunta_id:{required:"Pregunta requerida"},respuesta:{required:"Descripcion de la respuesta requerida"},validez:{required:"Valides de esta respuesta requerido"},status:{required:"Estatus de la respuesta requerido"}},submitHandler:function(){confirm("\xBFConfirma el registro de los datos?")&&$("form#nueva_respuesta")[0].submit()}}),$("form#vf_edit").validate({rules:{pregunta_id:{required:!1},respuesta:{required:!1},validez:{required:!1}},messages:{pregunta_id:{required:"Pregunta requerida"},respuesta:{required:"Descripcion de la respuesta requerida"},validez:{required:"Valides de esta respuesta requerido"}},submitHandler:function(){confirm("\xBFConfirma la actualizaci\xF3n los datos? ACTUALIZAR")&&console.log($("form#vf_edit").serialize())}}),$("form#simple_edit").validate({rules:{pregunta_id:{required:!1},respuesta:{required:!1},validez:{required:!1},status:{required:!1}},messages:{pregunta_id:{required:"Pregunta requerida"},respuesta:{required:"Descripcion de la respuesta requerida"},validez:{required:"Valides de esta respuesta requerido"},status:{required:"Estatus de la respuesta requerido"}},submitHandler:function(){confirm("\xBFConfirma la actualizaci\xF3n los datos? ACTUALIZAR")&&$("form#editar_respuesta")[0].submit()}}),$("form#des_edit").validate({rules:{pregunta_id:{required:!1},respuesta:{required:!1},validdez:{required:!1},status:{required:!1}},messages:{pregunta_id:{required:"Pregunta requerida"},respuesta:{required:"Descripcion de la respuesta requerida"},validez:{required:"Valides de esta respuesta requerido"},status:{required:"Estatus de la respuesta requerido"}},submitHandler:function(){confirm("\xBFConfirma la actualizaci\xF3n los datos? ACTUALIZAR")&&$("form#editar_respuesta")[0].submit()}}),$("select#sel_pregunta").on("change",function(){let e=$("select#sel_pregunta option:selected").data("puntaje"),a=$("select#sel_pregunta option:selected").val(),r=$("select#sel_pregunta option:selected").text(),s=$("select#sel_pregunta option:selected").data("tiempo"),t=$("select#sel_pregunta option:selected").data("pnombre"),i=$("select#sel_pregunta option:selected").data("pvalor"),d=$("select#sel_pregunta option:selected").data("pcomodin");switch(e){case 1:$("form#verdad_falso")[0].reset(),$("input#pregunta_id").val(a),$("div[data-div='P']").css("display","none"),$("div#vf").css("display","block"),$("div#pregunta").html("").html("Pregunta: [<b>"+r+"</b>], Tipo de pregunta: [<b>"+t+"</b>], Tiempo de duracion: [<b>"+s+"</b>], Valor inicial: [<b>"+i+"</b>], Valor de comodin: [<b>"+d+"]<b/>");break;case 2:$("form#seleccion_simple")[0].reset(),$("input#pregunta_id").val(a),$("div[data-div='P']").css("display","none"),$("div#simple").css("display","block"),$("div#pregunta").html("").html("Pregunta: [<b>"+r+"</b>], Tipo de pregunta: [<b>"+t+"</b>], Tiempo de duracion: [<b>"+s+"</b>], Valor inicial: [<b>"+i+"</b>], Valor de comodin: [<b>"+d+"]<b/>");break;case 3:$("form#desarrollo")[0].reset(),$("input#pregunta_id").val(a),$("div[data-div='P']").css("display","none"),$("div#des").css("display","block"),$("div#pregunta").html("").html("Pregunta: [<b>"+r+"</b>], Tipo de pregunta: [<b>"+t+"</b>], Tiempo de duracion: [<b>"+s+"</b>], Valor inicial: [<b>"+i+"</b>], Valor de comodin: [<b>"+d+"]<b/>");break;default:$("div[data-div='P']").css("display","none"),$("div#pregunta").html("")}})});
