import"./app.68b88f4c2.js";import"./jquery.validate.ca30e8c3.js";import"./jquery.a90e4a85.js";import"./_commonjsHelpers.b8add541.js";$(document).ready(function(){$("table#dificultades").DataTable({language:{sProcessing:"Procesando...",sLengthMenu:"Mostrar _MENU_ registros",sZeroRecords:"No se encontraron resultados",sEmptyTable:"Ning\xFAn dato disponible en esta tabla",sInfo:"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",sInfoEmpty:"Mostrando registros del 0 al 0 de un total de 0 registros",sInfoFiltered:"(filtrado de un total de _MAX_ registros)",sInfoPostFix:"",sSearch:"Buscar:",sUrl:"",sInfoThousands:",",sLoadingRecords:"Cargando...",oPaginate:{sFirst:"Primero",sLast:"\xC3\u0161ltimo",sNext:"Siguiente",sPrevious:"Anterior"},oAria:{sSortAscending:": Activar para ordenar la  columna de manera ascendente",sSortDescending:": Activar para ordenar la columna de manera descendente"}},columns:[{data:"id"},{data:"dificultad"},{data:"puntaje"},{data:"tiempo"},{data:"status",render:function(e,r,t){switch(e){case"0":return"<label class='text text-danger'><strong>Inactivo</strong></label>";case"1":return"<label class='text text-success'><strong>Activo</strong></label>"}}},{data:"defaultContent"}]}),$("form#nueva_dificultad").validate({rules:{dificultad:{required:!0},puntaje:{required:!0,number:!0},tiempo:{required:!0,number:!0},status:{required:!0}},messages:{dificultad:{required:"Descripci\xF3n de la dificultad requerido"},puntaje:{required:"valor del puntaje requerido",number:"El valor del puntaje debe ser num\xE9rico"},tiempo:{required:"Valor del tiempo de duraci\xF3n es requerido",number:"El valor del tiempo de duraci\xF3n debe ser num\xE9rico"},status:{required:"Debe seleccionar una opci\xF3n"}},submitHandler:function(){confirm("\xBFConfirma el registro de los datos?")&&$("form#nueva_dificultad")[0].submit()}}),$("form#editar_dificultad").validate({rules:{dificultad:{required:!0},puntaje:{required:!0,number:!0},tiempo:{required:!0,number:!0},status:{required:!0}},messages:{dificultad:{required:"Descripci\xF3n de la dificultad requerido"},puntaje:{required:"valor del puntaje requerido",number:"El valor del puntaje debe ser num\xE9rico"},tiempo:{required:"Valor del tiempo de duraci\xF3n es requerido",number:"El valor del tiempo de duraci\xF3n debe ser num\xE9rico"},status:{required:"Debe seleccionar una opci\xF3n"}},submitHandler:function(){confirm("\xBFConfirma la actualizaci\xF3n los datos? ACTUALIZAR")&&$("form#editar_dificultad")[0].submit()}})});
