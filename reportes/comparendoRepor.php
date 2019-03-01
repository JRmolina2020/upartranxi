<?php 
  use Dompdf\Dompdf;
  require_once('../public/dompdf/autoload.inc.php');

  $idc=$_GET["idc"];
  
  require_once "../model/Comparendo.php";
  $comparendo= new Comparendo();
  $rspta = $comparendo->comparendoR($idc);
  $dompdf = new DOMPDF();
  $data= Array();

 $html='
 <link rel="stylesheet" href="../public/dompdf/plantilla.css">
<center>
 <img src="../public/images/logo.png" heigth="140" width="140">

 <p>Recuerde pagar sus cuotas en orden consecutivo.
 De lo contrario se incumplira y debera pagar el saldo total de la deuda</p>';
 while ($reg=$rspta->fetch_object()){
  $imagen =$reg->imagen;
 $html.='<h5>DATOS PERSONALES</h5>
 <img src="../files/'.$imagen.'" width=140 heigth=140><br><br>
 ';
 $html.='</center>
 <table>
   <thead>
     <tr>
     <th>Nombre</th>
     <th>Apellido</th>
     <th>Agente</th>
     </tr>
   </thead>
   <tbody>';
       $nombre =$reg->nombre; $apellido =$reg->apellido;
       $agente =$reg->agente;
       $fecha =$reg->fecha;
       $placa=$reg->placa;
       $marca=$reg->marca;
       $modelo=$reg->modelo;
       $lugar =$reg->lugar; $hora =$reg->hora;
       $resena =$reg->resena; $subtotal =$reg->totdetalle;
       $grua =$reg->grua; $total =$reg->total;
   $html.='
     <tr>
     <td>'.$nombre.'</td>
     <td>'.$apellido.'</td>
     <td>'.$agente.'</td>
     </tr>
     </tbody></table>';
     $html.='
    <center>
    <h5>DATOS DEL VEHICULO</h5>
    </center>
    <table>
   <thead>
     <tr>
     <th>Placa</th>
     <th>Modelo</th>
     <th>Marca</th>
     </tr>
   </thead>
   <tbody>
   <tr>
     <td>'.$placa.'</td>
     <td>'.$modelo.'</td>
     <td>'.$marca.'</td>
     </tr>
     </tbody></table>
   ';
    $html.='
    <center>
    <h5>DATOS LOCALES</h5>
    </center>
    <table>
   <thead>
     <tr>
     <th>Fecha</th>
     <th>Lugar</th>
     <th>Hora</th>
     <th>Reseña</th>
     </tr>
   </thead>
   <tbody>
   <tr>
     <td>'.$fecha.'</td>
     <td>'.$lugar.'</td>
     <td>'.$hora.'</td>
     <td>'.$resena.'</td>
     </tr>
     </tbody></table>
   ';

   $html.='
    <center>
    <h5>MULTA ECONOMICA</h5>
    </center>
    <br>
    <table>
   <thead>
     <tr>
     <th>SUBTOTAL</th>
     <th>VLR.GRUA</th>
     <th>TOTAL</th>
     </tr>
   </thead>
   <tbody>
   <tr>
   <td>'.number_format($subtotal, 0, '', '.').'</td>
   <td>'.number_format($grua, 0, '', '.').'</td>
     <td>'.number_format($total, 0, '', '.').'</td>
     </tr>
     </tbody></table>
   ';
     }
  $dompdf->load_html($html);
  $dompdf->render();
  $dompdf->stream(
    "Formato.pdf",
    array(
      "Attachment" => false
    )
  );
?>

