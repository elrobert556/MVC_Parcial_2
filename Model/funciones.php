<?php

require 'conexion_bd.php';

class usuarios extends BD_PDO{
    function insertar_usuario($nombre,$ap_pat,$ap_mat,$correo,$contraseña){
        $this->Ejecutar_Instruccion("INSERT INTO usuarios (nombre,ap_pat,ap_mat,correo,contraseña) VALUES('$nombre','$ap_pat','$ap_mat','$correo','$contraseña')");
    }
    function buscar_usuario($buscar){
        $result = $this->Ejecutar_Instruccion("SELECT *FROM usuarios WHERE nombre LIKE '%$buscar%' ORDER BY id DESC");
        return $result;
    }
    function eliminar($ideliminar)
    {
        $this->Ejecutar_Instruccion("Delete from usuarios where id = '$ideliminar'");
    }
    function modificar($nombre,$ap_pat,$ap_mat,$correo,$contraseña,$id)
    {
        $this->Ejecutar_Instruccion("update usuarios set nombre='$nombre',ap_pat='$ap_pat',ap_mat='$ap_mat',correo='$correo', contraseña='$contraseña' where id='$id'");
    }
    function buscar_mod($id)
    {
        $buscar_mod = $this->Ejecutar_Instruccion("Select * from usuarios where id = '$id'");
        return $buscar_mod;
    }
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