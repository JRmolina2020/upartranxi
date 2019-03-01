<?php 
include'../model/persona.php';
class PersonaController {
  private $persona;
  private $rpta;

  //atributos internos de la entidad Persona
  private $id;
  private $tdoc;
  private $documento;
  private $nombre;
  private $apellido;
  private $ciudad;
  private $barrio;
  private $direccion;
  private $email;
  private $telefono;
  private $image;
  //end
  public function __construct(){
    $this->persona = new Persona();
    //atributos
     $this->id =isset($_POST["id"])?($_POST["id"]):"";
     $this->tdoc =isset($_POST["tdoc"])?($_POST["tdoc"]):"";
     $this->documento =isset($_POST["identi"])?($_POST["identi"]):"";
     $this->nombre =isset($_POST["nombre"])?($_POST["nombre"]):"";
     $this->apellido =isset($_POST["apellido"])?($_POST["apellido"]):"";
     $this->ciudad =isset($_POST["ciudad"])?($_POST["ciudad"]):"";
     $this->barrio =isset($_POST["barrio"])?($_POST["barrio"]):"";
     $this->direccion =isset($_POST["direccion"])?($_POST["direccion"]):"";
     $this->email =isset($_POST["email"])?($_POST["email"]):"";
     $this->telefono =isset($_POST["telefono"])?($_POST["telefono"]):"";
     $this->image =isset($_POST["image"])?($_POST["image"]):"";
  }

  public function PersonaRequest() {
    $op = isset($_GET['op'])?$_GET['op']:NULL;
    if ( !$op || $op == 'index' ) {
      $this->index();
    } elseif ( $op == 'Save' ) {
      $this->Save(
      $this->id,$this->tdoc,$this->documento,$this->nombre,$this->apellido,$this->ciudad,$this->barrio,$this->direccion,$this->email,$this->telefono,$this->image);
    }
    elseif ( $op == 'show' ) {
      $this->show($this->id);
    }
    elseif ( $op == 'select' ) {
      $this->select();
    }

     elseif ( $op == 'delete' ) {
      $this->delete($this->id);

    }else {

      $this->showError("Pagina no encontrada", "La operacion".$op." no se encuentra");

    }
  }

 public function index(){
    $this->rpta=$this->persona->index();
    $data= Array();
    while ($reg=$this->rpta->fetch_object()){
      $data[]=array(
        "0"=>'<div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a onclick="show('.$reg->id.')">Editar</a></li>
          <li><a onclick="delet('.$reg->id.')">Eliminar</a></li>
          <li><a href="../view/vehiculo.php?id='.$reg->id.'" >Automovil</a></li>
        </ul>
      </div>',
        "1"=>$reg->tdoc,
        "2"=>$reg->documento,
        "3"=>$reg->nombre,
        "4"=>$reg->apellido,
        "5"=>$reg->ciudad,
        "6"=>$reg->barrio,
        "7"=>$reg->direccion,
        "8"=>$reg->email,
        "9"=>$reg->telefono,
        "10"=>"<img src='../files/".$reg->perfil."' height='50px' width='50px' >"
        );
    }
    $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
}

  public function Save($id,$tdoc,$documento,$nombre,$apellido,$ciudad,$barrio,$direccion,$email,$telefono,
  $image){
    include'image.php';
    if (empty($this->id)){
      $this->rpta=$this->persona->Save($tdoc,$documento,$nombre,$apellido,$ciudad,$barrio,$direccion,$email,$telefono,
      $image);
      echo $this->rpta ? 
      "Persona registrada":
      "Lo sentimos!! hay un error";
    }
    else {
      $this->rpta=$this->persona->update($id,$tdoc,$nombre,$apellido,$ciudad,$barrio,$direccion,$email,$telefono,
      $image);
      echo $this->rpta ? 
      "Persona Modificada" : 
      "Lo sentimos!! hay un error en modificar";
    }
  }

  public function show($id){
    $this->rpta=$this->persona->show($id);
    echo json_encode($this->rpta);
  }

  public function delete($id){
    $this->persona->delete($id);
  }

  public function select(){
    require_once "../model/persona.php";
    $this->rpta = $this->persona->select();
    while ($reg = $this->rpta->fetch_object())
        {
          echo '<option data-subtext="'.$reg->documento.'"
          value=' . $reg->id . '>'.$reg->nombre .'  ' . $reg->apellido . '</option>';
        }
  }
}

$request = new PersonaController();
$request ->PersonaRequest();
?>