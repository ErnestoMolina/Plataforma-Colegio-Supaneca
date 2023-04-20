-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 16, 2023 at 11:32 AM
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
(7, 'Pedro', 'Aranda López', 'Tarjeta de identidad', '1234567890', '2022-12-08', '322596708', 'helverzon@gmail.com', 'Gw/cs6c='),
(8, 'Ernesto', 'Galindo', 'Tarjeta de identidad', '1002456321', '2022-12-31', '312589476', 'helverzon@gmail.com', 'XV2c5w==');

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
  `TelefonoDocente` varchar(10) DEFAULT NULL,
  `ContraseñaDocente` varchar(50) DEFAULT NULL,
  `idMateria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `docentes`
--

INSERT INTO `docentes` (`IdDocente`, `NombresDocente`, `ApellidosDocente`, `TipoDocumentoDocente`, `NDocumentoDocente`, `FechaNacimientoDocente`, `CorreoElectronicoDocente`, `TelefonoDocente`, `ContraseñaDocente`, `idMateria`) VALUES
(5, 'Diego Alejandro', 'Castro Parra', 'Tarjeta de identidad', 1023587934, '2000-04-11', 'Diegoparra@gmail.com', '3125489647', '123', '1'),
(6, 'Helverzon', 'Galindo Molina', 'Cedula de ciudadania', 1002565211, '2002-07-06', 'Helverzon@gmail.com', '3225967088', 'HwnctaPl', '4'),
(8, 'Juan', 'Bautista', 'Cedula de ciudadania', 1002565211, '2022-11-05', 'Juanitha@gmail.com', '3125896412', 'Ciencia', '13'),
(9, 'Ernesto', 'Galindo', 'Cedula de ciudadania', 1002321589, '2022-11-03', 'helverzon@gmail.com', '3165897456', 'Hola', '6'),
(10, 'José Sneyder', 'Galindo', 'Cedula de ciudadania', 852, '2022-11-11', 'helverzon@gmail.com', '348632145', 'Ney', '4'),
(11, 'Ernesto', 'Galindo', 'Cedula de ciudadania', 1002587902, '2022-11-18', 'helverzon@gmail.com', '3158963369', 'Polo', '9'),
(12, 'Ernesto', 'Galindo', 'Cedula de ciudadania', 1003654789, '2022-12-03', 'helverzon@gmail.com', '3008963214', 'Gw/cs6c=', '5'),
(13, 'Ernesto', 'Galindo', 'Tarjeta de identidad', 4563258, '2022-12-31', 'helverzon@gmail.com', '312589476', 'T12O5/A=', '2');

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
  `GradoEstudiante` varchar(50) NOT NULL,
  `idAcudiente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estudiantes`
--

INSERT INTO `estudiantes` (`IdEstudiante`, `NombresEstudiante`, `ApellidosEstudiante`, `TipoDocumentoEstudiante`, `NDocumentoEstudiante`, `FechaNacimientoEstudiante`, `GradoEstudiante`, `idAcudiente`) VALUES
(2, 'Diego Alejandro', 'Parra Leon', 'Cedula de ciudadania', 1002658974, '2022-11-04', 'Peescolar', 1),
(3, 'Ernesto', 'Galindo', 'Tarjeta de identidad', 1002365984, '2022-11-03', 'Peescolar', 4),
(4, 'Julian Esteban', 'Lopez', 'Pasaporte', 1003256987, '2022-11-04', 'Primero', 4),
(5, 'Paola', 'Moreno', 'Cedula Extranjera', 1002565233, '2022-10-30', 'Peescolar', 5),
(7, 'Armando', 'Paredes', 'Tarjeta de identidad', 1002369741, '2022-11-02', 'Octavo', 4),
(8, 'José Sneyder', 'Galindo Salamanca', 'Tarjeta de identidad', 1002369456, '2001-11-24', 'Once', 5),
(9, 'Pedro', 'Aranda López', 'Tarjeta de identidad', 123456789, '2022-11-11', 'Quinto', 5),
(10, 'pablo', 'Galindo', 'Tarjeta de identidad', 1002569321, '2004-07-15', 'Decimo', 4);

-- --------------------------------------------------------

--
-- Table structure for table `grados`
--

CREATE TABLE `grados` (
  `IdGrado` int(11) NOT NULL,
  `NombreGrado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grados`
--

INSERT INTO `grados` (`IdGrado`, `NombreGrado`) VALUES
(1, 'Preescolar'),
(2, 'Primero'),
(3, 'Segundo'),
(4, 'Tercero'),
(5, 'Cuarto'),
(6, 'Quinto'),
(7, 'Sexto'),
(8, 'Septimo'),
(9, 'Octavo'),
(10, 'Noveno'),
(11, 'Decimo'),
(12, 'once');

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
(2, 'Ciencias Naturale'),
(3, 'Lengua Castellana'),
(4, 'Ciencias Sociales'),
(5, 'Inglés'),
(6, 'Etica'),
(7, 'Religion'),
(8, 'Tecnología e Informática'),
(9, 'Artística'),
(10, 'Educación Física'),
(13, 'Química');

-- --------------------------------------------------------

--
-- Table structure for table `materias_docentes`
--

CREATE TABLE `materias_docentes` (
  `IdMaterias_Docente` int(11) NOT NULL,
  `IdDocente` int(11) DEFAULT NULL,
  `IdMateria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acudientes`
--
ALTER TABLE `acudientes`
  MODIFY `IdAcudiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `IdAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `docentes`
--
ALTER TABLE `docentes`
  MODIFY `IdDocente` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `docentes_grados`
--
ALTER TABLE `docentes_grados`
  MODIFY `IdDocentes_Grados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `IdEstudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `grados`
--
ALTER TABLE `grados`
  MODIFY `IdGrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `IdMateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `materias_docentes`
--
ALTER TABLE `materias_docentes`
  MODIFY `IdMaterias_Docente` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
