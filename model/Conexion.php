
<?php @session_start();
define("DB_ENCODE", "utf8");
//mi name space
class Conexion{
//atributos 
private  $datos = array('host' =>"localhost",
"user"=>"root","pass"=>"1234","db"=>"app");
private $con;
// constructor por defecto
function __construct(){
$this->con = new \mysqli($this->datos["host"],$this->datos["user"],$this->datos["pass"],$this->datos["db"]);
mysqli_query( $this->con, 'SET NAMES "'.DB_ENCODE.'"');

if (mysqli_connect_errno())
{
	printf("Falló conexión a la base de datos: %s\n",mysqli_connect_error());
	exit();
}
}
    public function ejecutarConsulta($sql)
	{
		$datos=$this->con->query($sql);
		return $datos;
	}

	public function ejecutarConsultaSimpleFila($sql)
	{
	
		$datos=$this->con->query($sql);		
		$row = $datos->fetch_assoc();
		return $row;
	}

	}  
?>