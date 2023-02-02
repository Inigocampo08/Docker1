<?php 
include_once "conexion.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos</title>
</head>
<body>
    <?php include('cabecera.php');?>
    
    <form class="form" id="equipo" action="mostrarjugadores.php" method="post">
            <h3>MOSTRAR JUGADORES DEL EQUIPO</h3>
            <fieldset>
                <legend>Equipos</legend>
                <div class="form-caja-campos">
                    <div class="formulario__grupo-input login-usuario">
                        <label for="equipo">Seleccione equipo para ver jugadores: </label>
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

                    <div class="formulario__grupo formulario__grupo-btn-enviar">
                        <button class="form__button" type="submit">Enviar</button>
                    </div>
                </div>
            </fieldset>
            
        </form>
    <?php include('footer.php');?>
</body>
</html>