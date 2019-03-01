var tabla;
function init (){
    var getid = document.formu.idp.value;
    index(getid)
    Save();
    select();
    }

    function registrarV(){
        limpiar();
        $('#formu').bootstrapValidator("resetForm",true);
    }
    function select(){
        $.post("../controllers/Vehiculocontroller.php?op=select", function(r){
         $("#idt").html(r);
         // $('#idc').selectpicker('refresh');
        })
        }
    function limpiar(){
        $("#id").val("");
        $("#placa").val("");
        $("#modelo").val("");
        $("#color").val("");
        $("#image").val("");
         //$("#imagenactual").val("");
        $("#btnt").html('btnsave');
        }
    //end limpiar
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
        placa: {
            message: 'placa ivalida',
            validators: {
                notEmpty: {
                    message: 'La placa  del vehiculo no puede ser vacio',
                },
                stringLength: {
                    min: 6,
                    max: 6,
                    message: 'Minimo 6 caracteres y Maximo 6 caracteres'
                },
            }
        },
    }
    }).on('success.form.bv', function(e) {
    e.preventDefault();
    var formData = new FormData($("#formu")[0]);
    $.ajax({
        url: "../controllers/VehiculoController.php?op=Save",
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
    // fin guardar vehiculo x persona


    function index(idp){
        var receptor = idp;
        tabla=$('#example').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [],
            "ajax":
            {
                url: '../controllers/VehiculoController.php?op=index',
                data:{receptor:receptor},
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
            $.post("../controllers/VehiculoController.php?op=delete", {id : id},
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
            function show(id){
                $.post("../controllers/VehiculoController.php?op=show",{id : id}, function(data, status)
                {
                    data = JSON.parse(data);
                    $('#modal').modal('show');
                    $("#id").val(data.id);
                    $("#idp").val(data.idp);
                     $("#idt").val(data.idt).change();
                     $("#marca").val(data.marca).change();
                    $("#placa").val(data.placa);
                    $("#modelo").val(data.modelo);
                    $("#color").val(data.color);
                     $("#btnsave").html('Editar');
                     $("#imagenactual").val(data.image);
                })
                }
init();