<!DOCTYPE html>
<html>

<head>
    <title>Eliminar Proyecto</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilos.css"> <!-- Agrega tu archivo de estilos personalizado si es necesario -->
</head>

<body>
    <div class="container">
        <?php
        require "../bd.php";

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];

                $mysqli = new mysqli($db_host, $db_user, $db_pass, "proyecto46");

                if ($mysqli->connect_error) {
                    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
                }

                $query = "DELETE FROM proyectos WHERE id = ?";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param("i", $id);

                echo '<div class="alert alert-info" role="alert">';

                if ($stmt->execute()) {
                    echo "Proyecto eliminado con éxito.";
                    echo '<a href="proyectos.php" class="btn btn-primary">Ver Proyectos</a>';
                } else {
                    echo "Error al eliminar el proyecto: " . $stmt->error;
                    echo '<a href="proyectos.php" class="btn btn-primary">Ver Proyectos</a>';
                }

                echo '</div>';

                $stmt->close();
                $mysqli->close();
            } else {
                echo "ID de proyecto no válido.";
                echo '<a href="proyectos.php" class="btn btn-primary">Ver Proyectos</a>';
            }
        } else {
            echo "Acceso no permitido.";
            echo '<a href="proyectos.php" class="btn btn-primary">Ver Proyectos</a>';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>