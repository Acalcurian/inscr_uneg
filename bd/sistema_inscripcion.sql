CREATE DATABASE sistema_inscripcion;

USE sistema_inscripcion;

CREATE TABLE estudiantes (
    id_estudiante INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    cedula VARCHAR(20) UNIQUE NOT NULL,
    carrera VARCHAR(100) NOT NULL,
    nivel_academico VARCHAR(50) NOT NULL,
    promedio DECIMAL(4, 2) NOT NULL,
    correo_electronico VARCHAR(100) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL
);

CREATE TABLE materias (
    id_materia INT AUTO_INCREMENT PRIMARY KEY,
    nombre_materia VARCHAR(100) NOT NULL,
    codigo_materia VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE secciones (
    id_seccion INT AUTO_INCREMENT PRIMARY KEY,
    codigo_seccion VARCHAR(10) UNIQUE NOT NULL,
    id_materia INT NOT NULL,
    FOREIGN KEY (id_materia) REFERENCES materias(id_materia) ON DELETE CASCADE
);

CREATE TABLE inscripciones (
    id_inscripcion INT AUTO_INCREMENT PRIMARY KEY,
    id_estudiante INT NOT NULL,
    id_seccion INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id_estudiante) ON DELETE CASCADE,
    FOREIGN KEY (id_seccion) REFERENCES secciones(id_seccion) ON DELETE CASCADE
);


INSERT INTO estudiantes (nombre, apellido, cedula, carrera, nivel_academico, promedio, correo_electronico, contraseña)
VALUES
('Juan', 'Pérez', '12345678', 'Ingeniería en Informatica', 'Pregrado', 18.50, 'juan.perez@correo.com', 'contrasena123'),
('María', 'Gómez', '87654321', 'Ingeniería en Informatica', 'Pregrado', 19.20, 'maria.gomez@correo.com', 'contrasena456'),
('Pedro', 'López', '11223344', 'Ingeniería en Informatica', 'Pregrado', 17.80, 'pedro.lopez@correo.com', 'contrasena789'),
('Ana', 'Rodríguez', '22334455', 'Ingeniería en Informatica', 'Pregrado', 16.90, 'ana.rodriguez@correo.com', 'contrasena101'),
('Luis', 'Martínez', '33445566', 'Ingeniería en Informatica', 'Pregrado', 19.50, 'luis.martinez@correo.com', 'contrasena202'),
('Laura', 'Fernández', '44556677', 'Ingeniería en Informatica', 'Postgrado', 20.00, 'laura.fernandez@correo.com', 'contrasena303'),
('Carlos', 'García', '55667788', 'Ingeniería en Informatica', 15.75, 'carlos.garcia@correo.com', 'contrasena404'),
('Sofía', 'Ramírez', '66778899', 'Ingeniería en Informatica', 18.00, 'sofia.ramirez@correo.com', 'contrasena505'),
('Daniel', 'Hernández', '77889900', 'Ingeniería en Informatica', 'Pregrado', 16.50, 'daniel.hernandez@correo.com', 'contrasena606'),
('Isabel', 'Torres', '88990011', 'Ingeniería en Informatica', 'Pregrado', 17.20, 'isabel.torres@correo.com', 'contrasena707');



SELECT * FROM estudiantes;

INSERT INTO estudiantes (nombre, apellido, cedula, carrera, nivel_academico, promedio, correo_electronico, contraseña)
VALUES
('Juan', 'Pérez', '12345678', 'Ingeniería Informatica', 'Pregrado', 18.50, 'juan.perez@correo.com', 'contrasena123'),
('María', 'Gómez', '87654321', 'Ingeniería Informatica', 'Pregrado', 19.20, 'maria.gomez@correo.com', 'contrasena456'),
('Pedro', 'López', '11223344', 'Ingeniería Informatica', 'Pregrado', 17.80, 'pedro.lopez@correo.com', 'contrasena789'),
('Ana', 'Rodríguez', '22334455', 'Ingeniería Informatica', 'Pregrado', 16.90, 'ana.rodriguez@correo.com', 'contrasena101'),
('Luis', 'Martínez', '33445566', 'Ingeniería Informatica', 'Pregrado', 19.50, 'luis.martinez@correo.com', 'contrasena202'),
('Laura', 'Fernández', '44556677', 'Ingeniería Informatica', 'Postgrado', 20.00, 'laura.fernandez@correo.com', 'contrasena303'),
('Carlos', 'García', '55667788', 'Ingeniería Informatica', 'Pregrado', 15.75, 'carlos.garcia@correo.com', 'contrasena404'),
('Sofía', 'Ramírez', '66778899', 'Ingeniería Informatica', 'Pregrado', 18.00, 'sofia.ramirez@correo.com', 'contrasena505'),
('Daniel', 'Hernández', '77889900', 'Ingeniería Informatica', 'Pregrado', 16.50, 'daniel.hernandez@correo.com', 'contrasena606'),
('Isabel', 'Torres', '88990011', 'Ingeniería Informatica', 'Pregrado', 17.20, 'isabel.torres@correo.com', 'contrasena707');


INSERT INTO materias (id_materia, nombre_materia, codigo_materia)
VALUES
('001', 'Sistemas Operativos', 'MAT001'),
('002', 'Informática Industrial', 'MAT002'),
('003', 'Innovación y Desarrollo', 'MAT003'),
('004', 'Seminario de Investigación', 'MAT004'),
('005', 'Ingeniería del Software 1', 'MAT005'),
('006', 'Base de Datos 2', 'MAT006'),
('007', 'Redes', 'MAT007'),
('008', 'Ingeniería del Software 2', 'MAT008'),
('009', 'Lenguajes y Compiladores', 'MAT009'),
('010', 'Telecomunicaciones', 'MAT0010');

SELECT * FROM materias;

SELECT * FROM secciones;




ALTER TABLE secciones ADD COLUMN codigo_seccion VARCHAR(10);

INSERT INTO secciones (id_seccion, codigo_seccion, id_materia)
VALUES
('SEC001','A', 1), -- Sistemas Operativos
('SEC002','B', 1),
('SEC003','A', 2), -- Informática Industrial
('SEC004','B', 2),
('SEC005','A', 3), -- Innovación y Desarrollo
('SEC006','B', 3),
('SEC007','A', 4), -- Seminario de Investigación
('SEC008','B', 4),
('SEC009','A', 5), -- Ingeniería del Software 1
('SEC0010','B', 5),
('SEC0011','A', 6), -- Base de Datos 2
('SEC0012','B', 6),
('SEC0013','A', 7), -- Redes
('SEC0014','B', 7),
('SEC0015','A', 8), -- Ingeniería del Software 2
('SEC0016','B', 8),
('SEC0017','A', 9), -- Lenguajes y Compiladores
('SEC0018','B', 9),
('SEC0019','A', 10), -- Telecomunicaciones
('SEC0020','B', 10);