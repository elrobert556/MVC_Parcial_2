<?php

require '../Model/funciones.php';
$usuario = new usuarios();

@$buscar = $_POST['txtnombrebuscar'];
$result = $usuario->buscar_usuario($buscar);
$tabla_result = $usuario->tabla_usuarios($result);

if (isset($_POST['btn_registro'])) {
    $nombre = $_POST['txtnombre'];
    $ap_pat = $_POST['txtap_pat'];
    $ap_mat = $_POST['txtap_mat'];
    $correo = $_POST['txtcorreo'];
    $contraseña = $_POST['txtcontraseña'];
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

require '../View/index.php';

?>