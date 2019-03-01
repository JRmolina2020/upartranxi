<?php
include'../model/vehiculo.php';
class VehiculoController {
  private $vehiculo;
  private $rpta;

  //atributos internos de la entidad vehiculo
  private $id;
  private $idp;
  private $idt;
  private $placa;
  private $marca;
  private $modelo;
  private $color;
  private $image;
  private $getid;
  //end
  public function __construct(){
    $this->vehiculo = new Vehiculo();
    //atributos
     $this->id =isset($_POST["id"])?($_POST["id"]):"";
     $this->idp =isset($_POST["idp"])?($_POST["idp"]):"";
     $this->idt =isset($_POST["idt"])?($_POST["idt"]):"";
     $this->placa =isset($_POST["placa"])?($_POST["placa"]):"";
     $this->marca =isset($_POST["marca"])?($_POST["marca"]):"";
     $this->modelo =isset($_POST["modelo"])?($_POST["modelo"]):"";
     $this->color =isset($_POST["color"])?($_POST["color"]):"";
     $this->image =isset($_POST["image"])?($_POST["image"]):"";
  }

  public function vehiculoRequest() {
    $op = isset($_GET['op'])?$_GET['op']:NULL;
    if ( !$op || $op == 'index' ) {
      $this->index();
    } elseif ( $op == 'Save' ) {
      $this->Save(
      $this->id,$this->idp,$this->idt,$this->placa,$this->marca,$this->modelo,$this->color,$this->image);
    }
    elseif ( $op == 'show' ) {
      $this->show($this->id);
    }

     elseif ( $op == 'delete' ) {
      $this->delete($this->id);

    }
    elseif ( $op == 'select' ) {
      $this->select();
    }
    else {

      $this->showError("Pagina no encontrada", "La operacion".$op." no se encuentra");

    }
  }

 public function index(){
   $getid = $_GET["receptor"];
    $this->rpta=$this->vehiculo->index($getid);
    $data= Array();
    while ($reg=$this->rpta->fetch_object()){
      //obtener color
      $color =$reg->color;
      $data[]=array(
        "0"=>'<div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a onclick="show('.$reg->id.')">Editar</a></li>
          <li><a onclick="delet('.$reg->id.')">Eliminar</a></li>
        </ul>
      </div>',
        "1"=>$reg->tipo,
        "2"=>$reg->placa,
        "3"=>$reg->marca,
        "4"=>$reg->modelo,
        "5"=>"<input type='color' value='".$color."' class='form-control'>",
        "6"=>"<img src='../files/".$reg->image."' height='50px' width='50px' >"
        );
    }
    $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
}

  public function Save($id,$idp,$idt,$placa,$marca,$modelo,$color,$image){
    include'image.php';
    if (empty($this->id)){
      $this->rpta=$this->vehiculo->Save($idp,$idt,$placa,$marca,$modelo,$color,$image);
      echo $this->rpta ? 
      "vehiculo registrado":
      "Lo sentimos!! hay un error";
    }
    else {
      $this->rpta=$this->vehiculo->update($id,$idp,$idt,$placa,$marca,$modelo,$color,$image);
      echo $this->rpta ? 
      "vehiculo Modificado" : 
      "Lo sentimos!! hay un error en modificar";
    }
  }

  public function show($id){
    $this->rpta=$this->vehiculo->show($id);
    echo json_encode($this->rpta);
  }

  public function delete($id){
    $this->vehiculo->delete($id);
  }

  public function select(){
    require_once "../model/Tipo_vehiculo.php";
    $this->tipov = new Tipov();
    $this->rpta = $this->tipov->select();
    while ($reg = $this->rpta->fetch_object())
        {
          echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
        }
  }
}

$request = new VehiculoController();
$request ->vehiculoRequest();
//$request->delete(2);
?>