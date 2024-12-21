<?php
session_start();
include ("include/conecta.php");

//verificar sesion activa
if(isset($_SESSION['id_session'])){

    header("Location: index.php");
    exit;
    
}

//obtener id del estudiante
$id_estudiante = $_SESSION['id_session'];

//consultar datos del estudiante

$sql = "SELECT nombre, apellido, cedula, carrera, nivel_Academico, promedio, email 
         FROM estudiantes WHERE id_estudiante = ? ";

$stmt = $conectar->prepare($sql);
$stmt->bind_param("i", $id_estudiante);
$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows > 0){

    $estudiante = $resultado->fetch_assoc();
} else {
    echo "Error: Estudiante no encontrado.";
    exit;
}






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
                        <li><strong>Apellido:</strong> [Apellido del Estudiante]</li>
                        <li><strong>Cédula:</strong> [Cédula del Estudiante]</li>
                        <li><strong>Carrera:</strong> [Carrera del Estudiante]</li>
                        <li><strong>Nivel Académico:</strong> [Nivel Académico]</li>
                        <li><strong>Promedio:</strong> [Promedio]</li>
                        <li><strong>Correo Electrónico:</strong> [Correo del Estudiante]</li>
                        
                    </ul>
                </div>

                <!-- Formulario de inscripción -->
                <form id="enrollmentForm" class="p-4 bg-light rounded shadow">
                    <div class="mb-3">
                        <label for="subject1" class="form-label fw-bold">Materia</label>
                        <select id="subject1" class="form-select shadow-sm">
                            <option value="">Selecciona una materia</option>
                            <option value="math">Matemáticas</option>
                            <option value="science">Ciencias</option>
                            <option value="history">Historia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="section1" class="form-label fw-bold">Sección</label>
                        <select id="section1" class="form-select shadow-sm">
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
