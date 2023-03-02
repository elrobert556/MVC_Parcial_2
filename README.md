# Examen Practico: MVC
 Primero tenemos un archivo index que te redirecciona hacia la carpeta de Controllers
 ```php
 <?php echo '<script>window.location="Controller/datos.php"</script>';?>
 ```
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
