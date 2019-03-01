<?php 
//if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
include'../model/Estandar.php';
class estandarController {
  private $estandar;
  private $rpta;
  private $id;
  private $nombre;
  private $descrip;
  private $valor;
  public function __construct(){
    $this->estandar = new Estandar(); 
    $this->id =isset($_POST["id"])?($_POST["id"]):"";
    $this->nombre =isset($_POST["nombre"])?($_POST["nombre"]):"";
    $this->descrip =isset($_POST["descrip"])?($_POST["descrip"]):"";
    $this->valor =isset($_POST["valor"])?($_POST["valor"]):"";
  }
  public function estandarRequest() {
    $op = isset($_GET['op'])?$_GET['op']:NULL;

    if ( !$op || $op == 'index' ) {

      $this->index();

    } elseif ( $op == 'store' ) {

      $this->save($this->id,$this->nombre,$this->descrip,$this->valor);

    }
    elseif ( $op == 'show' ) {
      $this->show($this->id);

    }

     elseif ( $op == 'delete' ) {
      $this->delete($this->id);

    }else {

      $this->showError("Pagina no encontrada", "La operacion".$op." no se encuentra");

    }
  }

 public function index(){
    $this->rpta=$this->estandar->index();
    $data= Array();
    while ($reg=$this->rpta->fetch_object()){
      $tot=number_format($reg->valor, 0, '', '.');
      $data[]=array(
        "0"=>
        '<button class="btn btn-xs btn-success" 
        onclick="show('.$reg->id.')"><i class="fa fa-pencil">
        </i></button> '.
        '<button class="btn btn-xs btn-danger" onclick="delet('.$reg->id.')">
        <i class="fa fa-trash"></i></button>',
        "1"=>$reg->nombre,
        "2"=>$reg->descrip,
        "3"=>$tot
        );
    }
    $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
}

  public function save($id,$nombre,$descrip,$valor){
    if (empty($this->id)){
      $this->rpta=$this->estandar->Save($nombre,$descrip,$valor);
      echo $this->rpta ? 
      "Estandar registrado":
      "Lo sentimos!! hay un error";
    }
    else {
      $this->rpta=$this->estandar->update($id,$nombre,$descrip,$valor);
      echo $this->rpta ?
      "Estandar Modificado" :
      "Lo sentimos!! hay un error en modificar";
    }
  }

  public function show($id){
    $this->rpta=$this->estandar->show($id);
    echo json_encode($this->rpta);
  }

  public function delete($id){
    $this->estandar->delete($id);
  }
}

$request = new estandarController();
$request ->estandarRequest();

//}else {
//header("HTTP/1.0 403 Forbidden");
//exit;
//}
?>