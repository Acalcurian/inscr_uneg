<?php
session_start();
include 'include/conecta.php';

// Validar que el estudiante ha iniciado sesión
if (!isset($_SESSION['id_sesion'])) {
    header("Location: index.php");
    exit;
}

// Obtener datos del formulario
$id_estudiante = $_SESSION['id_sesion'];
$materia = isset($_POST['materia']) ? $_POST['materia'] : null;
$seccion = isset($_POST['seccion']) ? $_POST['seccion'] : null;

// Validar entrada
if (empty($materia) || empty($seccion)) {
    echo "Error: Todos los campos son obligatorios.";
    exit;
}

// Obtener el id_materia basado en el nombre de la materia
$id_materia = getIdMateria($conectar, $materia);
if ($id_materia === null) {
    echo "Error: Materia no válida.";
    exit;
}

// Obtener el id_seccion basado en id_materia y la sección
$id_seccion = getIdSeccion($conectar, $id_materia, $seccion);
if ($id_seccion === null) {
    echo "Error: Sección no válida.";
    exit;
}

// Verificar si el estudiante ya está inscrito en esta sección
$sql_check = "SELECT * FROM inscripciones WHERE id_estudiante = ? AND id_seccion = ?";
$stmt_check = $conectar->prepare($sql_check);
$stmt_check->bind_param("ii", $id_estudiante, $id_seccion);
$stmt_check->execute();
$resultado_check = $stmt_check->get_result();

if ($resultado_check->num_rows > 0) {
    echo "Ya estás inscrito en esta sección.";
    exit;
}

// Registrar la inscripción
$sql_insert = "INSERT INTO inscripciones (id_estudiante, id_seccion, fecha_inscripcion) VALUES (?, ?, NOW())";
$stmt_insert = $conectar->prepare($sql_insert);
$stmt_insert->bind_param("ii", $id_estudiante, $id_seccion);

if ($stmt_insert->execute()) {
    echo "Inscripción exitosa.";
    header("Location: post_login.php");
} else {
    echo "Error al inscribirse: " . $stmt_insert->error;
}

$stmt_check->close();
$stmt_insert->close();
$conectar->close();

// Función para obtener el id_materia
function getIdMateria($conectar, $nombreMateria) {
    $sql = "SELECT id_materia FROM materias WHERE nombre_materia = ?";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("s", $nombreMateria);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Error: No se encontró una materia con el nombre '$nombreMateria'.";
    }

    return $data ? $data['id_materia'] : null;
}

// Función para obtener el id_seccion
function getIdSeccion($conectar, $id_materia, $nombreSeccion) {
    $sql = "SELECT id_seccion FROM secciones WHERE id_materia = ? AND codigo_seccion = ?";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("is", $id_materia, $nombreSeccion);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Error: No se encontró una sección con el código '$nombreSeccion' para la materia con ID '$id_materia'.";
    }

    return $data ? $data['id_seccion'] : null;
}
?>
