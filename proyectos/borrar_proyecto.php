<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
    <?php
    require "bd.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];


            $mysqli = new mysqli($db_host, $db_user, $db_pass, "Proyecto46");

            if ($mysqli->connect_error) {
                die("Error de conexión a la base de datos: " . $mysqli->connect_error);
            }

            $query = "DELETE FROM proyectos WHERE id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo "Proyecto eliminado con éxito.";
                echo '<li><a href="proyectos.php" class="button">Proyectos</a></li>';
            } else {
                echo "Error al eliminar el proyecto: " . $stmt->error;
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