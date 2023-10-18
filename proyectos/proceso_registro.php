<!DOCTYPE html>
<html>

<head>
    <title>Registro de Proyectos</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Agrega tu archivo de estilos personalizado si es necesario -->
</head>

<body>
    <div class="container">
        <h2 class="my-4">Registro de Proyectos</h2>
        <?php
        require "..\bd.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre_proyecto = $_POST["nombre_proyecto"];
            $resumen = $_POST["resumen"];
            $integrantes = $_POST["integrantes"];
            $numero_grupo = $_POST["numero_grupo"];
            $carrera = $_POST["carrera"];
            $ano = $_POST["ano"];
            $materia = $_POST["materia"];
            $profesor = $_POST["profesor"];

            $mysqli = new mysqli('localhost', 'root', '', "Proyecto46");

            if ($mysqli->connect_error) {
                die("Error de conexión a la base de datos: " . $mysqli->connect_error);
            }

            $query = "INSERT INTO proyectos (nombre_proyecto, resumen, integrantes, numero_grupo, carrera, ano, materia, profesor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("sssiisss", $nombre_proyecto, $resumen, $integrantes, $numero_grupo, $carrera, $ano, $materia, $profesor);

            echo '<div class="alert alert-info" role="alert">';

            if ($stmt->execute()) {
                echo "Proyecto registrado con éxito.";
                echo '<a href="proyectos.php" class="btn btn-primary">Ver Proyectos</a>';
            } else {
                echo "Error al registrar el proyecto: " . $stmt->error;
                echo '<a href="proyectos.php" class="btn btn-primary">Ver Proyectos</a>';
            }

            echo '</div>';

            $stmt->close();
            $mysqli->close();
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>