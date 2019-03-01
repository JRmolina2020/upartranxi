
<?php include'../model/Conexion.php'; 
if (!isset($_SESSION['name'])) {
	header('location:../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../public/css/bootstrap.min.css">
<link rel="stylesheet" href="../public/css/font-awesome.css">
<link rel="stylesheet" href="../public/css/AdminLTE.min.css">
<link rel="stylesheet" href="../public/css/_all-skins.min.css">
<link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
<!-- <link rel="shortcut icon" href="../public/img/favicon.ico"> -->
<link rel="stylesheet" type="text/css" href="../public/css/generalestilos.css">
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
<link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
<link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>


<link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
<!-- VALIDATOR -->
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
<link rel="stylesheet" type="text/css" href="../public/css/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
<header class="main-header">
<a href="../../index2.html" class="logo">
<span class="logo-mini"><b>G</b>PW</span>
<span class="logo-lg"><b>Admin</b>PW</span>
</a>
<nav class="navbar navbar-static-top">
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
</nav>
</header>
<aside class="main-sidebar">
<section class="sidebar">
<div class="user-panel">
<div class="pull-left image">
<img src="../files/<?php echo $_SESSION['image']?>" width="70px" height="70px" class="img-circle" alt="User Image">
</div>
<div class="pull-left info">
<p><?php echo $_SESSION['name']?></p>
<a href="#"><i class="fa fa-circle text-success"></i>Enlinea</a>
</div>
<br><br>
</div>
<ul class="sidebar-menu" data-widget="tree">
<li class="header"><?php echo $_SESSION['level']?></li>
<!-- ________________________________________ -->
<?php if($_SESSION['level']=='Admin'){
?>
<li class="treeview">
<a href="home.php">
<i class=" fa fa-home"></i> <span>Inicio</span>
<span class="pull-right-container">
</span>
</a>
</li>
<li class="treeview">
<a href="usuario.php">
<i class=" fa fa-users"></i> <span>Agentes</span>
<span class="pull-right-container">
</span>
</a>
</li>

<li class="treeview">
<a href="persona.php">
<i class=" fa fa-user"></i> <span>Ciudadano</span>
<span class="pull-right-container">
</span>
</a>
</li>
<li class="treeview">
<a href="estandar.php">
<i class=" fa fa-edit"></i> <span>Leyes</span>
<span class="pull-right-container">
</span>
</a>
</li>
<li class="treeview">
<a href="#">
<i class="fa fa-car"></i> <span>Vehiculos</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
</a>
<ul class="treeview-menu">
<li><a href="tipov.php"><i class="fa fa-car" ></i>Tipo de vehiculo</a></li>
</ul>
</li>
<li class="treeview">
<a href="comparendo.php">
<i class=" fa fa-edit"></i> <span>Comparendo</span>
<span class="pull-right-container">
</span>
</a>
</li>

<li class="treeview">
<a href="../controllers/Usercontroller.php?op=exit">
<i class=" fa fa-edit"></i> <span>salir</span>
<span class="pull-right-container">
</span>
</a>
</li>
<?php }else if($_SESSION['level']=='Agente'){?>
<li class="treeview">
<a href="home.php">
<i class=" fa fa-home"></i> <span>Inicio</span>
<span class="pull-right-container">
</span>
</a>
</li>
<li class="treeview">
<a href="comparendo.php">
<i class=" fa fa-edit"></i> <span>Comparendo</span>
<span class="pull-right-container">
</span>
</a>
</li>
<li class="treeview">
<a href="../controllers/Usercontroller.php?op=exit">
<i class=" fa fa-edit"></i> <span>salir</span>
<span class="pull-right-container">
</span>
</a>
</li>
	<?php } ?>
</ul>
</section>
</aside>








