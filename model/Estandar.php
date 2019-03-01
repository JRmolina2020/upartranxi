<?php 
require_once'Conexion.php';
Class Estandar
{
private $con;

function __construct(){
$this->con = new Conexion();
}
	public function Save($nombre,$descrip,$valor)
	{
		$sql="INSERT INTO estandar (nombre,descrip,valor)
		VALUES ('$nombre','$descrip','$valor')";
		return $this->con->ejecutarConsulta($sql);
	}
	public function update($id,$nombre,$descrip,$valor)
	{
		$sql="UPDATE estandar SET
		nombre='$nombre',
		descrip='$descrip',
        valor='$valor'
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}
	public function delete($id)
	{
		$sql="DELETE FROM estandar
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}

	public function show($id)
	{
		$sql="SELECT id,nombre,valor,descrip FROM estandar
		WHERE id='$id'";
		return $this->con->ejecutarConsultaSimpleFila($sql);
	}

	public function selectE()
	{
		$sql="SELECT * FROM estandar";
		return $this->con->ejecutarConsulta($sql);
	}


	public function index()
	{
		$sql="SELECT * FROM estandar order by nombre ASC";
		return $this->con->ejecutarConsulta($sql);
	}
	}

// $t->update(1,'chaleco',1001);
//$estandar2->update(13,'TI','javier','jimenez','bogota','ll','calle','@@gma',21212,'ss');
?>