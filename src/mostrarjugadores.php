<?php
include_once "conexion.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadores</title>
</head>
<body>
    <?php include('cabecera.php')?>
    <div>
        <h2>
        JUGADORES DEL EQUIPO <?php $_POST['equipo'] ?>
        </h2>
        <h4>
            ENTRENADOR: 
            <?php
            $entrenador = $miPDO->prepare('SELECT entrenador FROM equipos WHERE cod_equipo =:equipo');
            $entrenador ->execute(
                [
                    'equipo' => $_POST['equipo']
                ]
                );
                $entrenador = $entrenador->fetch();
            echo $entrenador['entrenador'];
            ?>
        </h4>
    </div>
    
    <table>
        <tr>
            <th>Nombre Jugador</th>
            <th>Foto</th>
            <th>Posicion</th>
        </tr>
        <tr>
            <?php


            $equipo = $miPDO->prepare('SELECT * FROM jugador WHERE cod_equipo = :equipo');
            $equipo->execute(
                [
                    'equipo' => $_POST['equipo'],
                ]
            );
            $jugadores = $equipo->fetchAll();
            foreach ($jugadores as $posicion => $jugador) {
            ?>
                <tr>
                    <td><?php echo $jugador['nombre_jugador']?></td>
                    <td>
                        <figure><img src='imagenes/<?php echo $jugador['foto']?>'></figure> 
                    </td>
                    <td><?php echo $jugador['posicion']?></td>

                </tr>

                   
            <?php   
            };

            ?>

        </tr>
    </table>

    
</body>
</html>