<?php 
require_once'Conexion.php';
Class Tipov
{
private $con;

function __construct(){
$this->con = new Conexion();
}
	public function Save($nombre)
	{
		$sql="INSERT INTO tipo_vehiculo (nombre)
		VALUES ('$nombre')";
		return $this->con->ejecutarConsulta($sql);
	}
	public function update($id,$nombre)
	{
		$sql="UPDATE tipo_vehiculo SET
		nombre='$nombre'
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}
	public function delete($id)
	{
		$sql="DELETE FROM tipo_vehiculo
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}

	public function show($id)
	{
		$sql="SELECT id,nombre FROM tipo_vehiculo
		WHERE id='$id'";
		return $this->con->ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT * FROM tipo_vehiculo";
		return $this->con->ejecutarConsulta($sql);
	}

	public function index()
	{
		$sql="SELECT * FROM tipo_vehiculo";
		return $this->con->ejecutarConsulta($sql);
	}
	}

$t = new Tipov();
// $t->delete(1,'moto');
//$tipo_vehiculo2->update(13,'TI','javier','jimenez','bogota','ll','calle','@@gma',21212,'ss');
?>