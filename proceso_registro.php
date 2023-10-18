<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $query = "INSERT INTO proyectos (nombre_proyecto, resumen, integrantes, numero_grupo, carrera, ano, materia, profesor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssiisss", $nombre_proyecto, $resumen, $integrantes, $numero_grupo, $carrera, $ano, $materia, $profesor);

    if ($stmt->execute()) {
        echo "Proyecto registrado con éxito.";
        echo $carrera;
    } else {
        echo "Error al registrar el proyecto: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
