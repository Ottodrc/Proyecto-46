<!DOCTYPE html>
<html>

<head>
    <title>Editar Proyecto</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-4">
        <h2>Editar Proyecto</h2>
        <?php
        require "..\bd.php";

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

                    <div class="mb-3">
                        <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
                        <input type="text" class="form-control" name="nombre_proyecto" value="<?php echo $row['nombre_proyecto']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="resumen" class="form-label">Resumen</label>
                        <textarea class="form-control" name="resumen" required><?php echo $row['resumen']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="integrantes" class="form-label">Integrantes</label>
                        <input type="text" class="form-control" name="integrantes" value="<?php echo $row['integrantes']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="numero_grupo" class="form-label">Número de Grupo</label>
                        <input type="number" class="form-control" name="numero_grupo" value="<?php echo $row['numero_grupo']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="carrera" class="form-label">Carrera</label>
                        <input type="text" class="form-control" name="carrera" value="<?php echo $row['carrera']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="ano" class="form-label">Año</label>
                        <input type="number" class="form-control" name="ano" value="<?php echo $row['ano']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="materia" class="form-label">Materia</label>
                        <input type="text" class="form-control" name="materia" value="<?php echo $row['materia']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="profesor" class="form-label">Profesor a Cargo</label>
                        <input type="text" class="form-control" name="profesor" value="<?php echo $row['profesor']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>