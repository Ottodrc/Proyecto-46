<!DOCTYPE html>
<html>

<head>
    <title>Tu Título Aquí</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            $id = $_POST['id'];

            $nombre_proyecto = $_POST["nombre_proyecto"];
            $resumen = $_POST["resumen"];
            $integrantes = $_POST["integrantes"];
            $numero_grupo = $_POST["numero_grupo"];
            $carrera = $_POST["carrera"];
            $ano = $_POST["ano"];
            $materia = $_POST["materia"];
            $profesor = $_POST["profesor"];


            $mysqli = new mysqli("localhost", "root", "", "Proyecto46");

            if ($mysqli->connect_error) {
                die("Error de conexión a la base de datos: " . $mysqli->connect_error);
            }


            $query = "UPDATE proyectos SET nombre_proyecto=?, resumen=?, integrantes=?, numero_grupo=?, carrera=?, ano=?, materia=?, profesor=? WHERE id=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("sssiisssi", $nombre_proyecto, $resumen, $integrantes, $numero_grupo, $carrera, $ano, $materia, $profesor, $id);

            if ($stmt->execute()) {
                echo "Proyecto actualizado con éxito.";
                echo '<li><a href="proyectos.php" class="button">Proyectos</a></li>';
            } else {
                echo "Error al actualizar el proyecto: " . $stmt->error;
                echo '<li><a href="proyectos.php" class="button">Proyectos</a></li>';
            }

            $stmt->close();
            $mysqli->close();
        } else {
            echo "ID de proyecto no válido.";
            echo '<li><a href="proyectos.php" class="button">Proyectos</a></li>';
        }
    } else {
        echo "Acceso no permitido.";
        echo '<li><a href="proyectos.php" class="button">Proyectos</a></li>';
    }
    ?>
</body>

</html>