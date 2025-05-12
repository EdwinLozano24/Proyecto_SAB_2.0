-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2025 a las 17:24:17
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_sab_final`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `int_especialistas_historial`
--

CREATE TABLE `int_especialistas_historial` (
  `espe_id` int(11) NOT NULL,
  `hist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_catalogo_trat`
--

CREATE TABLE `tbl_catalogo_trat` (
  `cat_id` int(10) NOT NULL,
  `cat_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_costos` float(8,2) NOT NULL,
  `cat_recomendaciones` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_estado` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_procedimiento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_duracion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `car_Categoria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_trat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_catalogo_trat`
--

INSERT INTO `tbl_catalogo_trat` (`cat_id`, `cat_nombre`, `cat_costos`, `cat_recomendaciones`, `cat_estado`, `cat_procedimiento`, `cat_duracion`, `car_Categoria`, `cat_descripcion`, `cat_trat_id`) VALUES
(1, 'Limpieza', 1000000.00, 'Elimina la placa y el sarro que no se pueden eliminar con el cepillo regular.', 'Activo', 'Limpieza', '1 semana', 'Limpieza', 'Elimina la placa y el sarro que no se pueden eliminar con el cepillo regular.', 1),
(2, 'Blanquiamiento Dental', 1000000.00, 'Procedimiento estetico que ayuda a reducir las manchas y decoloraciones de los dientes', 'Activo', 'Blanquiamiento Dental', '1 hora', 'Blanquiamiento Dental', 'Procedimiento estetico que ayuda a reducir las manchas y decoloraciones de los dientes.', 2),
(3, 'Revision Dental', 50000.00, 'Esencial para detectar problemas en sus primeras etapas.', 'Activo', 'Revision Dental', '30 minutos', 'Revision Dental', 'Esencial para detectar problemas en sus primeras etapas.', 3),
(4, 'Extraccion Dental', 280000.00, 'Se retira un diente da?ado o problem?tico por los problemas que causa.', 'Inactivo', 'Extraccion Dental', '1 hora y media', 'Extraccion Dental', 'Se retira un diente da?ado o problem?tico por los problemas que causa.', 4),
(5, 'Protesis dental', 1000000.00, 'Protesis dentales para reemplazar dientes faltantes.', 'Activo', 'Protesis dental', '1 semana', 'Protesis dental', 'Protesis dentales para reemplazar dientes faltantes.', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_citas`
--

CREATE TABLE `tbl_citas` (
  `cit_fecha` date NOT NULL,
  `cit_hora` time NOT NULL,
  `cit_especialista` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cit_examen_clinico` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cit_estado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cit_disponibilidad` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cit_cons_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_citas`
--

INSERT INTO `tbl_citas` (`cit_fecha`, `cit_hora`, `cit_especialista`, `cit_examen_clinico`, `cit_estado`, `cit_disponibilidad`, `cit_cons_id`) VALUES
('2024-12-05', '10:00:00', 'Julio Ramiro', 'Consulta para limpieza', 'Pendiente', 'Disponible', 303),
('2025-01-24', '13:00:00', 'Fabian Rodriguez', 'Consulta para limpieza', 'Pendiente', 'Disponible', 305),
('2025-03-27', '11:00:00', 'Paola Machado', 'Consulta para tratamiento', 'Pendiente', 'Disponible', 304),
('2025-05-29', '13:00:00', 'Marco Apolo', 'Consulta para tratamiento', 'Pendiente', 'Disponible', 305),
('2025-07-30', '14:00:00', 'Dereck Reus', 'Consulta para limpieza', 'Pendiente', 'Disponible', 304);

--
-- Disparadores `tbl_citas`
--
DELIMITER $$
CREATE TRIGGER `Dis_Actualizar_Cita_Especialista` AFTER UPDATE ON `tbl_citas` FOR EACH ROW INSERT into Auditoria_sab (usuario,fecha,cambio) VALUES (CURRENT_USER, CURRENT_TIMESTAMP, CONCAT("Se han actualizado los datos de la cita:  ",new.cit_fecha,", ",new.cit_hora,", Asignada al especialista: ",new.cit_especialista))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Dis_Generar_Cita` AFTER INSERT ON `tbl_citas` FOR EACH ROW INSERT INTO int_generar
(gen_cita_fecha, gen_cita_hora, gen_cita_especialista) VALUES
(new.cit_fecha, new.cit_hora, new.cit_especialista)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Dis_Modifiacion_Cita` AFTER UPDATE ON `tbl_citas` FOR EACH ROW INSERT INTO auditoria_sab
(usuario,fecha,cambio) VALUES
(CURRENT_USER, CURRENT_TIMESTAMP,CONCAT ("Se a realizado una modificacion en la cita identificada con los datos: " ,new.cit_fecha,", ",new.cit_hora,", ",new.cit_especialista))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_consultorio`
--

CREATE TABLE `tbl_consultorio` (
  `cons_id` int(10) NOT NULL,
  `cons_nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cons_especialidad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cons_ubicacion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_consultorio`
--

INSERT INTO `tbl_consultorio` (`cons_id`, `cons_nombre`, `cons_especialidad`, `cons_ubicacion`) VALUES
(301, 'Ortodoncia', 'Unidad de ortodoncia', 'Piso 3 '),
(302, 'Endodoncia', 'Unidad de endodoncia', 'Piso 3 '),
(303, 'Valoracion ', 'Unidad de valoracion oral', 'Piso 3 '),
(304, 'Cirugia Oral', 'Unidad de cirugia oral', 'Piso 3 '),
(305, 'Protesis Dentales', 'Unidad de protesis dentales', 'Piso 3 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleados`
--

CREATE TABLE `tbl_empleados` (
  `empl_id` int(10) NOT NULL,
  `empl_cedula` int(10) NOT NULL,
  `empl_nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `empl_direccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `empl_disponibilidad` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `empl_contraseña` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `empl_num_contacto` bigint(20) NOT NULL,
  `empl_num_secundario` bigint(20) NOT NULL,
  `empl_estado` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `empl_correo_electronico` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `empl_fecha_nacimiento` date NOT NULL,
  `empl_sexo_id` tinyint(4) NOT NULL,
  `empl_rh_id` tinyint(4) NOT NULL,
  `empl_eps_id` int(11) NOT NULL,
  `empl_doc_id` tinyint(4) NOT NULL,
  `empl_rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_empleados`
--

INSERT INTO `tbl_empleados` (`empl_id`, `empl_cedula`, `empl_nombre`, `empl_direccion`, `empl_disponibilidad`, `empl_contraseña`, `empl_num_contacto`, `empl_num_secundario`, `empl_estado`, `empl_correo_electronico`, `empl_fecha_nacimiento`, `empl_sexo_id`, `empl_rh_id`, `empl_eps_id`, `empl_doc_id`, `empl_rol_id`) VALUES
(1, 1009029491, 'Juan Salazar', 'Calle 9 ', 'Disponible', '123aa', 3200000008, 3401230000, 'Inactivo', 'juan123@gmail.com', '1990-09-24', 1, 2, 1, 2, 3),
(2, 1019239492, 'Maicol Rangel', 'Carrera 14', 'No disponible', '456aa', 3101000000, 3124500000, 'Activo', 'mairan234@gmail.com', '1997-11-12', 1, 5, 2, 2, 3),
(3, 1019349493, 'Daniel Rodriguez', 'Avenida 29', 'Disponible', '789aa', 3051000000, 3214000000, 'Activo', 'mont45@gmail.com', '2001-01-09', 1, 3, 4, 2, 1),
(4, 1089069495, 'Mia Calvo', 'Transversal 20', 'No disponible', '345aa', 3150000000, 3982300000, 'No activo', 'mia69@gmail.com', '1969-06-09', 2, 1, 2, 2, 2);

--
-- Disparadores `tbl_empleados`
--
DELIMITER $$
CREATE TRIGGER `Dis_Actualizacion_Empleado` AFTER UPDATE ON `tbl_empleados` FOR EACH ROW INSERT INTO Auditoria_sab (usuario,fecha,cambio) VALUES (CURRENT_USER(),CURRENT_TIMESTAMP,CONCAT("Se han actualizado los datos del empleado bajo el numero de documento: ",new.empl_cedula," y el nombre: ",new.empl_nombre,"  exitosamente."))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Dis_Borrar_Empleado` AFTER DELETE ON `tbl_empleados` FOR EACH ROW INSERT INTO Auditoria_sab (usuario,fecha,cambio) VALUES (CURRENT_USER(),CURRENT_TIMESTAMP,CONCAT("Se a eliminado el registro del empleado ",old.empl_nombre, "exitosamente."))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Dis_Registro_Empleado` AFTER INSERT ON `tbl_empleados` FOR EACH ROW INSERT INTO Auditoria_sab (usuario,fecha,cambio) VALUES (CURRENT_USER(),CURRENT_TIMESTAMP,CONCAT("Se a registrado un nuevo empleado exitosamente, Bajo el numero de documento: ",new.empl_cedula," y el nombre:",new.empl_nombre,"."))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_eps`
--

CREATE TABLE `tbl_eps` (
  `Eps_Id` int(2) NOT NULL,
  `Eps_Nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Eps_Num_Contacto` bigint(20) NOT NULL,
  `Eps_Direccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_eps`
--

INSERT INTO `tbl_eps` (`Eps_Id`, `Eps_Nombre`, `Eps_Num_Contacto`, `Eps_Direccion`) VALUES
(1, 'FamiSanar', 3010000000, 'Av 7 '),
(2, 'Compensar', 3020000000, 'Av 15c'),
(3, 'CooSalud', 3030000000, 'Calle 23S'),
(4, 'CapitalSalud', 3040000000, 'Av Chile'),
(5, 'SaludTotal', 3050000000, 'Carrera 114c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_especialidades`
--

CREATE TABLE `tbl_especialidades` (
  `esp_id` int(10) NOT NULL,
  `esp_nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `esp_descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_especialidades`
--

INSERT INTO `tbl_especialidades` (`esp_id`, `esp_nombre`, `esp_descripcion`) VALUES
(1, 'Ortodoncista', 'Procedimientos Esteticos'),
(2, 'Endodoncista', 'Tratamientos Bucales'),
(3, 'Odontologo  ', 'Encargado de valoracion'),
(4, 'Cirujano Oral', 'Procedimientos Quirurjicos'),
(5, 'Prostodoncista', 'Diseño de protesis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_especialistas`
--

CREATE TABLE `tbl_especialistas` (
  `espe_id` int(10) NOT NULL,
  `espe_num_documento` int(11) NOT NULL,
  `espe_nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `espe_num_contacto` bigint(20) NOT NULL,
  `espe_correo_electronico` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `espe_estado` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `espe_esp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_especialistas`
--

INSERT INTO `tbl_especialistas` (`espe_id`, `espe_num_documento`, `espe_nombre`, `espe_num_contacto`, `espe_correo_electronico`, `espe_estado`, `espe_esp_id`) VALUES
(1, 1009019445, 'Julio Ramiro', 3000000000, 'ramiro45@gmail.com', 'Disponible', 1),
(2, 1029019478, 'Paola Machado', 3000000000, 'macha2003@hotmail.com', 'No disponible', 1),
(3, 1109019498, 'Fabian Rodriguez', 3000000000, 'rodri23@hotmail.com', 'Disponible', 2),
(4, 1209019442, 'Marco Apolo', 3000000000, 'apolo2003@gmail.com', 'No disponible', 2),
(5, 1309019441, 'Dereck Reus', 3000000000, 'reus24@hotmail.com', 'Disponible', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_historia_clinica`
--

CREATE TABLE `tbl_historia_clinica` (
  `hist_id` int(10) NOT NULL,
  `hist_historial_clinico` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hist_Antecedentes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hist_Radiografias` blob NOT NULL,
  `hist_examen_clinico` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hist_especialista` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hist_plan_tratamiento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hist_notas_clinicas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hist_diagnostico` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hist_fecha` date NOT NULL,
  `hist_paci_num_documento` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_historia_clinica`
--

INSERT INTO `tbl_historia_clinica` (`hist_id`, `hist_historial_clinico`, `hist_Antecedentes`, `hist_Radiografias`, `hist_examen_clinico`, `hist_especialista`, `hist_plan_tratamiento`, `hist_notas_clinicas`, `hist_diagnostico`, `hist_fecha`, `hist_paci_num_documento`) VALUES
(1, 'Caries dental profunda en diente num16', 'Carie dental tratada con empaste de amalgama en diente #36.', 0x6e756c6c, 'Caries dental profunda en diente num16', 'Paola Machado', 'Tratamiento de primera elecci?n en casos de destrucci?n amplia de las piezas dentales', 'Limpieza', 'El paciente no debe consumir ningun alimentos durante 1 hora.', '2024-11-09', 1019019492),
(2, 'Enfermedad periodontal cronica', 'Extraccion tercer molar superior derecho.', 0x6e756c6c, 'Enfermedad periodontal cronica', 'Paola Machado', 'Tratamiento de blanqueamiento dental', 'Blanquiamiento Dental', 'El paciente debe dejar de consumir bebidas oscuras para cuidar el tratamiento en cuestion.', '2024-12-01', 1033421135),
(3, 'Bruximos nocturno con degaste', 'Colocacion coronas de porcelana en dientes #11 y #21.', 0x6e756c6c, 'Bruximos nocturno con degaste', 'Fabian Rodriguez', 'Tratamiento para valorar la salud dental del paciente', 'Revision Dental', 'El paciente debe mejorar higiene de sue?o.', '2024-11-02', 1140915008),
(4, 'Lesiones ulceradas de 1cm en lengua', 'Tratamiento de ortodoncia a los 16 a?os.', 0x6e756c6c, 'Lesiones ulceradas de 1cm en lengua', 'Marco Apolo', 'Tratamiento para la extraccion de muelas ', 'Extraccion Dental', 'El paciente no es atento a las recomendaciones que brinda el especialista.', '2024-12-22', 1032677405),
(5, 'Frenillo labial superior corto', 'Enfermedad periodontal tratada hace 5 a?os, con raspaje y alisado.', 0x6e756c6c, 'Frenillo labial superior corto', 'Dereck Reus', 'Tratamiento de protesis dental', 'Protesis dental', 'El paciente no debe consumir ningun alimentos durante 1 hora.', '2025-01-20', 1070592663);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pacientes`
--

CREATE TABLE `tbl_pacientes` (
  `paci_num_documento` int(10) NOT NULL,
  `paci_nombre` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `paci_correo_electronico` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `paci_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `paci_num_contacto` bigint(20) DEFAULT NULL,
  `paci_direccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paci_fecha_nacimiento` date DEFAULT NULL,
  `paci_num_acudiente` bigint(20) DEFAULT NULL,
  `paci_estado` enum('Activo','Inactivo','','') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Activo',
  `paci_eps` text NOT NULL,
  `paci_sexo` enum('Masculino','Femenino','','') NOT NULL,
  `paci_rh` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `paci_tipo_documento` enum('Cédula','Tarjeta de Identidad','Pasaporte','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_pacientes`
--

INSERT INTO `tbl_pacientes` (`paci_num_documento`, `paci_nombre`, `paci_correo_electronico`, `paci_password`, `paci_num_contacto`, `paci_direccion`, `paci_fecha_nacimiento`, `paci_num_acudiente`, `paci_estado`, `paci_eps`, `paci_sexo`, `paci_rh`, `paci_tipo_documento`) VALUES
(123213, 'asdasdasd', 'adasd@gmail.com', '$2y$10$43G2mbYN9XiYDqkJqnue7uc.ZIREhjGd9pz5qveEY7/YHdbsB/uoO', 123213, 'adasdsad', '2025-05-06', 12312323, 'Activo', 'asdads', 'Masculino', 'AB-', 'Cédula'),
(1070592663, 'Santiago Carranza Carrillo', 'santiagocarranzacarrillo@gmail.com', '$2y$10$ZJvP7LLRje6IHf0jBZQIi.1rorwgH8SvFRebAutOvcLrag7r4NoIu', 3209295978, 'Cra 74A #74B', '2006-06-17', 3209295978, 'Activo', 'Sanitas', 'Masculino', 'O+', 'Cédula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pqrs`
--

CREATE TABLE `tbl_pqrs` (
  `pqr_id` int(10) NOT NULL,
  `pqr_estado` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pqr_tipo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pqr_contenido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pqr_fecha_envio` date NOT NULL,
  `pqr_fecha_respuesta` date NOT NULL,
  `pqr_respuesta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pqr_paci_num_documento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_pqrs`
--

INSERT INTO `tbl_pqrs` (`pqr_id`, `pqr_estado`, `pqr_tipo`, `pqr_contenido`, `pqr_fecha_envio`, `pqr_fecha_respuesta`, `pqr_respuesta`, `pqr_paci_num_documento`) VALUES
(1, 'Completado', 'Cita', 'No estaba mi especialista cuando fui a la cita.', '2024-09-21', '0000-00-00', 'Ejemplo_01', 1019019492),
(2, 'Completado', 'Agendamiento', 'No me dejo agendar cita.', '2024-08-31', '0000-00-00', NULL, 1033421135),
(3, 'Completado', 'Cita', 'No pude ir a la cita y me cobraron 3 citas de mas.', '2024-03-04', '0000-00-00', NULL, 1140915008),
(4, 'En espera', 'Agendamiento', 'No me salio disponible niguna cita.', '2024-01-09', '0000-00-00', NULL, 1032677405),
(5, 'Completado', 'Cita', 'Quiero reagendar mi cita lo mas pronto posible.', '2024-07-07', '0000-00-00', NULL, 1070592663);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tratamientos`
--

CREATE TABLE `tbl_tratamientos` (
  `trat_id` int(10) NOT NULL,
  `trat_descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trat_nombre` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trat_determinado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trat_objetivos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trat_observaciones` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trat_estado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trat_procedimientos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trat_tiempo_estimado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trat_costos` float(8,2) NOT NULL,
  `trat_fecha_finalizacion` date NOT NULL,
  `trat_paci_num_documento` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_tratamientos`
--

INSERT INTO `tbl_tratamientos` (`trat_id`, `trat_descripcion`, `trat_nombre`, `trat_determinado`, `trat_objetivos`, `trat_observaciones`, `trat_estado`, `trat_procedimientos`, `trat_tiempo_estimado`, `trat_costos`, `trat_fecha_finalizacion`, `trat_paci_num_documento`) VALUES
(1, 'Tratamiento de primera eleccion en casos de destruccio\r\nn amplia de las piezas dentales', 'Limpieza', 'Ortodoncia', 'Eliminar la pulpa dental infectada o inflamada para detener la propagacion de la infeccion y preservar el diente natural', 'El paciente se presento para el tratamiento de una infeccion en la pulpa dental, Se administro anestesia local para asegurar la comodidad del paciente durante el procedimiento y se realiz? una apertura en la corona del diente para acceder a la pulpa denta', 'Realizado', 'Procedimiento Ortondoncia', '1 semana', 1000000.00, '2024-12-03', 1019019492),
(2, 'Tratamiento de blanqueamiento dental', 'Blanquiamiento Dental', 'Endodoncia', 'Hacer un blaqueamiento y limpieza de los dientes', 'El paciente solicito y pago para un tratamiento y en estos momentos se estan esperando al paciente en el consultorio pero no ha llegado ', 'En proceso', 'Procedimiento Endodoncia', '1 hora', 1000000.00, '2024-11-26', 1033421135),
(3, 'Tratamiento para valorar la salud dental del paciente', 'Revision Dental', 'Odontologia', 'Revision general de la dentura del paciente', 'El paciente se presento para la revision general de su dentadura y se pudo concluir que este no presenta ningun tipo de da?o ni caries', 'Realizado', 'Procedimiento  Odontologico', '30 minutos', 50000.00, '2024-11-26', 1140915008),
(4, 'Tratamiento para la extraccion de muelas ', 'Extraccion Dental', 'Cirujano Oral', 'Extraer las muelas del juicio', 'El paciente no se presento para su extraccion de su muelas de juicio ni tampoco notifico el por que', 'Realizado', 'Procedimiento Cirujia Oral', '1 hora y media', 280000.00, '2024-11-26', 1032677405),
(5, 'Tratamiento de protesis dental', 'Protesis dental', 'Protodoncista', 'Restaurar la estetica de la dentura', 'El paciente se presento y se realizo la correcta reparacion estetica dental', 'Realizado', 'Procedimiento Protodoncista', '1 semana', 1000000.00, '2024-12-03', 1070592663);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `int_especialistas_historial`
--
ALTER TABLE `int_especialistas_historial`
  ADD PRIMARY KEY (`espe_id`,`hist_id`),
  ADD KEY `hist_id` (`hist_id`);

--
-- Indices de la tabla `tbl_catalogo_trat`
--
ALTER TABLE `tbl_catalogo_trat`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_trat_id` (`cat_trat_id`);

--
-- Indices de la tabla `tbl_citas`
--
ALTER TABLE `tbl_citas`
  ADD PRIMARY KEY (`cit_fecha`,`cit_hora`,`cit_especialista`),
  ADD KEY `cit_cons_id` (`cit_cons_id`);

--
-- Indices de la tabla `tbl_consultorio`
--
ALTER TABLE `tbl_consultorio`
  ADD PRIMARY KEY (`cons_id`);

--
-- Indices de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  ADD PRIMARY KEY (`empl_id`,`empl_cedula`),
  ADD UNIQUE KEY `empl_correo_electronico` (`empl_correo_electronico`),
  ADD KEY `empl_sexo_id` (`empl_sexo_id`),
  ADD KEY `empl_rh_id` (`empl_rh_id`),
  ADD KEY `empl_eps_id` (`empl_eps_id`),
  ADD KEY `empl_doc_id` (`empl_doc_id`),
  ADD KEY `empl_rol_id` (`empl_rol_id`);

--
-- Indices de la tabla `tbl_eps`
--
ALTER TABLE `tbl_eps`
  ADD PRIMARY KEY (`Eps_Id`);

--
-- Indices de la tabla `tbl_especialidades`
--
ALTER TABLE `tbl_especialidades`
  ADD PRIMARY KEY (`esp_id`);

--
-- Indices de la tabla `tbl_especialistas`
--
ALTER TABLE `tbl_especialistas`
  ADD PRIMARY KEY (`espe_id`),
  ADD UNIQUE KEY `espe_correo_electronico` (`espe_correo_electronico`),
  ADD KEY `espe_esp_id` (`espe_esp_id`);

--
-- Indices de la tabla `tbl_historia_clinica`
--
ALTER TABLE `tbl_historia_clinica`
  ADD PRIMARY KEY (`hist_id`),
  ADD KEY `hist_paci_num_documento` (`hist_paci_num_documento`);

--
-- Indices de la tabla `tbl_pacientes`
--
ALTER TABLE `tbl_pacientes`
  ADD PRIMARY KEY (`paci_num_documento`),
  ADD UNIQUE KEY `paci_correo_electronico` (`paci_correo_electronico`);

--
-- Indices de la tabla `tbl_pqrs`
--
ALTER TABLE `tbl_pqrs`
  ADD PRIMARY KEY (`pqr_id`),
  ADD KEY `pqr_paci_num_documento` (`pqr_paci_num_documento`);

--
-- Indices de la tabla `tbl_tratamientos`
--
ALTER TABLE `tbl_tratamientos`
  ADD PRIMARY KEY (`trat_id`),
  ADD KEY `trat_paci_num_documento` (`trat_paci_num_documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  MODIFY `empl_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_especialidades`
--
ALTER TABLE `tbl_especialidades`
  MODIFY `esp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_especialistas`
--
ALTER TABLE `tbl_especialistas`
  MODIFY `espe_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_historia_clinica`
--
ALTER TABLE `tbl_historia_clinica`
  MODIFY `hist_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tbl_pqrs`
--
ALTER TABLE `tbl_pqrs`
  MODIFY `pqr_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_tratamientos`
--
ALTER TABLE `tbl_tratamientos`
  MODIFY `trat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `int_especialistas_historial`
--
ALTER TABLE `int_especialistas_historial`
  ADD CONSTRAINT `int_especialistas_historial_ibfk_1` FOREIGN KEY (`espe_id`) REFERENCES `tbl_especialistas` (`espe_id`),
  ADD CONSTRAINT `int_especialistas_historial_ibfk_2` FOREIGN KEY (`hist_id`) REFERENCES `tbl_historia_clinica` (`hist_id`);

--
-- Filtros para la tabla `tbl_catalogo_trat`
--
ALTER TABLE `tbl_catalogo_trat`
  ADD CONSTRAINT `tbl_catalogo_trat_ibfk_2` FOREIGN KEY (`cat_trat_id`) REFERENCES `tbl_tratamientos` (`trat_id`);

--
-- Filtros para la tabla `tbl_citas`
--
ALTER TABLE `tbl_citas`
  ADD CONSTRAINT `tbl_citas_ibfk_1` FOREIGN KEY (`cit_cons_id`) REFERENCES `tbl_consultorio` (`cons_id`);

--
-- Filtros para la tabla `tbl_especialistas`
--
ALTER TABLE `tbl_especialistas`
  ADD CONSTRAINT `tbl_especialistas_ibfk_1` FOREIGN KEY (`espe_esp_id`) REFERENCES `tbl_especialidades` (`esp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
