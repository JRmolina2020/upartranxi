<?php 
require_once'Conexion.php';
Class Comparendo
{
private $con;

function __construct(){
$this->con = new Conexion();
}
	public function Save($idp,$idu,$idv,$lugar,$observacion,$totdetalle,$totgrua)
	{
		date_default_timezone_set("America/Bogota");
		$hora = time();
		$hora=date ("Y-m-d H:i:s",$hora);
		intval($totgrua);
		$total = $totdetalle+$totgrua;

		$sql="INSERT INTO comparendo(idp,idu,idv,fecha,lugar,hora,observacion,totdetalle,totgrua,total,estado)
		VALUES ('$idp','$idu','$idv',curdate(),'$lugar','$hora','$observacion','$totdetalle',
		'$totgrua','$total','PENDIENTE')";
		return $this->con->ejecutarConsulta($sql);
	}
	public function update($id,$observacion)
	{
		$sql="UPDATE comparendo SET
		observacion='$observacion'
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}

	public function pagar($id)
	{
		$sql="UPDATE comparendo SET
		estado='PAGADO',
		total=0.00,
		totgrua=0.00,
		totdetalle=0.00
		WHERE id='$id'";
		return $this->con->ejecutarConsulta($sql);
	}
	public function delete($id)
	{
		$sql="DELETE FROM comparendo
		WHERE id='$id' AND estado='PAGADO'";
		return $this->con->ejecutarConsulta($sql);
	}

	public function show($id)
	{
		$sql="SELECT id,idu,idp,idv,fecha,totgrua,lugar,observacion,totdetalle,total,hora FROM comparendo
		WHERE id='$id'";
		return $this->con->ejecutarConsultaSimpleFila($sql);
	}

	public function index()
	{
		$sql="SELECT  c.id ,p.documento as doc,p.nombre as nombre,p.apellido as apellido,p.id as idp,u.name as agente,
		v.placa as placa,v.image as imagen,c.fecha as fecha,c.lugar as lugar
		,c.hora as hora,c.observacion as resena,c.totdetalle as totdetalle,
		c.totgrua as grua,c.total as total,c.estado as estado
		FROM persona p
		INNER JOIN vehiculo v
		ON p.id = v.idp
		INNER JOIN comparendo c
		ON c.idv = v.id
		INNER JOIN user u
		ON u.id = c.idu 
		ORDER BY c.id DESC
		";
		return $this->con->ejecutarConsulta($sql);
	}

	public function index2($ida)
	{
		$sql="SELECT c.id ,p.documento as doc,p.nombre as nombre,p.apellido as apellido,p.id as idp,u.name as agente,
		v.placa as placa,v.image as imagen,c.fecha as fecha,c.lugar as lugar
		,c.hora as hora,c.observacion as resena,c.totdetalle as totdetalle,
		c.totgrua as grua,c.total as total,c.estado as estado
		FROM persona p
		INNER JOIN vehiculo v
		ON p.id = v.idp
		INNER JOIN comparendo c
		ON c.idv = v.id
		INNER JOIN user u
		ON u.id = c.idu
		WHERE u.id ='$ida'
		ORDER BY c.id DESC
		";
		return $this->con->ejecutarConsulta($sql);
	}

	public function indexC($idc)
	{
		$sql="SELECT c.id ,p.nombre as nombre,p.apellido as apellido,p.id as idp,u.name as agente,
		v.placa as placa,v.image as imagen,c.fecha as fecha,c.lugar as lugar
		,c.hora as hora,c.observacion as resena,c.totdetalle as totdetalle,
		c.totgrua as grua,c.total as total,c.estado as estado
		FROM persona p
		INNER JOIN vehiculo v
		ON p.id = v.idp
		INNER JOIN comparendo c
		ON c.idv = v.id
		INNER JOIN user u
		ON u.id = c.idu
		WHERE p.id ='$idc'
		ORDER BY c.estado DESC
		";
		return $this->con->ejecutarConsulta($sql);
	}
	public function comparendoR($id)
	{
		$sql="SELECT c.id,p.nombre as nombre,p.apellido as apellido,p.id as idp,u.name as agente,
		v.placa as placa,v.modelo as modelo,v.marca as marca,p.perfil as imagen,c.fecha as fecha,c.lugar as lugar
		,c.hora as hora,c.observacion as resena,c.totdetalle as totdetalle,
		c.totgrua as grua,c.total as total,c.estado as estado
		FROM persona p
		INNER JOIN vehiculo v
		ON p.id = v.idp
		INNER JOIN comparendo c
		ON c.idv = v.id
		INNER JOIN user u
		ON u.id = c.idu
		WHERE c.id='$id'
		";
		return $this->con->ejecutarConsulta($sql);
	}

	public function totalComparendo()
	{
		$sql="SELECT count(id) as total FROM comparendo WHERE fecha=curdate()";
		return $this->con->ejecutarConsulta($sql);
	}

	public function totaldeuda()
	{
		$sql="SELECT sum(total) as toti from comparendo where estado ='PENDIENTE'";
		return $this->con->ejecutarConsulta($sql);
	}

	public function totalgrua()
	{
		$sql="SELECT sum(totgrua) as totu from comparendo where estado ='PENDIENTE'";
		return $this->con->ejecutarConsulta($sql);
	}
	public function totalindividual()
	{
		$sql="SELECT count(c.id) as cantidad,name,sum(total) as total,u.image as imagen from comparendo c
		inner join user u
		ON u.id = c.idu
		GROUP by (idu)
		order by cantidad DESC
		LIMIT 5";
		return $this->con->ejecutarConsulta($sql);
	}
	}
$comparendo2 = new Comparendo();
//$comparendo2->Save(28,6,14,'2019-02-0','vall','29:01:0','ssss',1,2,3);
?>