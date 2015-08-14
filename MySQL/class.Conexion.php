<?PHP
//conexion MySQL::MySQL
class Conexion
{
	private $conexion = null; 
	protected $servidor;
	protected $usuario;
	protected $pass;
	protected $db;

	public function __construct($sv='localhost',$us='root',$pass=12345,$db='usuario')
	{
		$this->servidor = $sv;
		$this->usuario = $us;
		$this->pass = $pass;
		$this->db = $db;
		if(!isset($this->conexion))
		{
			$this->conexion = mysql_connect($this->servidor,$this->usuario,$this->pass);
			@mysql_select_db($this->db,$this->conexion); //La @ nos evita los mesajes de
		}
		if ($this->conexion)
		{
			/*echo '-Conectado- <br/>','Parametros unsados para la conexion : <br />';
			echo 'Servidor -> ',$this->servidor, '<br/>';
			echo 'Usuario -> ', $this->usuario, '<br/>';
			echo 'Password -> ', $this->pass, '<br/>';
			echo 'Nombre de la Base de Datos -> ', $this->db, '<br/>';*/
		}
		if(!$this->conexion)
		{
			{
			}
			throw new Exception("No Funciona la conexcion. El Error es el siguiente: ".mysql_error());
		}

	}
	public function consulta($consulta)
	{
		$valores = array();
		$resultado = @mysql_query($consulta,$this->conexion);

		if(!$resultado)
		{
			throw new Exception("No Funciona la Consulta. El Error es el siguiente: ".mysql_error());
		}
		else
		{
			$num_rows= $this->num_rows($resultado);
			for($i=0;$i<$num_rows;$i++){
				$row = $this->fetch_assoc($resultado);
				array_push($valores, $row);
			}
			return $valores;
		}
	} 

	public function fetch_array($consulta)
	{
		return @mysql_fetch_array($consulta);
	}

	public function fetch_row($consulta)
	{
		return @mysql_fetch_row($consulta);
	}

	public function mysqlresult($consulta,$numero,$letra)
	{
		return @mysql_result($consulta,$numero,$letra);
	}

	public function fetch_assoc($consulta)
	{
		return @mysql_fetch_assoc($consulta);
	}

	public function num_rows($consulta)
	{
		return @mysql_num_rows($consulta);
	}

	public function id_ultimo()
	{
		return @mysql_insert_id();
	}

	public function begin()
	{
		@mysql_query(“BEGIN”);
	}

	public function commit()
	{
		@mysql_query(“COMMIT”);
	}

	public function rollback()
	{
		@mysql_query(“ROLLBACK”);
	}

	public function liberar($consulta)
	{
		@mysql_free_result($consulta);
	}

	public function escape($value){
    	return mysqli_real_escape_string($this->conn,$value);
  	}

  	public function sql($sql){
	    $resultado=mysql_query($sql,$this->conexion);
	    return $resultado;
	}

}//Terminamos la clase de conexion.
?>