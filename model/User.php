<?php 
require_once 'Conexion.php';
Class user
{
private $con;
// id,name,email,password,level,status,image
function __construct(){
$this->con = new Conexion();
}
	public function store($name,$email,$password,$level,$image)
	{
		$sql="INSERT INTO user (name,email,password,level,status,image)
		VALUES ('$name','$email','$password','$level','1','$image')";
		return $this->con->ejecutarConsulta($sql);
	}

	public function update($id,$name,$email,$password,$level,$image)
	{
		$sql="UPDATE user SET 
		name='$name',
		email='$email',
		password='$password',
        level='$level',
        image='$image'
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}
	public function delete($id)
	{
		$sql="DELETE FROM user  
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}

	public function show($id)
	{
		$sql="SELECT id,name,email,password,level,status,image FROM user 
		WHERE id='$id'";
		return $this->con->ejecutarConsultaSimpleFila($sql);
	}

	public function index()
	{
		$sql="SELECT id,name,email,password,level,status,image FROM user";
		return $this->con->ejecutarConsulta($sql);	
	}

	public function totalUser()
	{
		$sql="SELECT count(id) as total FROM user WHERE level='Agente'";
		return $this->con->ejecutarConsulta($sql);
	}

	public function check($email,$pass){
     $sql="SELECT id,name,image,level FROM user WHERE email='$email' AND password='$pass'"; 
       return $this->con->ejecutarConsulta($sql);
	}

	public function checkc($cedu){
		$sql="SELECT id,nombre,apellido FROM persona WHERE documento='$cedu'";
			return $this->con->ejecutarConsulta($sql);
 }

	}
	$o = new User();
	//$o->update(1,'rodo','heivon@',122,'asistente','sss');
?>