var tabla;
function init (){
    index();
    Save();
    focus();
    select();
    selectB();
    selectE();
    }

//limpiar cajas de texto y realizar cambios
function focus(){
 $('#formu').find('[name="observacion"]').focus();
}

function registrarV(){
    $("#cuadro").show();
    limpiar();
    $('#formu').bootstrapValidator("resetForm",true);
}

function select(){
    $.post("../controllers/PersonaController.php?op=select", function(r){
     $("#idp").html(r);
    })
      // $('#idc').selectpicker('refresh');
    }

    function selectB(){
        $.post("../controllers/ComparendoController.php?op=selectB", function(r){
         $("#idv").html(r);
        })
         // $('#idc').selectpicker('refresh');
        }

        function selectE(){
            $.post("../controllers/ComparendoController.php?op=selectE", function(r){
             $("#totdetalle").html(r);
            })
             // $('#idc').selectpicker('refresh');
            }
    



function limpiar(){
    $("#id").val("");
    $("#observacion").val("");
    $("#totdetalle").val("");
    $("#total").val("");
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
    observacion: {
        message: 'Nombre ivalido',
        validators: {
            notEmpty: {
                message: 'El nombre  de la persona no puede ser vacio',
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
    url: "../controllers/ComparendoController.php?op=Save",
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
    function index(){
        tabla=$('#example').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [],
            "ajax":
            {
                url: '../controllers/ComparendoController.php?op=index',
                type : "get",
                dataType : "json",
                error: function(e){
                    console.log(e.responseText);
                }
            },
            "iDisplayLength": 5,
             "order": [[ 0, "DESC" ]]//Ordenar (columna,orden)
        }).DataTable();
        }


        function delet(id){
            $.post("../controllers/ComparendoController.php?op=delete", {id : id},
                function(e){ 
                    Swal.fire({
                        title: 'Esta seguro?',
                        text: "una vez eliminado no se podra recuperar la informacion!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Eliminar!'
                      }).then((result) => {
                        if (result.value) {
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
    $.post("../controllers/ComparendoController.php?op=show",{id : id}, function(data, status)
    {
        data = JSON.parse(data);
        $('#modal').modal('show');
        $('#formu').bootstrapValidator("resetForm",true);
        $("#id").val(data.id);
        $("#observacion").val(data.observacion);
        $("#cuadro").hide();
        $("#idv").val(data.idv).change();
        $("#idp").val(data.idp).change();
         $( "#idv" ).prop( "disabled", true );
         $( "#idp" ).prop( "disabled", true );
         $("#btnsave").html('Editar');
    })
    }

    function pagar(id){
        $.post("../controllers/ComparendoController.php?op=pagar", {id : id}, 
        function(e){
            Swal.fire({
                title: 'Esta seguro ?',
                text: "Desea continuar el pago?!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Continuar con el pago de comparendo!'
              }).then((result) => {
                if (result.value) {
                  Swal.fire(
                    'EFECTUADO!',
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
init();