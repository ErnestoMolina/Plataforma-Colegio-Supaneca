-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2023 at 08:43 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plataforma`
--

-- --------------------------------------------------------

--
-- Table structure for table `actividades`
--

CREATE TABLE `actividades` (
  `Id` int(11) NOT NULL,
  `IdGrado` text,
  `IdMateria` text,
  `Nombre` text,
  `Descripcion` text,
  `Periodo` text,
  `TipoActividad` text,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actividades`
--

INSERT INTO `actividades` (`Id`, `IdGrado`, `IdMateria`, `Nombre`, `Descripcion`, `Periodo`, `TipoActividad`, `Fecha`) VALUES
(1, '1', '17', 'Aprendiendo a sumar fracciones', 'Solucionar los ejercicios sobre sumar fracciones mixtas. ', '3', 'Tarea', '2023-03-24 00:47:06'),
(4, '1', '17', 'Aprendiendo a restar fracciones', 'resolver los ejercicios ', '1', 'Taller', '2023-03-24 00:47:31'),
(6, '6', '30', 'Verbos en pasado ', 'Aprenderse los verbos en ingles', '2', 'Evaluación', '2023-03-24 00:47:38'),
(7, '5', '29', 'Mapas politicos de España', 'Calcar el mapa politico de España.', '3', 'Evaluación', '2023-03-24 00:47:43'),
(8, '1', '17', 'numeros primos', 'Traer los números primos del 1 al 100', '1', 'Evaluación', '2023-03-24 20:59:18'),
(9, '8', '17', 'Números imaginarios ', 'Solucionar los ejercicios ', '1', 'Tarea', '2023-03-24 00:47:53'),
(10, '12', '17', 'nominacion', 'numeros ', '1', 'Taller', '2023-03-24 00:47:58'),
(11, '6', '17', 'Fracciones Mixtas', 'Desarrollar las actividades planteadas por el docente.', '1', 'Evaluación', '2023-03-24 00:49:02'),
(12, '1', '17', 'numeros enteros', 'escribir los numeros en 1 al 10', '1', 'Evaluación', '2023-03-26 22:36:32'),
(13, '8', '17', 'Numeros Mayas', 'Traer escritos los numeros mayas del 1 al 100', '1', 'Tarea', '2023-03-26 22:41:33'),
(14, '1', '19', 'Leyes de Newton', 'Investigar la leyes de Newton.', '1', 'Tarea', '2023-03-29 23:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `acudientes`
--

CREATE TABLE `acudientes` (
  `IdAcudiente` int(11) NOT NULL,
  `NombresAcudiente` varchar(50) DEFAULT NULL,
  `ApellidosAcudiente` varchar(50) DEFAULT NULL,
  `TipoDocumentoAcudiente` varchar(50) DEFAULT NULL,
  `NDocumentoAcudiente` varchar(50) DEFAULT NULL,
  `FechaNacimientoAcudiente` date DEFAULT NULL,
  `TelefonoAcudiente` varchar(50) DEFAULT NULL,
  `CorreoElectronicoAcudiente` varchar(50) DEFAULT NULL,
  `ContraseñaAcudiente` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acudientes`
--

INSERT INTO `acudientes` (`IdAcudiente`, `NombresAcudiente`, `ApellidosAcudiente`, `TipoDocumentoAcudiente`, `NDocumentoAcudiente`, `FechaNacimientoAcudiente`, `TelefonoAcudiente`, `CorreoElectronicoAcudiente`, `ContraseñaAcudiente`) VALUES
(1, 'Valentina', 'Quesada Robles', 'Cedula de ciudadania', '1002654987', '2022-07-21', '312589476', 'Valentina@gmail.com', 'Valesita'),
(4, 'Leider', 'Galindo', 'Cedula de ciudadania', '1002456321', '2022-11-02', '3108745632', 'leiderrenegalindo@gmail.com', 'juli'),
(5, 'Yesica Natalia', 'Casteblanco Torres ', 'Cedula de ciudadania', '1002654789', '1984-02-01', '3157489354', 'Yesica@gmail.com', '321'),
(6, 'Danna', 'Rodriguez', 'Cedula de ciudadania', '1234567890', '2022-11-04', '3102589631', 'DannaRodriguez@gmail.com', 'HwnctaM='),
(7, 'yasmin', 'pedraza', 'Cedula de ciudadania', '1234567897', '1990-06-02', '12345678911212', 'yasmin@gmail.com', 'Gg7ZsKQ=');

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `IdAdministrador` int(11) NOT NULL,
  `NombresAdministrador` varchar(50) DEFAULT NULL,
  `ApellidosAdministrador` varchar(50) DEFAULT NULL,
  `TipoDocumentoAdministrador` varchar(50) DEFAULT NULL,
  `NDocumentoAdministrador` varchar(50) DEFAULT NULL,
  `FechaNacimientoAdministrador` date DEFAULT NULL,
  `TelefonoAdministrador` varchar(50) DEFAULT NULL,
  `CorreoelectronicoAdministrador` varchar(50) DEFAULT NULL,
  `Contraseña` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`IdAdministrador`, `NombresAdministrador`, `ApellidosAdministrador`, `TipoDocumentoAdministrador`, `NDocumentoAdministrador`, `FechaNacimientoAdministrador`, `TelefonoAdministrador`, `CorreoelectronicoAdministrador`, `Contraseña`) VALUES
(1, 'Ernesto', 'Galindo Molina', 'Cedula de ciudadania', '1002565211', '2002-07-06', '3225967088', 'helverzon@gmail.com', 'HwnctaM=');

-- --------------------------------------------------------

--
-- Table structure for table `calificaciones`
--

CREATE TABLE `calificaciones` (
  `Id` int(11) NOT NULL,
  `IdActividad` int(11) DEFAULT NULL,
  `IdEstudiante` int(11) DEFAULT NULL,
  `IdGrado` int(11) DEFAULT NULL,
  `IdMateria` int(11) DEFAULT NULL,
  `IdPeriodo` int(11) DEFAULT NULL,
  `Calificacion` float DEFAULT NULL,
  `Observacion` text,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calificaciones`
--

INSERT INTO `calificaciones` (`Id`, `IdActividad`, `IdEstudiante`, `IdGrado`, `IdMateria`, `IdPeriodo`, `Calificacion`, `Observacion`, `Fecha`) VALUES
(1, 9, 2, 8, 17, 1, 1, 'El perro ese no quiso hacer la tarea.', '2023-03-24 21:37:37'),
(2, 9, 5, 8, 17, 1, 3.5, '', '2023-03-24 21:37:37'),
(4, 9, 7, 8, 17, 1, 4.5, '', '2023-03-24 21:37:37'),
(5, 10, 9, 12, 17, 1, 1, '', '2023-03-24 21:39:23'),
(6, 4, 12, 1, 17, 1, 3.7, 'completo 7 de 10 puntos de la actividad.', '2023-03-24 21:36:26'),
(7, 8, 12, 1, 17, 1, 4.9, 'casi', '2023-03-24 21:37:01'),
(8, 1, 12, 1, 17, 3, 5, '', '2023-03-24 21:44:01'),
(9, 12, 12, 1, 17, 1, 3.1, '', '2023-03-26 22:37:24'),
(10, 13, 2, 8, 17, 1, 5, '', '2023-03-26 22:43:55'),
(11, 13, 5, 8, 17, 1, 3, '', '2023-03-26 22:43:55'),
(12, 13, 7, 8, 17, 1, 4, '', '2023-03-26 22:43:55'),
(13, 14, 12, 1, 19, 1, 5, '', '2023-03-29 23:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `definitivas`
--

CREATE TABLE `definitivas` (
  `Id` int(11) NOT NULL,
  `IdGrado` int(11) DEFAULT NULL,
  `IdMateria` int(11) DEFAULT NULL,
  `Periodo` int(11) DEFAULT NULL,
  `IdEstudiante` int(11) DEFAULT NULL,
  `Desempeño` text,
  `Calificacion` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `definitivas`
--

INSERT INTO `definitivas` (`Id`, `IdGrado`, `IdMateria`, `Periodo`, `IdEstudiante`, `Desempeño`, `Calificacion`) VALUES
(1, 1, 17, 1, 12, 'Basico', 3.61),
(2, 8, 17, 1, 2, 'Bajo', 1.3),
(3, 8, 17, 1, 5, 'Bajo', 1.34),
(4, 8, 17, 1, 7, 'Bajo', 1.49),
(5, 1, 19, 1, 12, 'Alto', 4.2);

-- --------------------------------------------------------

--
-- Table structure for table `docentes`
--

CREATE TABLE `docentes` (
  `IdDocente` int(25) NOT NULL,
  `NombresDocente` varchar(50) DEFAULT NULL,
  `ApellidosDocente` varchar(50) DEFAULT NULL,
  `TipoDocumentoDocente` varchar(50) DEFAULT NULL,
  `NDocumentoDocente` int(25) DEFAULT NULL,
  `FechaNacimientoDocente` date DEFAULT NULL,
  `CorreoElectronicoDocente` varchar(50) DEFAULT NULL,
  `TelefonoDocente` varchar(20) DEFAULT NULL,
  `ContraseñaDocente` varchar(50) DEFAULT NULL,
  `idMateria` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `docentes`
--

INSERT INTO `docentes` (`IdDocente`, `NombresDocente`, `ApellidosDocente`, `TipoDocumentoDocente`, `NDocumentoDocente`, `FechaNacimientoDocente`, `CorreoElectronicoDocente`, `TelefonoDocente`, `ContraseñaDocente`, `idMateria`) VALUES
(6, 'Alfonso', 'Galindo Molina', 'Cedula de ciudadania', 1002565211, '2002-07-06', 'Helverzon@gmail.com', '3225967088', 'HwnctaPl', '[\"17\",\"19\"]'),
(8, 'Juan', 'Bautista', 'Cedula de ciudadania', 1002565211, '2022-11-05', 'Juanitha@gmail.com', '3125896412', 'Ciencia', '[\"27\"]'),
(9, 'Ernesto', 'Galindo', 'Cedula de ciudadania', 1002321589, '2022-11-03', 'helverzon@gmail.com', '3165897456', 'Hola', '[\"19\"]'),
(10, 'José Sneyder', 'Galindo', 'Cedula de ciudadania', 852, '2022-11-11', 'helverzon@gmail.com', '348632145', 'Ney', '[\"17\",\"18\"]'),
(11, 'Ernesto', 'Galindo', 'Cedula de ciudadania', 1002587902, '2022-11-18', 'helverzon@gmail.com', '3158963369', 'Polo', '[\"18\"]'),
(12, 'Ernesto', 'Galindo', 'Cedula de ciudadania', 1003654789, '2022-12-03', 'helverzon@gmail.com', '3008963214', 'Gw/cs6c=', '[\"28\"]'),
(13, 'Ernesto', 'Galindo', 'Tarjeta de identidad', 4563258, '2022-12-31', 'helverzon@gmail.com', '312589476', 'T12O5/A=', '[\"18\"]'),
(17, 'Yolima', 'Miapira', 'Cedula de ciudadania', 2356, '2023-02-10', 'YolimaMiapira@gmail.com', '312589476', 'GA7bsqTi', '[\"29\"]'),
(18, 'Oscar', 'Pedraza', 'Cedula de ciudadania', 8956, '2023-02-01', 'OscarPedraza@gmail.com', '312589476', 'FwPYt6M=', '[\"31\"]'),
(20, 'Marco', 'Tulio', 'Cedula de ciudadania', 246724, '2023-02-03', 'MarcoTulio@gmail.com', '312589476', 'HgrdsqI=', '[\"17\"]'),
(22, 'Leider Rene', 'Galindo Molina', 'Cedula de ciudadania', 1002565489, '2023-02-03', 'LeiderMolina@gmail.com', '3102564789', 'alqW4Piy', '[\"30\"]'),
(23, 'Leider Rene', 'Galindo Molina', 'Cedula de ciudadania', 2106150, '2023-02-04', 'LeiderMolina@gmail.com', '310054545', 'Hw/a', '[\"30\"]'),
(24, 'Pedro', 'Aranda López', 'Cedula de ciudadania', 222, '2023-01-31', 'helverzon@gmail.com', '322596708', 'HQk=', '[\"27\"]'),
(26, 'Joshxs', 'Keller', 'Cedula de ciudadania', 23, '2023-02-08', 'JoshKeller@gmail.com', '23', 'XEnb', '[\"28\"]'),
(27, 'Juansx', 'Bautista', 'Cedula de ciudadania', 2332, '2023-02-14', 'Juanitha@gmail.com', '310054545', 'VkOX+Q==', '[\"33\"]'),
(28, 'Juansxxs', 'Bautista', 'Cedula de ciudadania', 4446666, '2023-02-23', 'Juanitha@gmail.com', '310054545', 'Gg4=', '[\"19\"]'),
(29, 'Ernesto', 'Galindo', 'Cedula de ciudadania', 123456789, '1996-07-18', 'helverzon@gmail.com', '0123456789', 'HgrdsqLm', '[\"29\",\"31\"]'),
(35, 'Ernesto', 'Galindo Molina', 'Cedula de ciudadania', 12345678, '1995-07-12', 'helverzon@gmail.com', '0123456789', 'Hgrdsg==', '[\"18\",\"28\"]'),
(40, 'gabriel', 'Martinez', 'Cedula de ciudadania', 12036540, '1981-08-17', 'Gabriel@gmail.com', '3102589622', 'aVqN8/+2Lw==', '[\"18\"]');

-- --------------------------------------------------------

--
-- Table structure for table `docentes_grados`
--

CREATE TABLE `docentes_grados` (
  `IdDocentes_Grados` int(11) NOT NULL,
  `IdDocente` int(11) DEFAULT NULL,
  `IdGrado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `estudiantes`
--

CREATE TABLE `estudiantes` (
  `IdEstudiante` int(11) NOT NULL,
  `NombresEstudiante` varchar(50) NOT NULL,
  `ApellidosEstudiante` varchar(50) NOT NULL,
  `TipoDocumentoEstudiante` varchar(25) NOT NULL,
  `NDocumentoEstudiante` int(25) NOT NULL,
  `FechaNacimientoEstudiante` date NOT NULL,
  `GradoEstudiante` int(50) NOT NULL,
  `idAcudiente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estudiantes`
--

INSERT INTO `estudiantes` (`IdEstudiante`, `NombresEstudiante`, `ApellidosEstudiante`, `TipoDocumentoEstudiante`, `NDocumentoEstudiante`, `FechaNacimientoEstudiante`, `GradoEstudiante`, `idAcudiente`) VALUES
(2, 'Diego Alejandro', 'Parra Leon', 'Cedula de ciudadania', 1002658974, '2022-11-04', 8, 1),
(3, 'Ernesto', 'Galindo', 'Tarjeta de identidad', 1002365984, '2022-11-03', 2, 4),
(4, 'Julian Esteban', 'Lopez', 'Pasaporte', 1003256987, '2022-11-04', 6, 4),
(5, 'Paola', 'Moreno', 'Cedula Extranjera', 1002565233, '2022-10-30', 8, 5),
(7, 'Armando', 'Paredes', 'Tarjeta de identidad', 1002369741, '2022-11-02', 8, 4),
(8, 'José Sneyder', 'Galindo Salamanca', 'Tarjeta de identidad', 1002369456, '2001-11-24', 3, 5),
(9, 'Pedro', 'Aranda López', 'Tarjeta de identidad', 123456789, '2022-11-11', 12, 5),
(10, 'pablo', 'Galindo', 'Tarjeta de identidad', 1002569321, '2004-07-15', 5, 4),
(12, 'dgs', 'sgssg', 'Cedula de ciudadania', 551, '1800-12-12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grados`
--

CREATE TABLE `grados` (
  `IdGrado` int(11) NOT NULL,
  `NombreGrado` varchar(50) DEFAULT NULL,
  `DirectorGrado` int(11) DEFAULT NULL,
  `Matematicas` int(10) DEFAULT NULL,
  `Religion` int(10) DEFAULT NULL,
  `Fisica` int(10) DEFAULT NULL,
  `Naturales` int(10) DEFAULT NULL,
  `Español` int(10) DEFAULT NULL,
  `Ciencias_Sociales` int(10) DEFAULT NULL,
  `Ingles` int(10) DEFAULT NULL,
  `Ética` int(10) DEFAULT NULL,
  `Química` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grados`
--

INSERT INTO `grados` (`IdGrado`, `NombreGrado`, `DirectorGrado`, `Matematicas`, `Religion`, `Fisica`, `Naturales`, `Español`, `Ciencias_Sociales`, `Ingles`, `Ética`, `Química`) VALUES
(1, 'Preescolar', 6, 6, 10, 6, 8, 12, 17, 22, 18, 27),
(2, 'Primero', 28, 6, 10, 6, 8, 12, 17, 22, 18, 27),
(3, 'Segundo', 10, 6, 10, 9, 8, 12, 17, 22, 18, 27),
(4, 'Tercero', 18, 6, 10, 9, 8, 12, 17, 22, 18, 27),
(5, 'Cuarto', 26, 6, 10, 9, 8, 12, 17, 22, 18, 27),
(6, 'Quinto', 23, 6, 10, 6, 8, 12, 17, 22, 18, 27),
(7, 'Sexto', 35, 6, 10, 6, 8, 12, 17, 22, 18, 27),
(8, 'Septimo', 40, 6, 10, 6, 8, 12, 17, 22, 18, 27),
(9, 'Octavo', 17, 6, 10, 6, 8, 12, 17, 22, 18, 27),
(10, 'Noveno', 12, 6, 10, 6, 8, 12, 17, 22, 18, 27),
(11, 'Decimo', 22, 6, 10, 6, 8, 12, 17, 22, 18, 27),
(12, 'Once', 20, 6, 10, 6, 8, 12, 17, 22, 18, 27);

-- --------------------------------------------------------

--
-- Table structure for table `inasistencias`
--

CREATE TABLE `inasistencias` (
  `Id` int(11) NOT NULL,
  `IdEstudiante` int(11) DEFAULT NULL,
  `IdGrado` int(11) DEFAULT NULL,
  `IdMateria` int(11) DEFAULT NULL,
  `Periodo` text,
  `Descripcion` text,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inasistencias`
--

INSERT INTO `inasistencias` (`Id`, `IdEstudiante`, `IdGrado`, `IdMateria`, `Periodo`, `Descripcion`, `Fecha`) VALUES
(2, 3, 2, 18, '1', 'Se voló de las instalaciones del colegio', '2023-03-08'),
(3, 2, 8, 17, '2', 'enfermo', '2023-03-11'),
(4, 2, 8, 17, '1', 'enfermo', '2023-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `materias`
--

CREATE TABLE `materias` (
  `IdMateria` int(11) NOT NULL,
  `NombreMateria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materias`
--

INSERT INTO `materias` (`IdMateria`, `NombreMateria`) VALUES
(17, 'Matematicas'),
(18, 'Religion'),
(19, 'Fisica'),
(27, 'Naturales'),
(28, 'Español'),
(29, 'Ciencias_Sociales'),
(30, 'Ingles'),
(31, 'Ética '),
(33, 'Química');

-- --------------------------------------------------------

--
-- Table structure for table `materias_docentes`
--

CREATE TABLE `materias_docentes` (
  `IdMaterias_Docente` int(11) NOT NULL,
  `IdDocente` int(11) DEFAULT NULL,
  `IdMateria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `observaciones`
--

CREATE TABLE `observaciones` (
  `id` int(11) NOT NULL,
  `IdEstudiante` int(11) DEFAULT NULL,
  `Tipo` text,
  `Observacion` text,
  `VersionEstudiante` text,
  `Compromiso` text,
  `Seguimiento` int(11) DEFAULT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `observaciones`
--

INSERT INTO `observaciones` (`id`, `IdEstudiante`, `Tipo`, `Observacion`, `VersionEstudiante`, `Compromiso`, `Seguimiento`, `Fecha`) VALUES
(1, 12, 'Disciplinaria', 's', 's', 's', 6, '2023-03-20 17:39:04'),
(3, 12, 'Disciplinaria', '.ksajakladakaldlkjadkljaidjioajdiojdioajdio adad ad adoodjjoadoj adopjdajodpj aipdjapdjoj adoadoka odadpoajkdpo ad japjd pajod', 'vksajakladakaldlkjadkljaidjioajdiojdioajdio adad ad adoodjjoadoj adopjdajodpj aipdjapdjoj adoadoka odadpoajkdpo ad japjd ', 'cksajakladakaldlkjadkljaidjioajdiojdioajdio adad ad adoodjjoadoj adopjdajodpj aipdjapdjoj adoadoka odadpoajkdpo ad japjd pajod', 6, '2023-03-20 23:07:00'),
(4, 2, 'Disciplinaria', 'le pego a uno de sus compañeros', 'el empezó primero.', 'No le vuelvo a chuzar los ojos a Carlitos.', 6, '2023-03-21 12:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `observacionesdefinitivas`
--

CREATE TABLE `observacionesdefinitivas` (
  `Id` int(11) NOT NULL,
  `IdGrado` int(11) DEFAULT NULL,
  `IdMateria` int(11) DEFAULT NULL,
  `Desempeño` text,
  `Observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `observacionesdefinitivas`
--

INSERT INTO `observacionesdefinitivas` (`Id`, `IdGrado`, `IdMateria`, `Desempeño`, `Observaciones`) VALUES
(1, 1, 17, 'Bajo', ''),
(2, 1, 17, 'Basico', '•	Garantía de calidad del software: El software funciona correctamente y de acuerdo a las especificaciones establecidas\r\n'),
(3, 1, 17, 'Alto', 'alto'),
(4, 1, 17, 'Superior', 'superior'),
(5, 2, 17, 'Bajo', 'bajo'),
(6, 2, 17, 'Basico', 'bas'),
(7, 2, 17, 'Superior', 'sup'),
(8, 2, 17, 'Alto', 'alt'),
(9, 4, 17, 'Bajo', 'Tercero baj'),
(10, 4, 17, 'Basico', 'basuico'),
(11, 12, 17, 'Bajo', 'once baj'),
(12, 12, 17, 'Alto', 'alto onc'),
(13, 8, 17, 'Bajo', 'muy bajo rendimiento'),
(14, 8, 17, 'Basico', 'Rendimiento regular'),
(15, 8, 17, 'Alto', 'Buen rendimiento'),
(16, 8, 17, 'Superior', 'Excelente Rendimiento');

-- --------------------------------------------------------

--
-- Table structure for table `porcentajeactividades`
--

CREATE TABLE `porcentajeactividades` (
  `Id` int(11) NOT NULL,
  `IdGrado` int(11) DEFAULT NULL,
  `IdMateria` int(11) DEFAULT NULL,
  `Tareas` float DEFAULT NULL,
  `Talleres` float DEFAULT NULL,
  `Evaluaciones` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `porcentajeactividades`
--

INSERT INTO `porcentajeactividades` (`Id`, `IdGrado`, `IdMateria`, `Tareas`, `Talleres`, `Evaluaciones`) VALUES
(1, 1, 17, 10, 30, 60),
(2, 2, 17, 33.3, 33.3, 33.4),
(3, 3, 17, 60, 30, 10),
(4, 8, 19, 0, 30, 70),
(5, 8, 17, 15, 15, 70),
(6, 1, 19, 80, 10, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `acudientes`
--
ALTER TABLE `acudientes`
  ADD PRIMARY KEY (`IdAcudiente`);

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`IdAdministrador`);

--
-- Indexes for table `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `definitivas`
--
ALTER TABLE `definitivas`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`IdDocente`);

--
-- Indexes for table `docentes_grados`
--
ALTER TABLE `docentes_grados`
  ADD PRIMARY KEY (`IdDocentes_Grados`);

--
-- Indexes for table `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`IdEstudiante`);

--
-- Indexes for table `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`IdGrado`);

--
-- Indexes for table `inasistencias`
--
ALTER TABLE `inasistencias`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`IdMateria`);

--
-- Indexes for table `materias_docentes`
--
ALTER TABLE `materias_docentes`
  ADD PRIMARY KEY (`IdMaterias_Docente`);

--
-- Indexes for table `observaciones`
--
ALTER TABLE `observaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observacionesdefinitivas`
--
ALTER TABLE `observacionesdefinitivas`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `porcentajeactividades`
--
ALTER TABLE `porcentajeactividades`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividades`
--
ALTER TABLE `actividades`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `acudientes`
--
ALTER TABLE `acudientes`
  MODIFY `IdAcudiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `IdAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `definitivas`
--
ALTER TABLE `definitivas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `docentes`
--
ALTER TABLE `docentes`
  MODIFY `IdDocente` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `docentes_grados`
--
ALTER TABLE `docentes_grados`
  MODIFY `IdDocentes_Grados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `IdEstudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `grados`
--
ALTER TABLE `grados`
  MODIFY `IdGrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inasistencias`
--
ALTER TABLE `inasistencias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `IdMateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `materias_docentes`
--
ALTER TABLE `materias_docentes`
  MODIFY `IdMaterias_Docente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `observaciones`
--
ALTER TABLE `observaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `observacionesdefinitivas`
--
ALTER TABLE `observacionesdefinitivas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `porcentajeactividades`
--
ALTER TABLE `porcentajeactividades`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
