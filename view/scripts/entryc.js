
function init(){
    validate_f();
    validate();
    }
    function validate_f(){
        $("#formu").on('submit',function(e)
        {
            e.preventDefault();
            cedu=$("#cedu").val();
            $.post("controllers/Usercontroller.php?op=entryc",{"cedu":cedu}
              ,function(data){
                    data = JSON.parse(data);
                    if(data!=null)
                    {
                    $(location).attr("href","view/ciudadano.php");
                    }
                    else
                    {
                    toastr.error("No existe en nuestra base de datos");
                    }
                });
        })
    }
    function limpiar(){
        $("#cedu").focus(); 
        $("#cedu").val("");
    }
    function validate(){
        $(document).ready(function() {
            $('#formu').bootstrapValidator({
    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
    feedbackIcons: {
    },
    fields: {
        email: {
            message: 'La cedula no puede estar vacia',
            validators: {
                notEmpty: {
                   message: 'La cedula es obligatoria'
               },
               stringLength: {
                   min: 7,
                   max: 12,
                   message: 'Minimo 7 caracteres y Maximo 12 caracteres '
               }
           }
       },
    }
    })
        });
    }
    init();
    