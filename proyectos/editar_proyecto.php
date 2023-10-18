<!DOCTYPE html>
<html>

<head>
    <title>Editar Proyecto</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <h2>Editar Proyecto</h2>
    <?php
    require  "bd.php";

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];


        $mysqli = new mysqli($db_host, $db_user, $db_pass, "Proyecto46");

        if ($mysqli->connect_error) {
            die("Error de conexión a la base de datos: " . $mysqli->connect_error);
        }


        $query = "SELECT * FROM proyectos WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
    ?>
            <form action="guardar_edicion.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label for="nombre_proyecto">Nombre del Proyecto:</label>
                <input type="text" name="nombre_proyecto" value="<?php echo $row['nombre_proyecto']; ?>" required>

                <label for="resumen">Resumen:</label>
                <textarea name="resumen" required><?php echo $row['resumen']; ?></textarea>

                <label for="integrantes">Integrantes:</label>
                <input type="text" name="integrantes" value="<?php echo $row['integrantes']; ?>" required>

                <label for="numero_grupo">Número de Grupo:</label>
                <input type="number" name="numero_grupo" value="<?php echo $row['numero_grupo']; ?>" required>

                <label for="carrera">Carrera:</label>
                <input type="text" name="carrera" value="<?php echo $row['carrera']; ?>" required>

                <label for="ano">Año:</label>
                <input type="number" name="ano" value="<?php echo $row['ano']; ?>" required>

                <label for="materia">Materia:</label>
                <input type="text" name="materia" value="<?php echo $row['materia']; ?>" required>

                <label for="profesor">Profesor a Cargo:</label>
                <input type="text" name="profesor" value="<?php echo $row['profesor']; ?>" required>

                <button type="submit">Guardar Cambios</button>
            </form>
    <?php
        } else {
            echo "Proyecto no encontrado.";
        }

        $stmt->close();
        $mysqli->close();
    } else {
        echo "ID de proyecto no válido.";
    }
    ?>
</body>

</html>