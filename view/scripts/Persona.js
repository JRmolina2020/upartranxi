var tabla;
function init (){
    index();
    Save();
    focus();
    }

//limpiar cajas de texto y realizar cambios 
function focus(){
 $('#formu').find('[name="identi"]').focus();
}

function registrarV(){
    limpiar();
    $('#formu').bootstrapValidator("resetForm",true);
}
function limpiar(){
    $("#id").val("");
    $("#identi").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#barrio").val("");
    $("#direccion").val("");
    $("#email").val("");
    $("#telefono").val("");
    $("#image").val("");
     //$("#imagenactual").val("");
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
    identi: {
        row: '.col-xs-4',
        message: 'Identificacion invalida',
        validators: {
            notEmpty: {
                message: 'Numero de documento invalido,no puede estar vacio'
            },
            integer: {
                    message:'Digite un numero valido',
                     thousandsSeparator: '',
                        decimalSeparator: '.'
                },

            stringLength: {
                min: 8,
                max: 12,
                message: 'Minimo 8 digitos y Maximo 12 diitos'
            },
            between: {
                        min: 1,
                        max: 999999999999,
                        message: 'El primer digito debe ser  mayor a 0 y debe ser menor a 999999999999'
                    },

                    regexp: {
                    regexp: /^[a-zA-Z0-9_\.]+$/,
                    message: 'No se permiten espacios',
                    }
        }
    },
    nombre: {
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
    apellido: {
        message: 'Apellido ivalido',
        validators: {
            notEmpty: {
                message: 'El Apellido  de la persona no puede ser vacio',
            },
            stringLength: {
                min: 3,
                max: 30,
                message: 'Minimo 3 caracteres y Maximo 30 caracteres'
            },
        }
    },
    direccion: {
        message: 'Direccion invalida',
        validators: {
            notEmpty: {
                message: 'La direccion es obligatoria,no puede estar vacia.'
            },
            
            stringLength: {
                min: 6,
                max: 30,
                message: 'Minimo 6 caracteres y Maximo 30 caracteres '
            },
        }
    },
    
    telefono: {
        message:'telefono invalido',
        validators: {
            notEmpty: {
                message: 'El Telefono es obligatorio,no puede estar vacio'
            },
             numeric: {
                        message: 'Solo se aceptan valores numericos',
                        
                    },
            stringLength: {
                min: 7,
                max: 10,
                message: 'Minimo 7 digitos y Maximo 10 digitos'
            },
                    regexp: {
                    regexp: /^[a-zA-Z0-9_\.]+$/,
                    message: 'No se permiten espacios'
                    }
            
        }
    },
}
}).on('success.form.bv', function(e) {
e.preventDefault();
var formData = new FormData($("#formu")[0]);
$.ajax({
    url: "../controllers/PersonaController.php?op=Save",
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
// fin guardar personas
//ciudad y barrios
function ciudadvalidate(){
    var vciudad = document.formu.ciudad.value;
    if(vciudad=='Valledupar'){
        var barrio = ["Mayales.", "1 de enero","Panama","URB.Galan","Los cocos","Manuelitas","San fernando","El pupo",
        "Casimiro","Simon bolivar","V.miriam","El poblado","Mareigua","12 de octubre","Kennedy","Candelaria.S",
        "Candelaria N","Sabanas","V.clara"];
    
    }else if (vciudad =='Medellin'){
         var barrio = ["Santa Cruz","La isla ","El poblado","Villa Niza","La rosa","El Pomar","La cruz"
         ,"La onda","El Raizal","La salle","Oriente","Berlin","Sevilla","San pedro","Brasilia"];
    }
     document.getElementById("barrio").length=0;
      var select = document.getElementById("barrio"); //Seleccionamos el select
        for(var i=0; i < barrio.length; i++){ 
            var option = document.createElement("option"); //Creamos la opcion
            option.innerHTML = barrio[i]; //Metemos el texto en la opción
            select.appendChild(option); //Metemos la opción en el select
        }
    }
//end ciudad y barrios
    function index(){
        tabla=$('#example').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [],
            "ajax":
            {
                url: '../controllers/PersonaController.php?op=index',
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
            $.post("../controllers/PersonaController.php?op=delete", {id : id}, 
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
    $.post("../controllers/PersonaController.php?op=show",{id : id}, function(data, status)
    {
        data = JSON.parse(data);
        $('#modal').modal('show');
        $("#id").val(data.id);
        $("#identi").val(data.documento);
        $( "#identi" ).prop( "disabled", true );
         $("#nombre").val(data.nombre);
         $("#apellido").val(data.apellido);
         $("#tdoc").val(data.tdoc).change();
         $("#ciudad").val(data.ciudad).change();
         $("#barrio").val(data.barrio).change();
        $("#direccion").val(data.direccion);
        $("#email").val(data.email);
        $("#telefono").val(data.telefono);
         $("#btnsave").html('Editar');
         $("#imagenactual").val(data.perfil);
    })
    }

init();