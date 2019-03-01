<?php include'../model/Conexion.php'; 
if (!isset($_SESSION['nombre'])) {
	header('location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
<link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
<link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!-- DATATABLES -->
<script src="../public/datatables/jquery.dataTables.min.js"></script>
<script src="../public/datatables/dataTables.buttons.min.js"></script>
<script src="../public/datatables/buttons.html5.min.js"></script>
<script src="../public/datatables/buttons.colVis.min.js"></script>
<script src="../public/datatables/jszip.min.js"></script>
<script src="../public/datatables/pdfmake.min.js"></script>
<script src="../public/datatables/vfs_fonts.js"></script>
<title>Document</title>
</head>
<body>
<div class="container-fluid">
<div class="panel-body table-responsive" id="divlistado">
            <!-- BODY -->
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <th>Opciones</th>
                <th>#pago</th>
                <th>Estado</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Agente</th>
                <th>Placa</th>
                <th>Imagen</th>
                <th>Fecha</th>
                <th>Lugar</th>
                <th>Hora</th>
                <th>Reseña</th>
                <th>Subtotal</th>
                <th>$Grua</th>
                <th>Total</th>
              </thead>
              <tbody>
              </tbody>
            </table>
            <!-- END BODY -->
            </div>
</div>
<script src="scripts/ciudadano.js"></script>
</body>
</html>