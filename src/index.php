<?php
include_once "conexion.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <?php include('cabecera.php');?>
    <h1>TORNEO BALONCESTO TXURDINAGA</h1>
    <p>Esta es la página web para informar sobre el torneo que se celebrará en el instituto Txurdinaga y en el que participarán varios equipos de los que podréis ver información sobre ellos.</p>   
    <div>
        <a href="equipos.php"><img src="imagenes/equipos.png"></a>
        <a href=""><img src="imagenes/entrenadores.png"></a>
        <a href=""><img src="imagenes/jugadores.png"></a>
    </div>
<?php include('footer.php');?>
</body>
</html>