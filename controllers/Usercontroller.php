<?php 
// id,name,email,password,level,status,image
include'../model/User.php';
class userController {
  private $user;
  private $rpta;

  private $id;
  private $name;
  private $email;
  private $password;
  private $pass2;
  private $level;
  private $status;
  private $image;
  private $cedu;

  public function __construct(){
    $this->user = new User(); 

    $this->id =isset($_POST["id"])?($_POST["id"]):"";
    $this->name=isset($_POST["name"])?($_POST["name"]):"";
    $this->email =isset($_POST["email"])?($_POST["email"]):"";
    $this->password=isset($_POST["password"])?($_POST["password"]):"";
     $this->level=isset($_POST["level"])?($_POST["level"]):"";
    $this->image =isset($_POST["image"])?($_POST["image"]):"";
    $this->cedu=isset($_POST["cedu"])?($_POST["cedu"]):"";;
  }

  public function userRequest() {
    $op = isset($_GET['op'])?$_GET['op']:NULL;

    if ( !$op || $op == 'index' ) {

      $this->index();

    } elseif ( $op == 'store' ) {

      $this->store($this->id,$this->name,$this->email,$this->password,$this->level,$this->image);

    }
    elseif ( $op == 'show' ) {
      $this->show($this->id);

    }

    elseif ( $op == 'entry' ) {
      $this->entry($this->email,$this->password);

    }

    elseif ( $op == 'entryc' ) {
      $this->entryc($this->cedu);

    }

     elseif ( $op == 'delete' ) {
      $this->delete($this->id);

    }

     elseif ( $op == 'exit' ) {
      $this->exit();

    }
    else {
      $this->showError("Pagina no encontrada", "La operacion".$op." no se encuentra");

    }
  }
 public function index(){
    $this->rpta=$this->user->index();
    $data= Array();

    while ($reg=$this->rpta->fetch_object()){
      $data[]=array(
        "0"=>
        '<button class="btn btn-xs btn-success" 
        onclick="show('.$reg->id.')"><i class="fa fa-pencil">
        </i></button> '.
        '<button class="btn btn-xs btn-danger" onclick="delet('.$reg->id.')">
        <i class="fa fa-trash"></i></button>',
        "1"=>"<img src='../files/".$reg->image."' height='50px' width='50px' >",
        "2"=>$reg->name,
        "3"=>$reg->email,
        "4"=>$reg->level,
        "5"=>$reg->status
        );
    }
    $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
}

  public function store($id,$name,$email,$password,$level,$image){

    include'image.php';
    $pass2=md5(sha1($password));
    if (empty($this->id)){
      $this->rpta=$this->user->store($name,$email,$pass2,$level,$image);
      echo $this->rpta ? 
      "Usuario registrado":
      "Lo sentimos!! hay un error";
    }
    else {
      $this->rpta=$this->user->update($id,$name,$email,$pass2,$level,$image);
      echo $this->rpta ? 
      "Usuario Modificado" : 
      "Lo sentimos!! hay un error en modificar";
    }
  }

  public function show($id){
    $this->rpta=$this->user->show($id);
    echo json_encode($this->rpta);    
  }

  public function delete($id){ 
    $this->user->delete($id);
  }

  public function entry($email,$pass){

       $pass2=md5(sha1($pass));

        $this->rpta=$this->user->check($email, $pass2);
        $fetch=$this->rpta->fetch_object();
        if (isset($fetch))
        {
            $_SESSION['id']=$fetch->id;
            $_SESSION['name']=$fetch->name;
            $_SESSION['level']=$fetch->level;
            $_SESSION['image']=$fetch->image;
        }

        echo json_encode($fetch);
  }

  public function entryc($cedu){
     $this->rpta=$this->user->checkc($cedu);
     $fetch=$this->rpta->fetch_object();
     if (isset($fetch))
     {
         $_SESSION['id']=$fetch->id;
         $_SESSION['nombre']=$fetch->nombre;
         $_SESSION['apellido']=$fetch->apellido;
     }

     echo json_encode($fetch);
}
  public function exit(){
    session_unset();
    session_destroy();
    header("Location: ../index.php");
  }
}

$request = new userController();
$request ->userRequest();
?>