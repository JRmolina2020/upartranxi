var tabla;

function init (){
index();
store();
}
function registrarV(){
    limpiar();
    $('#formu').bootstrapValidator("resetForm",true);
}
function limpiar(){
$('#formu').find('[name="name"]').focus();
$("#id").val("");
$("#name").val("");
 $("#email").val("");
 $("#password").val("");
 $("#imagenactual").val("");
  $("#image").val("");
$("#btnt").html('Guardar');
}

function index(){
tabla=$('#example').dataTable(
{
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [],
    "ajax":
    {
        url: '../controllers/Usercontroller.php?op=index',
        type : "get",
        dataType : "json",
        error: function(e){
            console.log(e.responseText);
        }
    },

    "iDisplayLength": 5,//Paginación
    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
}).DataTable();

}


function delet(id){
$.post("../controllers/Usercontroller.php?op=delete", {id : id},
    function(e){
        toastr.success("Usuario eliminado");
        tabla.ajax.reload();
    }
    ).fail(function(error) {
        toastr.error("Error no se pudo completar la peticion");
        tabla.ajax.reload();}
        );

}
function store(e)
{
// VALIDATION formulariocategoria
$('#formu') .bootstrapValidator({
message: 'This value is not valid',
feedbackIcons: {

},

fields: {
   email: {
        message: 'correo del usuario invalido',
        validators: {
            notEmpty: {
                message: 'El correo es obligatorio'
            },
             emailAddress: {
                    message: 'Ingrese un correo valido'
                },

            stringLength: {
                min: 15,
                max: 50,
                message: 'Minimo 15 caracteres y Maximo 50 caracteres '
            }
        }
    },
    name: {
        message: 'Nombre ivalido',
        validators: {
            notEmpty: {
                message: 'El nombre  del usuario no puede ser vacio',
            },
            stringLength: {
                min: 3,
                max: 30,
                message: 'Minimo 3 caracteres y Maximo 30 caracteres'
            },
        }
    },
    password: {
        message: 'Password invalido',
        validators: {
            notEmpty: {
                message: 'El password no puede ser vacio',
            },
            stringLength: {
                min: 3,
                max: 12,
                message: 'Minimo 3 caracteres y Maximo 12 caracteres'
            },
        }
    },
}
}).on('success.form.bv', function(e) {
e.preventDefault(); 
var formData = new FormData($("#formu")[0]);
$.ajax({
    url: "../controllers/Usercontroller.php?op=store",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos)
    {
        limpiar(); 
        $('#formu').bootstrapValidator("resetForm",true); 
        tabla.ajax.reload();
        $('#modal').modal('hide');
    }
});
});
}
function show(id){
$.post("../controllers/Usercontroller.php?op=show",{id : id}, function(data, status)
{
    data = JSON.parse(data);
    $('#modal').modal('show');
    $("#id").val(data.id);   
    $("#name").val(data.name);
     $("#email").val(data.email);
     $("#btnt").html('Editar');
     $("#imagenactual").val(data.image);
})
}
init();


