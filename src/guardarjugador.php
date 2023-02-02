<?php 
    if (($_POST['nombre'] != "") && ($_POST['posicion'] != "") && ($_POST['equipo'] != "")) {
        // Hacemos la consulta para comprobar si el libro ya esta en la base de datos
        $comprobar = $miPDO->prepare('SELECT * FROM jugador WHERE nombre_jugador = :nombre');
        $comprobar->execute(
            [
                'nombre' => $_POST['nombre']
            ]
        );
        $comprobar = $comprobar->fetch();
        // Hacemos la comprobaciones para saber si la foto es valida y la podemos insertar 
        if (empty($comprobar)) {
            $archivo = isset($_FILES['foto']) ? $_FILES['foto'] : null;
            $target_dir = "C:\\xampp\\htdocs\\imagenes\\";
            $target_file = $target_dir . basename($archivo["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            //Comprobar si la imagen es una imagen o otro tipo de archivo
            if (isset($_POST["submit"])) {
                $check = getimagesize($archivo["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "Solo se pueden añadir imagenes";
                    $uploadOk = 0;
                }
            }

            // comprobar si el archivo ya existe en la carpeta
            if (file_exists($target_file)) {
                echo "Esta imagen ya esta guardada";
                $uploadOk = 0;
            }

            // comprobar el tamaño de la imagen
            if ($archivo["size"] > 500000) {
                echo "Perdona, el tamaño de la imagen es muy grande.";
                $uploadOk = 0;
            }

            // comproar que sea un formato valido
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            ) {
                echo "Lo sentimos, solo se aceptan archivos de tip JPG, JPEG y PNG.";
                $uploadOk = 0;
            }

            // comprobar si da error o se puede subir
            if ($uploadOk == 0) {
                echo "La imagen no se puede subir";
                // al comprobar que todo esta bien se puede hacer la insercion
            } else {
                if (move_uploaded_file($archivo["tmp_name"], $target_file)) {
                    echo htmlspecialchars(basename($archivo["foto"])) . "Foto insertada";
                } else {
                    echo "Ha habido un problema al insertar la foto.";
                }
            }

            // Hacemos la insercion en la base de datos 
            $consulta = $miPDO->prepare('INSERT INTO jugador (nombre_jugadr, posicion, foto, cod_equipo)
                                        VALUES (:nombre, :posicion, :foto, :cod_equipo)');
            $consulta->execute([
                'nombre' => $_POST['nombre'],
                'posicion' => $_POST['posicion'],
                'foto' => basename($archivo["name"]),
                'cod_equipo' => $_POST['equipo'],
            ]);

            header('Location: jugadores.php');
            die();
        } else {
            echo '<p style="color: red" class="form__text">Jugador añadido</p>';

        };
    } else {
        echo '<p style="color: red" class="form__text">Hay que rellenar todos los campos</p>';
    };


?>