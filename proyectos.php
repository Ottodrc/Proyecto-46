<!DOCTYPE html>
<html>

<head>
    <title>Lista de Proyectos</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
    <h2>Proyectos Registrados</h2>
    <table class="container">
        <tr>
            <th>Título</th>
            <th>Año</th>
            <th>Carrera</th>
            <th>Acciones</th>
        </tr>

        <?php

        $mysqli = new mysqli("localhost", "root", "", "Proyecto46");

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
                echo "<td><a href='editar_proyecto.php?id=" . $row['id'] . "'>Editar</a> | <a href='borrar_proyecto.php?id=" . $row['id'] . "'>Borrar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "No se encontraron proyectos.";
        }

        $mysqli->close();
        ?>
    </table>
    <a href="registro_proyecto.html">Crear Nuevo Proyecto</a>
</body>

</html