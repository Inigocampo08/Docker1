<?php 
include_once "conexion.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevos jugadores</title>
</head>
<body>
    <h2>NUEVOS JUGADORES</h2>
    <?php include('cabecera.php');?>


    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (($_REQUEST['nombre'] != "") && ($_REQUEST['posicion'] != "") && ($_REQUEST['equipo'] != "") && ($_REQUEST['foto'] !="")) {
            // Hacemos la consulta para comprobar si el libro ya esta en la base de datos
            $comprobar = $miPDO->prepare('SELECT * FROM jugador WHERE nombre_jugador = :nombre');
            $comprobar->execute(
                [
                    'nombre' => $_REQUEST['nombre']
                ]
            );
            $comprobar = $comprobar->fetch();
            // Hacemos la comprobaciones para saber si la foto es valida y la podemos insertar 
            if (empty($comprobar)) {
                // Hacemos la insercion en la base de datos 
                $consulta = $miPDO->prepare('INSERT INTO jugador (nombre_jugador, posicion, foto, cod_equipo)
                                            VALUES (:nombre, :posicion, :foto, :cod_equipo)');
                $consulta->execute([
                    'nombre' => $_REQUEST['nombre'],
                    'posicion' => $_REQUEST['posicion'],
                    'foto' => $_REQUEST['foto'],
                    'cod_equipo' => $_REQUEST['equipo'],
                ]);
                echo '<p style="color: green" class="form__text">Jugador insertado</p>';

            } else {
                echo '<p style="color: red" class="form__text">Este jugador ya se habia añadido</p>';

            };
        } else {
            echo '<p style="color: red" class="form__text">Hay que rellenar todos los campos</p>';
        };

    }
    

?>

    <form class="form" id="equipo" action="" method="post">
            <h3>MOSTRAR JUGADORES DEL EQUIPO</h3>
            <fieldset>
                <legend>Datos jugador</legend>
                <div class="form-caja-campos">
                    <div class="formulario__grupo-input">
                        <label for="nombre">Nombre jugador: </label>
                        <input type="text" class="formulario__input" name="nombre" id="nombre">
                    </div>
                    <div class="formulario__grupo-input">
                        <label for="posicion">Posición: </label>
                        <input type="radio" name="posicion" value="ala"> Ala
                        <input type="radio" name="posicion" value="base"> Base
                        <input type="radio" name="posicion" value="pivot"> Pivot
                        <input type="radio" name="posicion" value="escolta"> Escolta

                    </div>
                    <div class="formulario__grupo-input">
                        <label for="foto">Foto jugador: </label>
                        <input type="file" class="formulario__input" name="foto" id="foto">
                    </div>
                    <div class="formulario__grupo-input">
                        <label for="equipo">Equipo: </label>
                        <select name="equipo" id="equipo">
                            <?php
                            //Consulta
                            $consulta = $miPDO->prepare("SELECT * FROM equipos");
                            $consulta->execute();
                            $equipos = $consulta->fetchAll();
                            foreach ($equipos as $posicion => $equipo) {
                                echo "<option value = '" . $equipo['cod_equipo'] . "'>" . $equipo['nombre_equipo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    
                </div>
            </fieldset>
            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <button class="form__button" type="submit">Enviar</button>
                <button class="form__button" type="reset">Borrar formulario</button>

            </div>
            
        </form>
    <?php include('footer.php');?>
</body>
</html>