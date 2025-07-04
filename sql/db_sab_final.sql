CREATE DATABASE IF NOT EXISTS proyecto_sab;

USE proyecto_sab;

CREATE TABLE IF NOT EXISTS tbl_especialidades (
    id_especialidad INT AUTO_INCREMENT PRIMARY KEY,
    esp_nombre VARCHAR(255) NOT NULL,
    esp_descripcion TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS tbl_usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usua_nombre VARCHAR(100) NOT NULL,
    usua_documento INT(11) NOT NULL UNIQUE,
    usua_tipo_documento ENUM(
    'Cédula de ciudadanía',
    'Tarjeta de identidad',
    'Cédula de extranjería',
    'Permiso especial de permanencia',
    'Pasaporte',
    'Número de identificación tributaria',
    'Otro'
    ),
    usua_correo_electronico VARCHAR(255) NOT NULL UNIQUE,
    usua_direccion VARCHAR(100) NOT NULL,
    usua_num_contacto VARCHAR(15) NOT NULL,
    usua_num_secundario VARCHAR(15),
    usua_fecha_nacimiento DATE NOT NULL,
    usua_sexo ENUM('Masculino','Femenino'),
    usua_rh ENUM('O+','O-','A+','A-','B+','B-','AB+','AB-'),
    usua_eps VARCHAR(100) NOT NULL,
    usua_password VARCHAR(255) NOT NULL UNIQUE,
    usua_tipo ENUM('Paciente','Empleado','Especialista','Administrador') DEFAULT 'Paciente',
    usua_estado ENUM('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
);

CREATE TABLE IF NOT EXISTS tbl_pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    paci_usuario INT NOT NULL UNIQUE,
    paci_fecha_registro DATE NOT NULL DEFAULT CURRENT_DATE,
    paci_telefono_emergencia VARCHAR(15),
    paci_ultima_visita DATE,
    paci_observaciones TEXT,
    paci_estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo',
    FOREIGN KEY (paci_usuario) REFERENCES tbl_usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS tbl_roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    rol_nombre VARCHAR(50) NOT NULL UNIQUE,
    rol_descripcion VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS tbl_empleados (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    empl_usuario INT NOT NULL UNIQUE,
    empl_fecha_ingreso DATE NOT NULL DEFAULT CURRENT_DATE,
    empl_rol INT NOT NULL,
    empl_descripcion_especifica TEXT DEFAULT 'N/A',
    empl_estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo',
    FOREIGN KEY (empl_usuario) REFERENCES tbl_usuarios(id_usuario),
    FOREIGN KEY (empl_rol) REFERENCES tbl_roles(id_rol)
);

CREATE TABLE IF NOT EXISTS tbl_especialistas (  
    id_especialista INT AUTO_INCREMENT PRIMARY KEY,
    espe_usuario INT NOT NULL UNIQUE,
    espe_especialidad INT NOT NULL,
    espe_fecha_ingreso DATE NOT NULL DEFAULT CURRENT_DATE,
    espe_num_licencia VARCHAR(50),
    espe_estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo',
    FOREIGN KEY (espe_usuario) REFERENCES tbl_usuarios(id_usuario),
    FOREIGN KEY (espe_especialidad) REFERENCES tbl_especialidades(id_especialidad)
);

CREATE TABLE IF NOT EXISTS tbl_consultorios (
    id_consultorio INT AUTO_INCREMENT PRIMARY KEY,
    cons_numero VARCHAR(10) NOT NULL UNIQUE,
    cons_estado ENUM('Disponible','No Disponible') DEFAULT 'Disponible'
);

CREATE TABLE IF NOT EXISTS tbl_categorias_tratamientos(
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    cate_nombre VARCHAR(50) NOT NULL UNIQUE,
    cate_descripcion TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS tbl_tratamientos (
    id_tratamiento INT AUTO_INCREMENT PRIMARY KEY,
    trat_codigo VARCHAR(20) NOT NULL UNIQUE,
    trat_nombre VARCHAR(100) NOT NULL,
    trat_categoria INT NOT NULL,
    trat_duracion_minutos INT UNSIGNED NOT NULL,
    trat_riesgos TEXT NOT NULL DEFAULT 'N/A',
    trat_duracion VARCHAR(100) NOT NULL,
    trat_descripcion VARCHAR(255) NOT NULL,
    trat_complejidad ENUM('Baja','Media','Alta','Urgencia'),
    trat_estado ENUM('Activo','Inactivo') DEFAULT 'Activo',
    FOREIGN KEY (trat_categoria) REFERENCES tbl_categorias_tratamientos(id_categoria)
);

CREATE TABLE IF NOT EXISTS tbl_citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    cita_paciente INT(11) NOT NULL,
    cita_especialista INT NOT NULL,
    cita_fecha DATE NOT NULL,
    cita_hora_inicio TIME NOT NULL,
    cita_hora_fin TIME NOT NULL,
    cita_turno ENUM('Mañana', 'Tarde') NOT NULL,
    cita_duracion INT NOT NULL,
    cita_consultorio INT NOT NULL,
    cita_motivo ENUM('Consulta general','Control','Urgencia','Seguimiento','Examen','Otro') DEFAULT 'Consulta general',
    cita_observacion TEXT NOT NULL,
    cita_estado ENUM('Cumplida','Incumplida','Proceso','Cancelada') DEFAULT 'Proceso',
    FOREIGN KEY (cita_paciente) REFERENCES tbl_pacientes(id_paciente),
    FOREIGN KEY (cita_especialista) REFERENCES tbl_especialistas(id_especialista),
    FOREIGN KEY (cita_consultorio) REFERENCES tbl_consultorios(id_consultorio)
);

CREATE TABLE IF NOT EXISTS tbl_diagnosticos (
    id_diagnostico INT AUTO_INCREMENT PRIMARY KEY,
    diag_nombre VARCHAR(80) NOT NULL UNIQUE,
    diag_descripcion TEXT NOT NULL,
    diag_tratamiento INT NOT NULL,
    diag_estado ENUM('Activo','Inactivo') DEFAULT 'Activo',
    FOREIGN KEY (diag_tratamiento) REFERENCES tbl_tratamientos(id_tratamiento)
);

CREATE TABLE IF NOT EXISTS tbl_citas_diagnosticos (
    id_ct INT AUTO_INCREMENT PRIMARY KEY,
    ct_cita INT NOT NULL,
    ct_diagnostico INT NOT NULL,
    ct_observaciones TEXT,
    ct_fecha_aplicacion DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (ct_cita) REFERENCES tbl_citas(id_cita),
    FOREIGN KEY (ct_diagnostico) REFERENCES tbl_diagnosticos(id_diagnostico)
);


CREATE TABLE IF NOT EXISTS tbl_historial_clinico (
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    hist_paciente INT NOT NULL UNIQUE,
    hist_antecedentes_personales TEXT NOT NULL,
    hist_antecedentes_familiares TEXT NOT NULL,
    hist_medicamentos_actuales TEXT NOT NULL,
    hist_alergias TEXT NOT NULL,
    hist_diagnostico INT NOT NULL,
    hist_fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    hist_fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    hist_creado_por INT NOT NULL,
    hist_actualizado_por INT NOT NULL,
    hist_odontograma BOOLEAN NOT NULL,
    hist_indice_dmft INT UNSIGNED NOT NULL,
    hist_frecuencia_cepillado ENUM('1 vez/dia','2 veces/dia','>2 veces/dia','Ocasional') NOT NULL,
    hist_hilo_dental BOOLEAN NOT NULL,
    hist_enjuague_bucal BOOLEAN NOT NULL,
    hist_sensibilidad_dental ENUM('Ninguna','Frío','Calor','Dulce','Oclusion') DEFAULT 'Ninguna',
    hist_estado ENUM('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
    FOREIGN KEY (hist_paciente) REFERENCES tbl_pacientes(id_paciente),
    FOREIGN KEY (hist_creado_por) REFERENCES tbl_especialistas(id_especialista),
    FOREIGN KEY (hist_actualizado_por) REFERENCES tbl_especialistas(id_especialista),
    FOREIGN KEY (hist_diagnostico) REFERENCES tbl_diagnosticos(id_diagnostico)
);  

CREATE TABLE IF NOT EXISTS tbl_pqrs (
    id_pqrs INT AUTO_INCREMENT PRIMARY KEY,
    pqrs_tipo ENUM('Petición','Queja','Reclamo','Sugerencia') NOT NULL,
    pqrs_asunto VARCHAR(150) NOT NULL,
    pqrs_descripcion TEXT NOT NULL,
    pqrs_fecha_envio DATE NOT NULL DEFAULT CURRENT_DATE,
    pqrs_estado ENUM('Pendiente','En proceso','Respondido','Cerrado'),
    pqrs_respuesta TEXT,
    pqrs_fecha_respuesta TEXT,
    pqrs_usuario INT NOT NULL,
    pqrs_empleado INT,
    FOREIGN KEY (pqrs_usuario) REFERENCES tbl_usuarios(id_usuario),
    FOREIGN KEY (pqrs_empleado) REFERENCES tbl_empleados(id_empleado)
);

INSERT INTO tbl_usuarios (usua_nombre, usua_documento, usua_tipo_documento, usua_correo_electronico, usua_direccion, usua_num_contacto, usua_num_secundario, usua_fecha_nacimiento, usua_sexo, usua_rh, usua_eps, usua_password, usua_tipo, usua_estado) VALUES
('Juan Pérez',       1001001001, 'Cédula de ciudadanía',      'juan.perez@email.com',     'Calle 123 #45-67', '3100000001', '3200000001', '1990-05-10', 'Masculino', 'O+', 'Sura',         'passJuan123', 'Paciente',     'Activo'),
('María Gómez',      1001001002, 'Tarjeta de identidad',      'maria.gomez@email.com',    'Cra 5 #12-34',     '3100000002', NULL,          '1995-07-20', 'Femenino',  'A+', 'Nueva EPS',     'passMaria123', 'Paciente',     'Activo'),
('Carlos Sánchez',   1001001003, 'Pasaporte',                 'carlos.sanchez@email.com', 'Av 3 #45-67',      '3100000003', NULL,          '1985-03-15', 'Masculino', 'B+', 'Sanitas',       'passCarlos123','Paciente', 'Activo'),
('Laura Ramírez',    1001001004, 'Cédula de extranjería',     'laura.ramirez@email.com',  'Calle 9 #9-99',    '3100000004', '3200000004', '1992-12-01', 'Femenino',  'AB+', 'Compensar',     'passLaura123', 'Empleado',     'Activo'),
('Andrés Torres',    1001001005, 'Permiso especial de permanencia', 'andres.torres@email.com', 'Diagonal 10 #8-76', '3100000005', NULL, '1988-11-11', 'Masculino', 'O-', 'Coomeva',     'passAndres123','Empleado',     'Activo'),
('Diana López',      1001001006, 'Número de identificación tributaria', 'diana.lopez@email.com', 'Cra 7 #21-43',   '3100000006', NULL,          '1999-06-30', 'Femenino',  'A-', 'Salud Total',   'passDiana123', 'Empleado', 'Activo'),
('Pedro Martínez',   1001001007, 'Cédula de ciudadanía',      'pedro.martinez@email.com', 'Av 1 #1-23',       '3100000007', '3200000007', '1993-04-18', 'Masculino', 'B-', 'Sura',         'passPedro123', 'Especialista',     'Activo'),
('Camila Ríos',      1001001008, 'Otro',                      'camila.rios@email.com',    'Calle 45 #9-10',   '3100000008', NULL,          '2000-01-25', 'Femenino',  'AB-', 'Sanitas',       'passCamila123','Especialista','Activo'),
('David Moreno',     1001001009, 'Cédula de ciudadanía',      'david.moreno@email.com',   'Cra 11 #33-44',    '3100000009', NULL,          '1991-09-09', 'Masculino', 'O+', 'Nueva EPS',     'passDavid123', 'Especialista',     'Activo');

INSERT INTO tbl_especialidades (esp_nombre, esp_descripcion) VALUES
('Ortodoncia', 'Especialidad encargada de corregir la posición de los dientes y huesos maxilares mediante el uso de aparatos.'),
('Endodoncia', 'Tratamiento de conductos para salvar dientes cuya pulpa está afectada por caries profundas o traumatismos.'),
('Periodoncia', 'Especialidad que trata las enfermedades de las encías y los tejidos de soporte de los dientes.');

INSERT INTO tbl_especialistas (espe_usuario, espe_especialidad, espe_fecha_ingreso, espe_num_licencia, espe_estado) VALUES
(7, 1, '2023-04-01', 'LIC-ORTHO-2023001', 'Activo'),
(8, 2, '2022-09-15', 'LIC-ENDO-2022007', 'Activo'),
(9, 3, '2024-01-20', 'LIC-PERIO-2024010', 'Activo');

INSERT INTO tbl_pacientes (paci_usuario, paci_fecha_registro, paci_telefono_emergencia, paci_ultima_visita, paci_observaciones) VALUES
(1, '2024-06-10',  '3201234567', '2024-06-01', 'Paciente con buena higiene bucal.'),
(2, '2024-06-11',  '3109876543', '2024-05-15', 'Leve sensibilidad en molares superiores.'),
(3, '2024-06-12',  '3114567890', '2024-04-20', 'Alergia a la penicilina, usar alternativas.');

INSERT INTO tbl_roles (rol_nombre, rol_descripcion) VALUES
('Recepcionista', 'Encargado de agendar citas, atender llamadas y gestionar el ingreso de pacientes.'),
('Asistente Dental', 'Apoya al odontólogo en los procedimientos clínicos y prepara los materiales.'),
('Administrador de Clínica', 'Gestiona el funcionamiento general del consultorio, incluyendo personal, horarios y reportes.');

INSERT INTO tbl_empleados (empl_usuario, empl_fecha_ingreso, empl_rol, empl_descripcion_especifica, empl_estado) VALUES
(4, '2023-03-01', 1, 'Recepcionista con experiencia en manejo de agendas médicas.', 'Activo'),
(5, '2022-11-10', 2, 'Asistente dental con formación técnica y experiencia en ortodoncia.', 'Activo'),
(6, '2021-08-15', 3, 'Administrador general encargado del control operativo y estratégico.', 'Activo');

INSERT INTO tbl_consultorios (cons_numero, cons_estado) VALUES
('101', 'Disponible'),
('102', 'Disponible'),
('103', 'No Disponible');

INSERT INTO tbl_categorias_tratamientos (cate_nombre, cate_descripcion) VALUES
('Ortodoncia', 'Tratamientos relacionados con la alineación y corrección de la posición de los dientes.'),
('Endodoncia', 'Tratamientos de conducto y procedimientos para tratar el interior del diente.'),
('Periodoncia', 'Tratamientos enfocados en las encías y estructuras de soporte dental.');

INSERT INTO tbl_tratamientos (trat_codigo, trat_nombre, trat_categoria, trat_duracion_minutos, trat_riesgos, trat_duracion, trat_descripcion, trat_complejidad, trat_estado) VALUES
('ORT-001', 'Brackets metálicos', 1, 60, 'Irritación bucal, dolor temporal', 'Aproximadamente 2 años', 'Aparatos para alinear dientes mediante presión continua.', 'Media', 'Activo'),
('END-001', 'Tratamiento de conducto', 2, 90, 'Dolor postoperatorio, posibilidad de reinfección', '1 a 2 sesiones', 'Elimina la pulpa dental infectada y sella el conducto.', 'Alta', 'Activo'),
('PER-001', 'Limpieza profunda (curetaje)', 3, 45, 'Sensibilidad dental, sangrado leve', '1 sesión de 45 minutos', 'Elimina el sarro y placa debajo de la línea de las encías.', 'Media', 'Activo');

INSERT INTO tbl_citas (cita_paciente, cita_especialista, cita_fecha, cita_hora_inicio, cita_hora_fin, cita_turno, cita_duracion, cita_consultorio, cita_motivo, cita_observacion, cita_estado) VALUES
(1, 1, '2025-06-12', '08:30:00', '09:00:00', 'Mañana', 60, 1, 'Consulta general', 'Paciente refiere dolor en la muela superior derecha.', 'Proceso'),
(2, 2, '2025-06-13', '14:00:00', '14:45:00', 'Tarde', 90, 2, 'Control', 'Control de tratamiento de ortodoncia en curso.', 'Proceso'),
(3, 3, '2025-06-14', '10:00:00', '11:00:00', 'Mañana', 45, 3, 'Urgencia', 'Inflamación y dolor intenso en encías inferiores.', 'Proceso');

INSERT INTO tbl_diagnosticos (diag_nombre, diag_descripcion, diag_tratamiento) VALUES
('Maloclusión dental', 'Desalineación en la mordida del paciente que requiere tratamiento ortodóntico.', 1),
('Necrosis pulpar', 'La pulpa dental está muerta debido a caries profunda. Se requiere endodoncia.', 2),
('Gingivitis', 'Inflamación de encías por acumulación de placa. Se recomienda limpieza profunda.', 3);

INSERT INTO tbl_citas_diagnosticos (ct_cita, ct_diagnostico, ct_observaciones, ct_fecha_aplicacion) VALUES
(1, 2, 'Se inició tratamiento de conducto, sin complicaciones.', '2025-06-12'),
(2, 1, 'Ajuste de brackets realizado con éxito.', '2025-06-13'),
(3, 3, 'Limpieza profunda aplicada, se recomienda seguimiento en 3 meses.', '2025-06-14');

INSERT INTO tbl_historial_clinico (hist_paciente, hist_antecedentes_personales, hist_antecedentes_familiares, hist_medicamentos_actuales, hist_alergias, hist_diagnostico, hist_creado_por, hist_actualizado_por, hist_odontograma, hist_indice_dmft, hist_frecuencia_cepillado, hist_hilo_dental, hist_enjuague_bucal, hist_sensibilidad_dental, hist_estado) VALUES
(1, 'Paciente con antecedentes de caries recurrentes.', 'Padre con enfermedad periodontal.', 'Naproxeno 500mg', 'Ninguna', 1, 1, 1, TRUE, 3, '2 veces/dia', TRUE, TRUE, 'Frío', 'Activo'),
(2, 'Sin antecedentes personales relevantes.', 'Madre con historia de gingivitis.', 'Ibuprofeno ocasional', 'Alergia a penicilina', 2, 2, 2, FALSE, 1, '1 vez/dia', FALSE, FALSE, 'Calor', 'Activo'),
(3, 'Paciente diabético tipo 2.', 'Abuelos con pérdida dentaria temprana.', 'Metformina 850mg', 'Ninguna', 3, 3, 3, TRUE, 4, '>2 veces/dia', TRUE, TRUE, 'Dulce', 'Activo');

INSERT INTO tbl_pqrs (pqrs_tipo, pqrs_asunto, pqrs_descripcion, pqrs_fecha_envio, pqrs_estado, pqrs_respuesta, pqrs_fecha_respuesta, pqrs_usuario, pqrs_empleado) VALUES 
('Petición', 'Solicitud de certificado', 'Por favor, necesito el certificado de asistencia al curso de higiene oral.', CURRENT_DATE, 'Pendiente', NULL, NULL, 1, 1),
('Queja', 'Retraso en la atención', 'La cita fue agendada a las 9:00 AM y fui atendido a las 10:15 AM.', '2025-06-14', 'Respondido', 'Lamentamos el retraso. Tomaremos medidas para mejorar la puntualidad.', '2025-06-15', 2, 2),
('Sugerencia', 'Agregar más horarios por la tarde', 'Sería ideal contar con más turnos después de las 5:00 PM para quienes trabajamos de día.', CURRENT_DATE, 'En proceso', NULL, NULL, 1, 3);

DELIMITER $$

CREATE TRIGGER AUTO_ROL
AFTER INSERT ON tbl_usuarios
FOR EACH ROW
BEGIN
    IF NEW.usua_tipo = 'Paciente' THEN
        INSERT INTO tbl_pacientes (paci_usuario) VALUES (NEW.id_usuario);
    ELSEIF NEW.usua_tipo = 'Empleado' THEN
        INSERT INTO tbl_empleados (empl_usuario, empl_rol) VALUES (NEW.id_usuario, 1);
    ELSEIF NEW.usua_tipo = 'Especialista' THEN
        INSERT INTO tbl_especialistas (espe_usuario, espe_especialidad) VALUES (NEW.id_usuario, 1);
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error Inesperado';
    END IF;
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER CAMBIO_ROL
AFTER UPDATE ON tbl_usuarios
FOR EACH ROW
BEGIN
    IF OLD.usua_tipo <> NEW.usua_tipo THEN
        IF OLD.usua_tipo = 'Paciente' THEN
            UPDATE tbl_pacientes SET paci_estado = 'Inactivo' WHERE paci_usuario = OLD.id_usuario;
        ELSEIF  OLD.usua_tipo = 'Empleado' THEN
            UPDATE tbl_empleados SET empl_estado = 'Inactivo' WHERE empl_usuario = OLD.id_usuario;
        ELSEIF OLD.usua_tipo = 'Especialista' THEN
            UPDATE tbl_especialistas SET espe_estado = 'Inactivo' WHERE espe_usuario = OLD.id_usuario;
    END IF;
        IF NEW.usua_tipo = 'Paciente' THEN
            INSERT INTO tbl_pacientes (paci_usuario) VALUES (NEW.id_usuario);
        ELSEIF NEW.usua_tipo = 'Empleado' THEN
            INSERT INTO tbl_empleados (empl_usuario, empl_rol) VALUES (NEW.id_usuario, 1);
        ELSEIF NEW.usua_tipo = 'Especialista' THEN
            INSERT INTO tbl_especialistas (espe_usuario, espe_especialidad) VALUES (NEW.id_usuario, 1);
        END IF;
    END IF;
END$$

DELIMITER ;

DELIMITER //

CREATE PROCEDURE ObtenerHistorialClinico()
BEGIN
    SELECT
        h.*, 
        up.usua_nombre AS hist_paciente,
        uc.usua_nombre AS hist_creado_por,
        ua.usua_nombre AS hist_actualizado_por,
        d.diag_nombre AS hist_diagnostico
    FROM tbl_historial_clinico AS h
        INNER JOIN tbl_diagnosticos     AS d   ON h.hist_diagnostico       = d.id_diagnostico
        INNER JOIN tbl_pacientes        AS p   ON h.hist_paciente          = p.id_paciente
        INNER JOIN tbl_usuarios         AS up  ON p.paci_usuario           = up.id_usuario
        INNER JOIN tbl_especialistas    AS e_c ON h.hist_creado_por        = e_c.id_especialista
        INNER JOIN tbl_usuarios         AS uc  ON e_c.espe_usuario         = uc.id_usuario
        INNER JOIN tbl_especialistas    AS e_a ON h.hist_actualizado_por   = e_a.id_especialista
        INNER JOIN tbl_usuarios         AS ua  ON e_a.espe_usuario         = ua.id_usuario;
END //

DELIMITER ;

DELIMITER //
CREATE PROCEDURE ObtenerPQRs()
BEGIN
    SELECT
        pq.*,
        u.usua_nombre                          AS nombre_usuario,
        uemp.usua_nombre                       AS nombre_empleado
    FROM tbl_pqrs         AS pq
    JOIN tbl_usuarios     AS u    ON pq.pqrs_usuario  = u.id_usuario
    LEFT JOIN tbl_empleados AS e  ON pq.pqrs_empleado = e.id_empleado
    LEFT JOIN tbl_usuarios  AS uemp ON e.empl_usuario = uemp.id_usuario
    ORDER BY
        CASE pq.pqrs_estado
            WHEN 'Pendiente' THEN 1
            ELSE 2
        END;
END //

DELIMITER ;