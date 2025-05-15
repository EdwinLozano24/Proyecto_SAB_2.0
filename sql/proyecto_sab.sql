CREATE DATABASE IF NOT EXISTS proyecto_sab;

USE proyecto_sab;

CREATE TABLE IF NOT EXISTS tbl_especialidades (
	id_especialidad INT AUTO_INCREMENT PRIMARY KEY,
    esp_nombre VARCHAR(255) NOT NULL,
    esp_descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS tbl_usuarios (
	id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usua_nombre VARCHAR(100) NOT NULL,
	usua_documento INT(11) NOT NULL,
    usua_tipo_documento ENUM ('CC (Cédula de ciudadanía)','TI (Tarjeta de identidad)','CE (Cédula de extrangería)','PED (Permiso especial de permanencia)','PAS (Pasaporte)','NIT (úmero de identificación triburaria)','Otro'),
    usua_correo_electronico VARCHAR(255) NOT NULL,
    usua_direccion VARCHAR(100) NOT NULL,
    usua_num_contacto VARCHAR(15) NOT NULL,
    usua_num_secundario VARCHAR(15) NOT NULL,
    usua_fecha_nacimiento DATE NOT NULL,
    usua_sexo ENUM ('Masculino','Femenino'),
    usua_rh ENUM('O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'),
    usua_eps VARCHAR(100) NOT NULL,
    usua_tipo ENUM ('Paciente','Empleado','Especialista'),
    usua_estado ENUM ('Activo','Inactivo')
);

CREATE TABLE IF NOT EXISTS tbl_pacientes (
	id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL
);

CREATE TABLE IF NOT EXISTS tbl_empleados (
	id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL
);

CREATE TABLE IF NOT EXISTS tbl_especialistas (
	id_especialista INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    espe_especialidad INT NOT NULL
);

CREATE TABLE IF NOT EXISTS tbl_tratamientos (
	id_tratamiento INT AUTO_INCREMENT PRIMARY KEY,
    trat_nombre VARCHAR (60) NOT NULL,
    trat_duracion VARCHAR (100) NOT NULL,
    trat_descripcion VARCHAR (255) NOT NULL,
    trat_estado ENUM ('Activo', 'Inactivo'),
);

CREATE TABLE IF NOT EXISTS tbl_historialClinico (
	id_historialClinico INT AUTO_INCREMENT PRIMARY KEY,
    hist_fecha DATE NOT NULL,
    hist_notas_clinicas VARCHAR (255) NOT NULL,
    hist_radiografias VARCHAR (255) NOT NULL,
    hist_diagnostico VARCHAR (255) NOT NULL,
);

CREATE TABLE IF NOT EXISTS tbl_citas (
	id_cita INT AUTO_INCREMENT PRIMARY KEY,
    cita_usuario INT(11) NOT NULL,
    cita_especialista INT NOT NULL,
    cita_fecha DATE NOT NULL,
    cita_hora TIME NOT NULL,
    cita_consultorio INT NOT NULL,
    cita_motivo ENUM('Consulta general', 'Control', 'Urgencia', 'Seguimiento', 'Examen', 'Otro'),
    cita_observacion VARCHAR(255) NOT NULL,
    cita_estado ENUM('Cumplida','Incumplida','Proceso')
);

CREATE TABLE IF NOT EXISTS tbl_consultorios(
	id_consultorio INT AUTO_INCREMENT PRIMARY KEY,
    cons_numero VARCHAR(10) NOT NULL
);

ALTER TABLE tbl_pacientes
ADD CONSTRAINT fk_usuario_paciente
FOREIGN KEY (id_usuario)
REFERENCES tbl_usuarios(id_usuario);

ALTER TABLE tbl_empleados
ADD CONSTRAINT fk_usuario_empleado
FOREIGN KEY (id_usuario)
REFERENCES tbl_usuarios(id_usuario);

ALTER TABLE tbl_especialistas
ADD CONSTRAINT fk_usuario_especialista
FOREIGN KEY (id_usuario)
REFERENCES tbl_usuarios(id_usuario);

ALTER TABLE tbl_especialistas
ADD CONSTRAINT fk_especialista_especialidad
FOREIGN KEY (espe_especialidad)
REFERENCES tbl_especialidades(id_especialidad);

ALTER TABLE tbl_tratamientos
ADD CONSTRAINT fk_tratamiento_citas
FOREIGN KEY (id_tratamiento)
REFERENCES tbl_citas(id_cita);

ALTER TABLE tbl_tratamientos
ADD CONSTRAINT fk_tratamiento_historialClinico
FOREIGN KEY ()
REFERENCES ();

ALTER TABLE tbl_citas
ADD CONSTRAINT fk_cita_usuario
FOREIGN KEY (cita_usuario)
REFERENCES tbl_usuarios(id_usuario);

ALTER TABLE tbl_citas
ADD CONSTRAINT fk_cita_especialista
FOREIGN KEY (cita_especialista)
REFERENCES tbl_especialistas(id_especialista);

ALTER TABLE tbl_citas
ADD CONSTRAINT fk_cita_consultorio
FOREIGN KEY (cita_consultorio)
REFERENCES tbl_consultorios(id_consultorio);
