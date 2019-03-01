var tabla;
function init (){
    index();
    Save();
    focus();
    }

//limpiar cajas de texto y realizar cambios 
function focus(){
 $('#formu').find('[name="nombre"]').focus();
}
function registrarV(){
    limpiar();
    $('#formu').bootstrapValidator("resetForm",true);
}
function limpiar(){
    $("#id").val("");
    $("#nombre").val("");
    $("#btnt").html('btnsave');
    }
//end limpiar
// Funcion para guardar personas
function Save(e)
{
// VALIDATION
$('#formu') .bootstrapValidator({
message: 'This value is not valid',
feedbackIcons: {

},

fields: {
    //validacines de campos inputs segun requerimientos
    //especificados
    nombre: {
        message: 'Nombre ivalido',
        validators: {
            notEmpty: {
                message: 'El nombre  del tipo de vehiculo no puede estar vacio',
            },
            stringLength: {
                min: 3,
                max: 30,
                message: 'Minimo 3 caracteres y Maximo 30 caracteres'
            },
        }
    },
}
}).on('success.form.bv', function(e) {
e.preventDefault();
var formData = new FormData($("#formu")[0]);
$.ajax({
    url: "../controllers/TipovController.php?op=store",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos)
    {    
        limpiar(); 
        $('#formu').bootstrapValidator("resetForm",true); 
        $('#modal').modal('hide');
        tabla.ajax.reload();
        
    }
});
});
}
// fin guardar tipo de vehiculo

    function index(){
        tabla=$('#example').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [],
            "ajax":
            {
                url: '../controllers/TipovController.php?op=index',
                type : "get",
                dataType : "json",
                error: function(e){
                    console.log(e.responseText);
                }
            },
            "iDisplayLength": 16,
             "order": [[ 0, "DESC" ]]//Ordenar (columna,orden)
        }).DataTable();
        }

        function delet(id){
            $.post("../controllers/TipovController.php?op=delete", {id : id}, 
                function(e){ 
                    Swal.fire({
                        title: 'Esta seguro?',
                        text: "una vez eliminado no se podra recuperar la informacion!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Eliminar Persona!'
                      }).then((result) => {
                        if (result.value) {
                          Swal.fire(
                            'Eliminado!',
                            'Peticion exitosa.',
                            'success'
                          )
                          tabla.ajax.reload();
                        }
                      })
                }
                ).fail(function(error) {
                    toastr.error("Error no se pudo completar la peticion");
                    tabla.ajax.reload();}
                    );
            }
//modificar persona
function show(id){
    $.post("../controllers/TipovController.php?op=show",{id : id}, function(data, status)
    {
        data = JSON.parse(data);
        $('#modal').modal('show');
        $("#id").val(data.id);
        $("#nombre").val(data.nombre);
         $("#btnsave").html('Editar');
    })
    }

init();