<!DOCTYPE html>
<html>

<head>
    <title>Lista de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class="my-4">Proyectos Registrados</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Año</th>
                    <th>Carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <?php
            require "..\bd.php";
            $mysqli = new mysqli($db_host, $db_user, $db_pass, "Proyecto46");

            if ($mysqli->connect_error) {
                die("Error de conexión a la base de datos: " . $mysqli->connect_error);
            }

            $query = "SELECT id, nombre_proyecto, ano, carrera FROM proyectos";
            $result = $mysqli->query($query);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nombre_proyecto'] . "</td>";
                    echo "<td>" . $row['ano'] . "</td>";
                    echo "<td>" . $row['carrera'] . "</td>";
                    echo "<td><a href='editar_proyecto.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a> | <a href='borrar_proyecto.php?id=" . $row['id'] . "' class='btn btn-danger'>Borrar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron proyectos.</td></tr>";
            }

            $mysqli->close();
            ?>
        </table>
        <a href="registro_proyecto.html" class="btn btn-success">Crear Nuevo Proyecto</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>