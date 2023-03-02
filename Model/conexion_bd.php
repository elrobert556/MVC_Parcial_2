<?php 
class BD_PDO
{
	//public $tot_reg;
	//public $ultimo_id;

	function Ejecutar_Instruccion($instruccion_sql)
	{
		$host = "localhost";
		$usr  = "root";
		$pwd  = "";
		$db   = "mvc";

		try {
				$conexion = new PDO("mysql:host=$host;dbname=$db;",$usr,$pwd);
		       //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		catch(PDOException $e)
			{
		      echo "Failed to get DB handle: " . $e->getMessage();
		      exit;    
		    }
		 
		 // Asignando una instruccion sql

		 $query=$conexion->prepare($instruccion_sql);
		if(!$query)
		{
			return "Error al mostrar";
		}
		else
		{
			$query->execute();
			while ($result = $query->fetch())
			    {
			        $rows[] = $result;
			    }	
		}
		return @$rows;
	}

}
?>