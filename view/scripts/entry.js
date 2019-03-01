
function init(){
validate_f();
validate();
$("#password").focus();
}
function validate_f(){
    $("#formu").on('submit',function(e)
    {
        e.preventDefault();
        email=$("#email").val();
        password=$("#password").val();
        $.post("controllers/Usercontroller.php?op=entry",{"email":email,"password":password}
          ,function(data){
                data = JSON.parse(data);
                if(data!=null)
                {
                $(location).attr("href","view/home.php");
                }
                else
                {
                toastr.error("Error! verifique sus datos");
                }
            });
    })
}
function limpiar(){
    $("#email").focus(); 
    $("#email").val("");
    $("#password").val("");
}
function validate(){
    $(document).ready(function() {
        $('#formu').bootstrapValidator({
// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
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
   password: {
    validators: {
        notEmpty: {
           message: 'El password es obligatorio y no puede estar vacio.'
       },
       stringLength: {
           min: 4,
           max: 11 ,
           message: 'Minimo 6 caracteres minimo 11 caracteres'
       },
   }
},
}
})
    });
}
init();
