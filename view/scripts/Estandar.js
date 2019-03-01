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
    $("#valor").val("");
    $("#btnt").html('btnsave');
    }
//end limpiar

function mayus(e) {
    e.value = e.value.toUpperCase();
}
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
                message: 'Las sigla  del estandar no pueden estar vacias',
            },
            stringLength: {
                min: 1,
                max: 3,
                message: 'Minimo 1 caracter y Maximo 3 caracteres'
            },
        }
    },

    descrip: {
        message: 'Nombre ivalido',
        validators: {
            notEmpty: {
                message: 'añada una descripcion',
            },
        }
    },
}
}).on('success.form.bv', function(e) {
e.preventDefault();
var formData = new FormData($("#formu")[0]);
$.ajax({
    url: "../controllers/EstandarController.php?op=store",
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
                url: '../controllers/EstandarController.php?op=index',
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
            $.post("../controllers/EstandarController.php?op=delete", {id : id}, 
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
    $.post("../controllers/EstandarController.php?op=show",{id : id}, function(data, status)
    {
        data = JSON.parse(data);
        $('#modal').modal('show');
        $("#id").val(data.id);
        $("#nombre").val(data.nombre);
        $("#descrip").val(data.descrip);
        $("#valor").val(data.valor);
    })
    }

init();