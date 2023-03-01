<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Practico</title>
</head>
<body>
    <div>
        <form action="datos.php" method="POST">
            <input type="text" id="txtnombre" name="txtnombre" placeholder="Nombre(s)">
            <input type="text" id="txtap_pat" name="txtap_pat" placeholder="Apellido paterno">
            <input type="text" id="txtap_mat" name="txtap_mat" placeholder="Apellido materno">
            <input type="text" id="txtcorreo" name="txtcorreo" placeholder="Correo electronico">
            <input type="text" id="txtcontraseña" name="txtcontraseña" placeholder="Contraseña">
            <input type="submit" id="btn_registro" name="btn_registro" value="Insertar">
            <br>
            <input type="text" name="txtnombrebuscar" id="txtnombrebuscar" placeholder="Ingresa un nombre para buscar...">
            <input type="submit" value="Buscar">
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