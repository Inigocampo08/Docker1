<?php
include_once "conexion.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <main>
        <?php
        // Comprobamos que nos llega los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(($_REQUEST['password']!="") && ($_REQUEST['nickname']!="")){
            // Base de datos.
            $consulta = $miPDO->prepare('SELECT * FROM usuarios WHERE usuario = :nickname');
            $consulta->execute(
                [
                    'nickname' => $_REQUEST['nickname']
                ]
            );
            $usuario = $consulta->fetch();
            if (!empty($usuario)){
                $nickname = $usuario['usuario'];

                // Comprobamos si los datos son correctos
                if ($usuario['password'] == $_REQUEST['password']) {
                    // Si son correctos, creamos la sesión
                    session_start();
                    $_SESSION['usuario'] = $usuario['usuario'];
                    // Redireccionamos a la página segura
                    header('Location: index.php');
                } else{
                    echo '<p style="color: red" class="form__text">Datos incorrectos. Usted no tiene permisos.</p>';
                };
            } else{
                    echo '<p style="color: red" class="form__text">Datos incorrectos. Usted no tiene permisos.</p>';
                };
            }else{
                echo '<p style="color: red" class="form__text">Error. Todos los campos son requeridos</p>';
            }
            
            

          
                     }
        ?>
        <form class="form" id="login" action="" method="post">
            <h3>INICIAR SESION</h3>
            <fieldset>
                <legend>Datos Usuario</legend>
                <div class="form-caja-campos">
                <div class="formulario__grupo-input login-usuario">
                    <label for="nickname">Usuario: </label>
                    <input type="text" class="formulario__input" name="nickname" id="nickname" autofocus placeholder="Email-a edo ezizena">
                    <i class="far fa-user"></i>
                </div>

                <div class="formulario__grupo-input login-contra">
                    <label for="password">Contraseña: </label>
                    <input type="password" class="formulario__input" name="password" id="password" placeholder="Pasahitza">
                    <i class="fas fa-unlock-alt"></i>
                </div>

                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button class="form__button" type="submit">Iniciar sesion</button>
                    <div class="boton">
                        <a class="form__button" href="index.php">Volver a inicio</a>
                    </div>
                    
                </div>
            </div>
            </fieldset>
            
        </form>
    </main>
    
</body>
</html>