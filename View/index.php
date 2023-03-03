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
        <form action="datos.php" method="POST">
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
        </form>
        
    </div>
</body>
</html>