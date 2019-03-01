<?php 
require_once'Conexion.php';
Class Persona
{
private $con;

function __construct(){
$this->con = new Conexion();
}
	public function Save($tdoc,$documento,$nombre,$apellido,$ciudad,$barrio,$direccion,$email,$telefono,
	$image)
	{
		$sql="INSERT INTO persona (tdoc,documento,nombre,apellido,ciudad,barrio,direccion,email,telefono,perfil)
		VALUES ('$tdoc','$documento','$nombre','$apellido','$ciudad','$barrio','$direccion','$email','$telefono','$image')";
		return $this->con->ejecutarConsulta($sql);
	}
	public function update($id,$tdoc,$nombre,$apellido,$ciudad,$barrio,$direccion,$email,$telefono,
	$image)
	{
		$sql="UPDATE persona SET
		tdoc='$tdoc',
		nombre='$nombre',
		apellido='$apellido',
		ciudad='$ciudad',
		barrio='$barrio',
		direccion='$direccion',
		email='$email',
		telefono='$telefono',
		perfil='$image'
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}
	public function delete($id)
	{
		$sql="DELETE FROM persona
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}

	public function show($id)
	{
		$sql="SELECT id,documento,tdoc,nombre,apellido,telefono,ciudad,direccion,email,perfil,barrio FROM persona
		WHERE id='$id'";
		return $this->con->ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT * FROM persona";
		return $this->con->ejecutarConsulta($sql);
	}

	public function index()
	{
		$sql="SELECT * FROM persona";
		return $this->con->ejecutarConsulta($sql);
	}
	}

//$Persona2 = new Persona();
//$Persona2->update(13,'TI','javier','jimenez','bogota','ll','calle','@@gma',21212,'ss');
?>