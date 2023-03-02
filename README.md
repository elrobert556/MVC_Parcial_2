# Examen Practico: MVC
 Primero tenemos un archivo index que te redirecciona hacia la carpeta de Controllers
 ```php
 <?php echo '<script>window.location="Controller/datos.php"</script>';?>
 ```
 ### Controlador
 El archivo al que nos va a dirigir es **datos.php** dentro de la carpeta **Controllers**
 ```php
 <?php
//Mando a llamar las funciones que se encuentran en la carpeta **Model**
require '../Model/funciones.php';
$usuario = new usuarios();

@$buscar = $_POST['txtnombrebuscar'];
//Se encarga de enviar la peticion de buscar un usuario
$result = $usuario->buscar_usuario($buscar);
//Aqui se manda a llamar una tabla con todos los usuarios
$tabla_result = $usuario->tabla_usuarios($result);

if (isset($_POST['btn_registro'])) {
    $nombre = $_POST['txtnombre'];
    $ap_pat = $_POST['txtap_pat'];
    $ap_mat = $_POST['txtap_mat'];
    $correo = $_POST['txtcorreo'];
    $contraseña = $_POST['txtcontraseña'];
    //El boton para insertar tiene 2 valores dependiendo de si vas a modificar o insertar
    if ($_POST['btn_registro']=='Registrar')
        {

            $usuario ->insertar_usuario($nombre, $ap_pat, $ap_mat, $correo, $contraseña);
        }
        else if ($_POST['btn_registro']=='Guardar') 
        {
            $id = $_POST['txtidproducto'];
            $usuario->modificar($nombre,$ap_pat,$ap_mat,$correo,$contraseña,$id);
        }
    
}
elseif (isset($_GET['ideliminar'])) 
    {
        $ideliminar = $_GET['ideliminar'];
        $usuario->eliminar($ideliminar);
    }
    elseif (isset($_GET['idmodificar'])) 
    {
        $id = $_GET['idmodificar'];
        $buscar_mod = $usuario->buscar_mod($id);
    }
//Este require sirve para que este arhivo muestre todo lo que esta en View/index.php
require '../View/index.php';

?>
 ```
 ### Modelo
 En la carpeta de modelo tengo 2 archivos. Uno de ellos es **conexion_bd.php**.  
 Este archivo se encarga de conectarse a la base de datos y permitir que otros arhivos que llamen a esta conexion puedan realizar instrucciones sql.
 ```php
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
 ```
