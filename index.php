<?php
session_start();
include 'include/conecta.php';

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (!empty($_POST)) {

    $email = mysqli_real_escape_string($conectar, $_POST['email']);
    $pass = mysqli_real_escape_string($conectar, $_POST['password']);

    $sql = "SELECT id_estudiante FROM estudiantes WHERE correo_electronico = '$email' AND contraseña = '$pass' ";
    $resultado = $conectar->query($sql);

/* if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $_SESSION['id_sesion'] = $row['id_estudiante'];
        header("Location: post_login.php");
        exit();
    } */
    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $_SESSION['id_sesion'] = $row['id_estudiante']; // Clave de sesión correcta
        echo "Autenticación exitosa. Redirigiendo...";
        header("Location: post_login.php");
        exit;
    }else {
        $error = "Correo o contraseña incorrectos. Inténtalo de nuevo.";
    }
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            font-family: Arial, sans-serif;
            color: #fff;
        }
        .container {
            margin-top: 50px;
            max-width: 500px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<div id="chatbot-container">
    <div id="chatbot-header">Asistente Virtual</div>
    <div id="chatbot-messages"></div>
    <input type="text" id="chatbot-input" placeholder="Escribe tu pregunta..." />
    <button onclick="sendMessage()">Enviar</button>
</div>

<style>
    #chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 300px;
        background: white;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
    #chatbot-header {
        background: #007bff;
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: bold;
        border-radius: 10px 10px 0 0;
    }
    #chatbot-messages {
        color: black;
        height: 200px;
        overflow-y: auto;
        padding: 10px;
    }
    #chatbot-input {
        width: calc(100% - 70px);
        padding: 5px;
    }
    button {
        padding: 5px;
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>

<script>
    function sendMessage() {
        let input = document.getElementById("chatbot-input");
        let message = input.value.trim();
        if (message === "") return;

        let messagesDiv = document.getElementById("chatbot-messages");
        messagesDiv.innerHTML += `<div><strong>Tú:</strong> ${message}</div>`;

        fetch("chatbot.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "message=" + encodeURIComponent(message)
        })
        .then(response => response.json())
        .then(data => {
            messagesDiv.innerHTML += `<div><strong>Bot:</strong> ${data.message}</div>`;
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });

        input.value = "";
    }
</script>

<body>
    <header>
        <h1 class="text-center mt-4">SISTEMA DE INSCRIPCIÓN</h1>
    </header>
    <div class="container">
        <div class="card" style="background-color: rgba(255, 255, 255, 0.9);">
            <div class="card-header text-center bg-primary text-white">
                <img src="imagenes/Logo.png" alt="Logo UNEG" style="width: 100px; margin-bottom: 10px; border-radius: 15%;">
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                <form id="loginForm" action="" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
