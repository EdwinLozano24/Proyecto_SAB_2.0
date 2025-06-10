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
    usua_estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);

CREATE TABLE IF NOT EXISTS tbl_pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    paci_usuario INT NOT NULL UNIQUE,
    paci_fecha_registro DATE NOT NULL DEFAULT CURRENT_DATE,
    paci_contacto_emergencia VARCHAR(100),
    paci_telefono_emergencia VARCHAR(15),
    paci_ultima_visita DATE,
    paci_observaciones TEXT,
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
    cita_hora TIME NOT NULL,
    cita_turno ENUM('Mañana', 'Tarde') NOT NULL,
    cita_duracion INT NOT NULL,
    cita_consultorio INT NOT NULL,
    cita_motivo ENUM('Consulta general','Control','Urgencia','Seguimiento','Examen','Otro') DEFAULT 'Consulta general',
    cita_observacion TEXT NOT NULL,
    cita_estado ENUM('Cumplida','Incumplida','Proceso') DEFAULT 'Proceso',
    FOREIGN KEY (cita_paciente) REFERENCES tbl_pacientes(id_paciente),
    FOREIGN KEY (cita_especialista) REFERENCES tbl_especialistas(id_especialista),
    FOREIGN KEY (cita_consultorio) REFERENCES tbl_consultorios(id_consultorio)
);

CREATE TABLE IF NOT EXISTS tbl_citas_tratamientos (
    id_ct INT AUTO_INCREMENT PRIMARY KEY,
    ct_cita INT NOT NULL,
    ct_tratamiento INT NOT NULL,
    ct_observaciones TEXT,
    ct_fecha_aplicacion DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (ct_cita) REFERENCES tbl_citas(id_cita),
    FOREIGN KEY (ct_tratamiento) REFERENCES tbl_tratamientos(id_tratamiento)
);

CREATE TABLE IF NOT EXISTS tbl_historial_clinico (
    id_historial_clinico INT AUTO_INCREMENT PRIMARY KEY,
    hist_antecedentes VARCHAR(255) NOT NULL,
    hist_diagnostico VARCHAR(255) NOT NULL,
    hist_fecha_create TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    hist_fecha_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    hist_tratamiento INT NOT NULL,
    hist_paciente INT NOT NULL,
    hist_especialista INT NOT NULL,
    hist_cita INT NOT NULL
);  

ALTER TABLE tbl_tratamientos
  ADD CONSTRAINT fk_tratamiento_hist
    FOREIGN KEY (trat_historial)
    REFERENCES tbl_historialClinico(id_historiaClinica);


ALTER TABLE tbl_historialClinico
  ADD CONSTRAINT fk_historial_paciente
    FOREIGN KEY (hist_paciente)
    REFERENCES tbl_pacientes(id_paciente),
  ADD CONSTRAINT fk_historial_especialista
    FOREIGN KEY (hist_especialista)
    REFERENCES tbl_especialistas(id_especialista),
  ADD CONSTRAINT fk_historial_cita
    FOREIGN KEY (hist_cita)
    REFERENCES tbl_citas(id_cita),
  ADD CONSTRAINT fk_historial_tratamiento
    FOREIGN KEY (hist_tratamiento)
    REFERENCES tbl_tratamientos(id_tratamiento);