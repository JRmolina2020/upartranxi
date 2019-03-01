<?php 
include'../model/comparendo.php';
class ComparendoController {
  private $comparendo;
  private $rpta;
  private $rpta2;

  //atributos internos de la entidad comparendo
  private $id;
  private $idp;
  private $idu;
  private $idv;
  private $hora;
  private $lugar;
  private $observacion;
  private $totdetalle;
  private $totgrua;


  private $idi;
  private $vehiculo;
  private $estandar;

  //end
  public function __construct(){
    $this->comparendo = new Comparendo();
    //atributos
     $this->id =isset($_POST["id"])?($_POST["id"]):"";
     $this->idp =isset($_POST["idp"])?($_POST["idp"]):"";
     $this->idu =isset($_POST["idu"])?($_POST["idu"]):"";
     $this->idv =isset($_POST["idv"])?($_POST["idv"]):"";
     $this->idA=4;
     $this->lugar ='VALLEDUPAR';
     $this->observacion =isset($_POST["observacion"])?($_POST["observacion"]):"";
     $this->totdetalle =isset($_POST["totdetalle"])?($_POST["totdetalle"]):"";
     $this->totgrua =isset($_POST["totgrua"])?($_POST["totgrua"]):"";
  }

  public function comparendoRequest() {
    $op = isset($_GET['op'])?$_GET['op']:NULL;
    if ( !$op || $op == 'index' ) {
      $this->index();
    } elseif ( $op == 'Save' ) {
      $this->Save(
      $this->id,$this->idp,$this->idu,$this->idv,$this->lugar,$this->observacion,$this->totdetalle,$this->totgrua);
    }
    elseif ( $op == 'indexC' ) {
      $this->indexC();
    }
    elseif ( $op == 'show' ) {
      $this->show($this->id);
    }

    elseif ( $op == 'selectB' ) {
      $this->selectB();
    }
    elseif ( $op == 'selectE' ) {
      $this->selectE();
    }
    elseif ( $op == 'pagar' ) {
      $this->pagar($this->id);
    }
     elseif ( $op == 'delete' ) {
      $this->delete($this->id);

    }else {

      $this->showError("Pagina no encontrada", "La operacion".$op." no se encuentra");

    }
  }

 public function index(){
  date_default_timezone_set("America/Bogota");
 

   $ida=$_SESSION['id'];
   if($_SESSION['level']=='Admin'){
    $this->rpta=$this->comparendo->index();
   }else{
    $this->rpta=$this->comparendo->index2($ida);
   }
    $data= Array();
    $val=$_SESSION['level'];
    while ($reg=$this->rpta->fetch_object()){
      $subtot=number_format($reg->totdetalle, 0, '', '.');
      $grua=number_format($reg->grua, 0, '', '.');
      $tot=number_format($reg->total, 0, '', '.');
      //HORA
      $data[]=array(
        "0"=>
      '<div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a onclick="show('.$reg->id.')">Editar</a></li>
          <li><a onclick="delet('.$reg->id.')">Eliminar</a></li>
          <li><a href="../reportes/comparendoRepor.php?idc='.$reg->id.'" >Comparendo</a></li>
        </ul>
      </div>',
      "1"=>'<span class="label label-info">'.$reg->id.'</span>',
      "2"=>($reg->estado)=='PENDIENTE'?
      '<span class="label bg-red" onclick="pagar('.$reg->id.')">PENDIENTE</span>':
       '<span class="label bg-green">PAGADO</span>',
       "3"=>$reg->doc,
        "4"=>$reg->nombre,
        "5"=>$reg->apellido,
        "6"=>$reg->agente,
        "7"=>$reg->placa,
        "8"=>"<img src='../files/".$reg->imagen."' height='50px' width='50px' >",
        "9"=>$reg->fecha,
        "10"=>$reg->lugar,
        "11"=>$reg->hora,
        "12"=>$reg->resena,
        "13"=>$subtot,
        "14"=>$grua,
        "15"=>$tot
        );
    }
    $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
}


public function indexC(){
  $idc=$_SESSION['id'];
   $this->rpta=$this->comparendo->indexC($idc);
   $data= Array();
   while ($reg=$this->rpta->fetch_object()){
     $subtot=number_format($reg->totdetalle, 0, '', '.');
     $grua=number_format($reg->grua, 0, '', '.');
     $tot=number_format($reg->total, 0, '', '.');
     $data[]=array(
       "0"=>
     '<div class="dropdown">
       <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion
       <span class="caret"></span></button>
       <ul class="dropdown-menu">
         <li><a href="../reportes/comparendoRepor.php?idc='.$reg->id.'" >Comparendo</a></li>
       </ul>
     </div>',
     "1"=>'<span class="label label-info">'.$reg->id.'</span>',
     "2"=>($reg->estado)=='PENDIENTE'?
     '<span class="label label-danger">PENDIENTE</span>':
      '<span class="label label-primary">PAGADO</span>',
       "3"=>$reg->nombre,
       "4"=>$reg->apellido,
       "5"=>$reg->agente,
       "6"=>$reg->placa,
       "7"=>"<img src='../files/".$reg->imagen."' height='50px' width='50px' >",
       "8"=>$reg->fecha,
       "9"=>$reg->lugar,
       "10"=>$reg->hora,
       "11"=>$reg->resena,
       "12"=>$subtot,
       "13"=>$grua,
       "14"=>$tot
       );
   }
   $results = array(
     "sEcho"=>1, //Información para el datatables
     "iTotalRecords"=>count($data), //enviamos el total registros al datatable
     "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
     "aaData"=>$data);
   echo json_encode($results);
}


  public function Save($id,$idp,$idu,$idv,$lugar,$observacion,$totdetalle,$totgrua){
    if (empty($this->id)){
      $this->rpta=$this->comparendo->Save($idp,$idu,$idv,$lugar,$observacion,$totdetalle,$totgrua);
      echo $this->rpta ?
      "comparendo registrado":
      "Lo sentimos!! hay un error";
    }
    else {
      $this->rpta=$this->comparendo->update($id,$observacion);
      echo $this->rpta ?
      "comparendo Modificada" :
      "Lo sentimos!! hay un error en modificar";
    }
  }

  public function show($id){
    $this->rpta=$this->comparendo->show($id);
    echo json_encode($this->rpta);
  }

  public function delete($id){
    $this->rpta=$this->comparendo->delete($id);
  }

  public function pagar($id){
    $this->comparendo->pagar($id);
  }


  public function selectB(){
    require_once "../model/Vehiculo.php";
    $this->vehiculo = new Vehiculo();
    $this->rpta = $this->vehiculo->selectB();
    while ($reg = $this->rpta->fetch_object())
        {
          echo '<option data-subtext="'.$reg->nombre.''.$reg->apellido.'"
          value=' . $reg->idi. '>'.$reg->placa .'</option>';
        }
  }

  public function selectE(){
    require_once "../model/Estandar.php";
    $this->estandar = new Estandar();
    $this->rpta = $this->estandar->selectE();
    while ($reg = $this->rpta->fetch_object())
        {
          echo '<option data-subtext="'.$reg->nombre.'"
          value=' . $reg->valor. '>'.$reg->descrip .'</option>';
        }
  }
}

$request = new comparendoController();;
$request ->comparendoRequest();



//$request->Save(9,28,6,14,'2019-02-0','valledupar','29:01:0','ewew',10,222,12);
?>