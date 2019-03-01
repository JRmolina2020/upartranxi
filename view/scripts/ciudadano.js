
init();
function init(){
index();
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
            url: '../controllers/ComparendoController.php?op=indexC',
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



