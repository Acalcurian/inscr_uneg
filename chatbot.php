<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMessage = strtolower(trim($_POST['message']));
    $response = "Hola, selecciona una opción:\n\n".
                "1️⃣ ¿Cómo me inscribo?\n".
                "2️⃣ ¿Qué materias están disponibles?\n".
                "3️⃣ ¿Cómo ver mi inscripción?\n".
                "4️⃣ ¿Como ver los horario?\n".
                "5️⃣ ¿Qué hacer si no puedo inscribirme?\n".
                "6️⃣ Salir";

    // Definir respuestas predefinidas
    $responses = [
        "1" => "Para inscribirte, sigue estos pasos:\n1️⃣ Inicia sesión en el sistema.\n2️⃣ Selecciona la materia que deseas inscribir.\n3️⃣ Escoge la sección disponible.\n4️⃣ Confirma la inscripción y verifica que se haya registrado correctamente.",
        "2" => "Las materias disponibles son:\n📚 Telecomunicaciones\n📚 Sistemas Operativos\n📚 Redes\n📚 Innovación y Desarrollo\n📚 Ingeniería del Software 1 y 2\n📚 Informática Industrial\n📚 Base de Datos 2",
        "3" => "Para ver tus materias inscritas:\n🔹 Inicia sesión en el sistema.\n🔹 Ve a la sección 'Mis Inscripciones'.\n🔹 Ahí podrás ver las materias en las que estás inscrito.",
        "4" => "Puedes encontrar los horarios en el siguiente link, https://uneg.edu.ve/horarios",
        "5" => "Si tienes problemas con la inscripción:\n🔹 Revisa que hayas seleccionado una materia y sección.\n🔹 Verifica que no estés ya inscrito en esa sección.\n🔹 Asegúrate de que tienes cupo disponible en la materia.",
        "6" => "¡Hasta luego! Si necesitas más ayuda, aquí estaré. 😊"
    ];

    // Buscar respuesta
    if (array_key_exists($userMessage, $responses)) {
        $response = $responses[$userMessage];
    }

    echo json_encode(["message" => nl2br($response)]);
}
?>
