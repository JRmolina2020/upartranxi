<?php 
require_once'Conexion.php';
Class Vehiculo
{
private $con;
public $id;

function __construct(){
$this->con = new Conexion();
}
	public function Save($idp,$idt,$placa,$marca,$modelo,$color,$image)
	{
		$sql="INSERT INTO vehiculo (idp,idt,placa,marca,modelo,color,image)
		VALUES ('$idp','$idt','$placa','$marca','$modelo','$color','$image')";
		return $this->con->ejecutarConsulta($sql);
	}
	public function update($id,$idp,$idt,$placa,$marca,$modelo,$color,$image)
	{
		$sql="UPDATE vehiculo SET
		idp='$idp',
        idt='$idt',
		placa='$placa',
		marca='$marca',
		modelo='$modelo',
		color='$color',
		image='$image'
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}
	public function delete($id)
	{
		$sql="DELETE FROM vehiculo
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}
	public function show($id)
	{
		$sql="SELECT id,idp,idt,placa,marca,modelo,color,image FROM vehiculo
		WHERE id='$id'";
		return $this->con->ejecutarConsultaSimpleFila($sql);
	}

	public function selectB()
	{
		$sql="SELECT p.nombre as nombre,p.apellido as apellido,v.placa as placa,v.id as idi
		FROM persona p
		INNER JOIN vehiculo v ON V.idp = p.id";
		return $this->con->ejecutarConsulta($sql);
	}

	public function index($getid)
	{
		$sql="SELECT p.id, v.id as id, T.nombre AS tipo,placa,modelo,marca,color,image 
		FROM tipo_vehiculo T
		INNER JOIN vehiculo v ON v.idt = T.id 
		INNER JOIN persona P ON v.idp = P.id
		WHERE p.id='$getid'";
		return $this->con->ejecutarConsulta($sql);
	}
	}
?>