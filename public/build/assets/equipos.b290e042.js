import"./app.68b88f4c2.js";import"./jquery.validate.ca30e8c3.js";import"./jquery.a90e4a85.js";import"./_commonjsHelpers.b8add541.js";$(document).ready(function(){$("table#equipo").DataTable({language:{sProcessing:"Procesando...",sLengthMenu:"Mostrar _MENU_ registros",sZeroRecords:"No se encontraron resultados",sEmptyTable:"Ning\xFAn dato disponible en esta tabla",sInfo:"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",sInfoEmpty:"Mostrando registros del 0 al 0 de un total de 0 registros",sInfoFiltered:"(filtrado de un total de _MAX_ registros)",sInfoPostFix:"",sSearch:"Buscar:",sUrl:"",sInfoThousands:",",sLoadingRecords:"Cargando...",oPaginate:{sFirst:"Primero",sLast:"\xC3\u0161ltimo",sNext:"Siguiente",sPrevious:"Anterior"},oAria:{sSortAscending:": Activar para ordenar la  columna de manera ascendente",sSortDescending:": Activar para ordenar la columna de manera descendente"}}}),$("form#nuevo_equipo").validate({rules:{nombre:{required:!0},descripcion:{required:!0}},messages:{nombre:{required:"Nombre del equipo requerido"},descripcion:{required:"Iglesia o lugar de precedencia"}},submitHandler:function(){confirm("\xBFConfirma el registro de los datos?")&&$("form#nuevo_equipo")[0].submit()}}),$("form#editar_equipo").validate({rules:{nombre:{required:!0},iglesia_id:{required:"Iglesia o lugar de precedencia"}},messages:{nombre:{required:"Nombre del equipo requerido"},descripcion:{required:"Iglesia o lugar de precedencia"}},submitHandler:function(){confirm("\xBFConfirma la actualizaci\xF3n los datos? ACTUALIZAR")&&$("form#editar_equipo")[0].submit(),console.log($("form#editar_equipo").serialize())}})});