El otro archivo dentro de la carpeta modelo es **funciones.php**.  
Estas funciones se conectan a **conexion_bd.php** para que puedan usar la funcion de nombre **Ejecutar_Instruccion**. Todas estas funciones le sirven al controlador para enviarle los datos del formulario y que este se pueda conectar con la BD.
```php
<?php

require 'conexion_bd.php';

class usuarios extends BD_PDO{
    //Esta funcion sirve para insertar un nuevo usuario
    function insertar_usuario($nombre,$ap_pat,$ap_mat,$correo,$contraseña){
        $this->Ejecutar_Instruccion("INSERT INTO usuarios (nombre,ap_pat,ap_mat,correo,contraseña) VALUES('$nombre','$ap_pat','$ap_mat','$correo','$contraseña')");
    }
    //Essa funcion se encarga de buscar usuarios por medio de su nombre
    function buscar_usuario($buscar){
        $result = $this->Ejecutar_Instruccion("SELECT *FROM usuarios WHERE nombre LIKE '%$buscar%' ORDER BY id DESC");
        return $result;
    }
    //Esta funcion te permite borrar un usuario de la tabla ubicada en la base de datos 
    function eliminar($ideliminar)
    {
        $this->Ejecutar_Instruccion("Delete from usuarios where id = '$ideliminar'");
    }
    //Con esta funcion puedo modificar un usuario ya registrado
    function modificar($nombre,$ap_pat,$ap_mat,$correo,$contraseña,$id)
    {
        $this->Ejecutar_Instruccion("update usuarios set nombre='$nombre',ap_pat='$ap_pat',ap_mat='$ap_mat',correo='$correo', contraseña='$contraseña' where id='$id'");
    }
    //Esta funcion me sirve para saber que usuario se va a modificar y escribir automaticamente sus datos en el formulario
    function buscar_mod($id)
    {
        $buscar_mod = $this->Ejecutar_Instruccion("Select * from usuarios where id = '$id'");
        return $buscar_mod;
    }
    //Con la combinacion de la funcion de buscar usuarios, me permite meter todos los datos de la tabla sql a una tabla html
    function tabla_usuarios($result){
        $tabla="";
        foreach ($result as $renglon)
        {
            $tabla.='<tr>';
            $tabla.='<td>'.$renglon[0].'</td>';
            $tabla.='<td>'.$renglon[1].'</td>';
            $tabla.='<td>'.$renglon[2].'</td>';
            $tabla.='<td>'.$renglon[3].'</td>';
            $tabla.='<td>'.$renglon[4].'</td>';
            $tabla.='<td>'.$renglon[5].'</td>';
            $tabla.='<td align="center"><input type="button" id="btneliminar" name="btneliminar" value="Eliminar" onclick="javascript: eliminar('.$renglon[0].');"></td>';
            $tabla.='<td align="center"><input type="button" id="btnModificar" name="btnModificar" value="Modificar" onclick="javascript: modificar('.$renglon[0].');"></td>';
            $tabla.='<tr>';
        }
        return $tabla;
    }
}

?>
```
### Vista
Por ultimo esta la carpeta de vista, donde se guardan todos los index que es unicamente diseño, los archivos dentro de esta carpeta no tienen codigo php, o si tienen, es casi nulo.
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Examen Practico</title>
</head>
<script>
    function eliminar(id)
             {
                if (confirm("¿Estas seguro que quieres eliminar el registro?"))
                {
                    window.location = "../Controller/datos.php?ideliminar=" + id;
                }
             }

             function modificar(id)
             {
                window.location = "../Controller/datos.php?idmodificar=" + id;
             }
</script>
<body>
    <div class="header">
        <form action="datos.php" method="POST">
            <div class="formulario">
            <input type="text" id="txtidproducto" name="txtidproducto" placeholder="Num" value="<?php echo @$buscar_mod[0][0]; ?>" hidden>
                <h4>Nombre:</h4>
                <input class="campo" type="text" id="txtnombre" name="txtnombre" placeholder="Nombre(s)" value="<?php echo @$buscar_mod[0][1]; ?>"><br>
                <h4>Apellido paterno:</h4>
                <input class="campo" type="text" id="txtap_pat" name="txtap_pat" placeholder="Apellido paterno" value="<?php echo @$buscar_mod[0][2]; ?>"><br>
                <h4>Apellido materno:</h4>
                <input class="campo" type="text" id="txtap_mat" name="txtap_mat" placeholder="Apellido materno" value="<?php echo @$buscar_mod[0][3]; ?>"><br>
                <h4>Correo:</h4>
                <input class="campo" type="text" id="txtcorreo" name="txtcorreo" placeholder="Correo electronico" value="<?php echo @$buscar_mod[0][4]; ?>"><br>
                <h4>Contraseña:</h4>
                <input class="campo" type="text" id="txtcontraseña" name="txtcontraseña" placeholder="Contraseña" value="<?php echo @$buscar_mod[0][5]; ?>"><br>
                <div class="paddinng"><input class="campo btn" type="submit" id="btn_registro" name="btn_registro" value="<?php 
                        if(isset($_GET['idmodificar']))
                        {
                            echo 'Guardar';
                        } 
                        else
                        { 
                            echo 'Registrar';
                        }?>"></div>
            </div>
            <div class="buscar">
                <input type="text" name="txtnombrebuscar" id="txtnombrebuscar" placeholder="Ingresa un nombre para buscar...">
                <input type="submit" value="Buscar">
            </div>  
            
        </form>
    </div>
    <div>
        <table border="colspan">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellido paterno</td>
                    <td>Apellido materno</td>
                    <td>Correo</td>
                    <td>Contraseña</td>
                    <td colspan="2" align="center">Accion</td>
                </tr>
            </thead>
            <tbody>
                <?php echo $tabla_result; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
```
