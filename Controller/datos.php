<?php

require '../Model/funciones.php';
$usuario = new usuarios();

@$buscar = 'Refrescos';
$result = $usuario->buscar_usuario($buscar);
$tabla_result = $usuario->tabla_usuarios($result);

if (isset($_POST['btn_registro'])) {
    $nombre = $_POST['txtnombre'];
    $ap_pat = $_POST['txtap_pat'];
    $ap_mat = $_POST['txtap_mat'];
    $correo = $_POST['txtcorreo'];
    $contraseña = $_POST['txtcontraseña'];
    $usuario ->insertar_usuario($nombre, $ap_pat, $ap_mat, $correo, $contraseña);
}

require '../View/index.php';

?>