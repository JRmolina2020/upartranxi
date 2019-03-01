<?php 
//if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
include'../model/Tipo_vehiculo.php';
class tipovController {
  private $tipov;
  private $rpta;
  private $id;
  private $nombre;
  public function __construct(){
    $this->tipov = new Tipov(); 
    $this->id =isset($_POST["id"])?($_POST["id"]):"";
    $this->nombre =isset($_POST["nombre"])?($_POST["nombre"]):"";
  }
  public function tipovRequest() {
    $op = isset($_GET['op'])?$_GET['op']:NULL;

    if ( !$op || $op == 'index' ) {

      $this->index();

    } elseif ( $op == 'store' ) {

      $this->save($this->id,$this->nombre);

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
    $this->rpta=$this->tipov->index();
    $data= Array();
    while ($reg=$this->rpta->fetch_object()){
      $data[]=array(
        "0"=>
        '<button class="btn btn-xs btn-success" 
        onclick="show('.$reg->id.')"><i class="fa fa-pencil">
        </i></button> '.
        '<button class="btn btn-xs btn-danger" onclick="delet('.$reg->id.')">
        <i class="fa fa-trash"></i></button>',
        "1"=>$reg->nombre
        );
    }
    $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
}

  public function save($id,$nombre){
    if (empty($this->id)){
      $this->rpta=$this->tipov->Save($nombre);
      echo $this->rpta ? 
      "Tipo de vehiculo registrado":
      "Lo sentimos!! hay un error";
    }
    else {
      $this->rpta=$this->tipov->update($id,$nombre);
      echo $this->rpta ? 
      "Tipo de vehiculo Modificado" : 
      "Lo sentimos!! hay un error en modificar";
    }
  }

  public function show($id){
    $this->rpta=$this->tipov->show($id);
    echo json_encode($this->rpta);    
  }

  public function delete($id){ 
    $this->tipov->delete($id);
  }
}

$request = new tipovController();
$request ->tipovRequest();

//}else {
//header("HTTP/1.0 403 Forbidden");
//exit;
//}
?>