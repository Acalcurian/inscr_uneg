<?php
session_start();
include 'include/conecta.php';

// Verificar si la sesión está activa
if (!isset($_SESSION['id_sesion'])) {
    header("Location: index.php");
    exit;
}

// Obtener el ID del estudiante desde la sesión
$id_estudiante = $_SESSION['id_sesion'];

// Consultar los datos del estudiante
$sql = " SELECT nombre, apellido, cedula, carrera, nivel_academico, promedio, correo_electronico 
        FROM estudiantes WHERE id_estudiante = ? ";

$stmt = $conectar->prepare($sql);
$stmt->bind_param("i", $id_estudiante);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $estudiante = $result->fetch_assoc();
} else {
    echo "Error: Estudiante no encontrado.";
    exit;
}
/*
// Procesar el formulario solo si fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $materia = isset($_POST['materia']) ? trim($_POST['materia']) : null;
    $seccion = isset($_POST['seccion']) ? trim($_POST['seccion']) : null;

    // Validar entrada
    if (empty($materia) || empty($seccion)) {
        echo "Error: Todos los campos son obligatorios 1.";
        exit;
    }

    // Determinar el id_seccion basado en la materia y la sección
    $id_seccion = getIdSeccion($conectar, $materia, $seccion);
    if ($id_seccion === null) {
        echo "Error: Sección no válida.";
        exit;
    }

    // Verificar si ya está inscrito en esta sección
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
        exit;
    } else {
        echo "Error al inscribirse: " . $stmt_insert->error;
    }

    $stmt_check->close();
    $stmt_insert->close();
    $conectar->close();
}

// Función para obtener el id_seccion
function getIdSeccion($conectar, $materia, $seccion) {
    $sql = "SELECT id_seccion FROM secciones WHERE materia = ? AND seccion = ?";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("ss", $materia, $seccion);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    return $data ? $data['id_seccion'] : null;
}
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            font-family: Arial, sans-serif;
            color: #fff;
        }
        .container {
            margin-top: 50px;
            max-width: 800px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .list-unstyled{
            background: rgb(201, 198, 198);
            color: black;

        }


        
    </style>
</head>
<body>
    <header>
        <h1 class="text-center mt-4">Bienvenido al Sistema de Inscripción</h1>
    </header>

    <div class="container">
        <div class="card" style="background-color: rgba(255, 255, 255, 0.9);">
            <div class="card-header text-center bg-primary text-white">
                <h2>Panel de Inscripción</h2>
            </div>
            <div class="card-body">
                <!-- Datos del estudiante -->
                <div class="mb-4 p-4 bg-light rounded shadow-sm">
                    <h4 class="fw-bold">Datos del Estudiante</h4>
                    <ul class="list-unstyled">
                        <li><strong>Nombre:</strong> <?php echo $estudiante['nombre']?></li>
                        <li><strong>Apellido:</strong><?php echo $estudiante['apellido']?></li>
                        <li><strong>Cédula:</strong> <?php echo $estudiante['cedula']?></li>
                        <li><strong>Carrera:</strong><?php echo $estudiante['carrera']?></li>
                        <li><strong>Nivel Académico:</strong><?php echo $estudiante['nivel_academico']?></li>
                        <li><strong>Promedio:</strong> <?php echo $estudiante['promedio']?></li>
                        <li><strong>Correo Electrónico:</strong> <?php echo $estudiante['correo_electronico']?></li>
                        
                    </ul>
                </div>

                <!-- Formulario de inscripción -->
                <form id="enrollmentForm" action="procesar_inscripcion.php" method="POST" class="p-4 bg-light rounded shadow">
                    <div class="mb-3">
                        <label for="subject1" class="form-label fw-bold">Materia</label>
                        <select id="subject1" name="materia" class="form-select shadow-sm">
                        <option value="">Selecciona una materia</option>
                        <option value="Telecomunicaciones">Telecomunicaciones</option>
                        <option value="Sistemas Operativos">Sistemas Operativos</option>
                        <option value="Seminario de Investigación">Seminario de Investigación</option>
                        <option value="Redes">Redes</option>
                        <option value="Lenguajes y Compiladores">Lenguajes y Compiladores</option>
                        <option value="Innovación y Desarrollo">Innovación y Desarrollo</option>
                        <option value="Ingeniería del Software 2">Ingeniería del Software 2</option>
                        <option value="Ingeniería del Software 1">Ingeniería del Software 1</option>
                        <option value="Informática Industrial">Informática Industrial</option>
                        <option value="Base de Datos 2">Base de Datos 2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="section1" class="form-label fw-bold">Sección</label>
                        <select id="section1" name="seccion" class="form-select shadow-sm">
                            <option value="">Selecciona una sección</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg shadow">Confirmar Inscripción</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
