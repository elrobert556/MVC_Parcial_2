<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Examen Practico</title>
</head>
<body>
    <div class="header">
        <form action="datos.php" method="POST">
            <div class="formulario">
                <h4>Nombre:</h4>
                <input class="campo" type="text" id="txtnombre" name="txtnombre" placeholder="Nombre(s)"><br>
                <h4>Apellido paterno:</h4>
                <input class="campo" type="text" id="txtap_pat" name="txtap_pat" placeholder="Apellido paterno"><br>
                <h4>Apellido materno:</h4>
                <input class="campo" type="text" id="txtap_mat" name="txtap_mat" placeholder="Apellido materno"><br>
                <h4>Correo:</h4>
                <input class="campo" type="text" id="txtcorreo" name="txtcorreo" placeholder="Correo electronico"><br>
                <h4>Contraseña:</h4>
                <input class="campo" type="text" id="txtcontraseña" name="txtcontraseña" placeholder="Contraseña"><br>
                <div class="paddinng"><input class="campo btn" type="submit" id="btn_registro" name="btn_registro" value="Insertar"></div>
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
                </tr>
            </thead>
            <tbody>
                <?php echo $tabla_result; ?>
            </tbody>
        </table>
    </div>
</body>
</html>