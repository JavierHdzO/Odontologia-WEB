-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-05-2022 a las 02:25:30
-- Versión del servidor: 10.5.12-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id18883365_odonto`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_deleteCita` (`pID` INTEGER)  BEGIN
    	START TRANSACTION;
        	DELETE FROM Citas
            	WHERE idHorario = pID;
                
             SELECT 'Cita_Elimida' as Resultado;
        COMMIT;
        	SELECT 'Fallo_Eliminacion';
        ROLLBACK;
	
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_deleteMedico` (`p_ID` INTEGER)  BEGIN
    	START TRANSACTION;
        	DELETE FROM Medico
            	WHERE ID = p_ID;
                
        	SELECT 'Medico_Eliminado' as Resultado;
        COMMIT;
        	SELECT 'Fallo_Eliminacion' as Resultado;
		ROLLBACK;
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_deletePaciente` (`pID` INTEGER)  BEGIN
    	START TRANSACTION;
        	DELETE FROM Paciente
            	WHERE NoAsig = pID;
                
            SELECT 'Paciente_Eliminado' as Resultado;
        COMMIT;
        	SELECT 'Acción_No_Realizada' as Resultado;
        ROLLBACK;
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_deleteUser` (`p_Clave` INTEGER)  BEGIN
	DELETE FROM usuarios
    	WHERE Clave = p_Clave;
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_Especialidades` ()  BEGIN
    SELECT IdEspecialidad, Descripcion FROM Especialidades;
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_findCita` (`pID` INTEGER)  BEGIN
    START TRANSACTION;
        SELECT Citas.idHorario, Citas.MedicoId, Citas.Fecha, Citas.Horario, Citas.IdPaciente FROM Citas
            WHERE Citas.idHorario = pID;
    COMMIT;
    	SELECT 'Fallo' as Resultado;  
     ROLLBACK;    

END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_findMedico` (`p_ID` INTEGER)  BEGIN
    	START TRANSACTION;
        	SELECT ID, Cedula, Nombres, Apellidos, Telefono, Especialidad FROM Medico
            	WHERE ID = p_ID;
        COMMIT;

END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_findPaciente` (`pID` INTEGER)  BEGIN
    	START TRANSACTION;
        	SELECT NoAsig, Nombres, Apellidos ,Calle ,Numero ,Colonia ,Ciudad ,CP,FechaNac,Sexo,Telefono,Foto FROM Paciente
            	WHERE NoAsig = pID;
        COMMIT;
        	SELECT 'Paciente_No_Encontrado' as Resultado;
        ROLLBACK;

END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_findUser` (IN `p_Usr` VARCHAR(15), IN `p_Pass` VARCHAR(15))  BEGIN
    	SELECT Usuarios.Clave, Usuarios.Login, Usuarios.Password FROM Usuarios
    	WHERE Usuarios.Login = p_Usr  and Usuarios.Password = p_Pass;
    
    	
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_getPhotoUser` (IN `pID` INT)  BEGIN
    	SELECT Usuarios.foto FROM Usuarios
        	WHERE Usuarios.Clave = pID;

END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_listUsers` ()  BEGIN
SELECT Clave, Login, Password, Nombre, foto FROM Usuarios;
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_newCita` (`pMedicoId` INTEGER, `pFecha` DATE, `pHorario` TIME, `pIdPaciente` INTEGER)  BEGIN

        INSERT INTO Citas( MedicoId, Fecha, Horario, IdPaciente) VALUES( pMedicoId, pFecha, pHorario, pIdPaciente);


END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_newMedico` (`p_Cedula` INTEGER, `p_Nombres` VARCHAR(50), `p_Apellidos` VARCHAR(50), `p_Telefono` VARCHAR(20), `p_Especialidad` INTEGER)  BEGIN
    	START TRANSACTION;
        
        	INSERT INTO Medico(Cedula, Nombres, Apellidos, Telefono, Especialidad) VALUES(p_Cedula, p_Nombres, p_Apellidos, 			p_Telefono, p_Especialidad);
            
            SELECT 'Exito' as Resultado;
    	COMMIT;
        
        	SELECT 'Fallo' as Resultado;
        ROLLBACK;
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_newPaciente` (IN `pNombres` VARCHAR(50), IN `pApellidos` VARCHAR(50), IN `pCalle` VARCHAR(50), IN `pNumero` VARCHAR(10), IN `pColonia` VARCHAR(50), IN `pCiudad` INT, IN `pCP` INT, IN `pFechaNac` DATE, IN `pSexo` CHAR(1), IN `pTelefono` VARCHAR(20), IN `pFoto` VARCHAR(200))  BEGIN
    	START TRANSACTION;
        	INSERT INTO Paciente(Nombres ,Apellidos ,Calle ,Numero ,Colonia ,Ciudad ,CP,FechaNac,Sexo,Telefono,Foto ) VALUES(pNombres, pApellidos, pCalle, pNumero, pColonia, pCiudad, pCP, pFechaNac, pSexo, pTelefono, pFoto);
            
            SELECT 'Registrado_Correctamente' as Resultado;
            
        COMMIT;
        	SELECT 'Fallo_registro' as Resultado;
        ROLLBACK;

END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_newUser` (IN `p_Login` VARCHAR(15), IN `p_Password` VARCHAR(15), IN `p_Nombre` VARCHAR(100), IN `p_foto` VARCHAR(200))  BEGIN

INSERT INTO Usuarios(Login, Password, Nombre, foto) VALUES(p_Login, p_Password,p_Nombre, p_foto);

END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_showCitas` ()  BEGIN	
		START TRANSACTION;
        	SELECT 
            	c.idHorario,
            	CONCAT(m.Nombres, ' ', m.Apellidos ) as NombreM,
                c.Fecha,
                c.Horario,
               CONCAT(p.Nombres, ' ', p.Apellidos) as NombreP
                
            FROM Citas c
            INNER JOIN Medico m ON c.MedicoId = m.ID
            INNER JOIN Paciente p ON c.IdPaciente = p.NoAsig;
        
        COMMIT;
        
        SELECT 'Fallo_Consulta' as Resultado;
        
        ROLLBACK;

END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_showCiudades` ()  BEGIN 
        SELECT  IdCiudad , Ciudad, Estado FROM Ciudades;

END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_showMedicos` ()  BEGIN 
    SELECT ID, Cedula, Nombres, Apellidos, Telefono, Especialidad FROM Medico;
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_showPaciente` ()  BEGIN
    
    START TRANSACTION;
    	SELECT NoAsig, Nombres, Apellidos, Calle, Numero, Colonia, Ciudad, CP, FechaNac, Sexo, Telefono, Foto FROM Paciente;
    COMMIT;
    
    	SELECT 'Fallo_Consulta' as Resultado;
    
    
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_updateCita` (`pidHorario` INTEGER, `pMedicoId` INTEGER, `pFecha` DATE, `pHorario` TIME, `pIdPaciente` INTEGER)  BEGIN
        	UPDATE Citas set  MedicoId =pMedicoId, Fecha =pFecha, Horario = pHorario, IdPaciente = pIdPaciente
            	WHERE idHorario = pidHorario;
	
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_updateMedico` (`p_ID` INTEGER, `p_Cedula` INTEGER, `p_Nombres` VARCHAR(50), `p_Apellidos` VARCHAR(50), `p_Telefono` VARCHAR(20), `p_Especialidad` INTEGER)  BEGIN
    	START TRANSACTION;
        	UPDATE  Medico set Cedula = p_Cedula, Nombres = p_Nombres, Apellidos=p_Apellidos , Telefono=p_Telefono, Especialidad = p_Especialidad
            	WHERE ID = p_ID;
                
                SELECT 'Usuario_Actualizado' AS Resultado;
    	COMMIT;
        
        	SELECT 'Fallo_Actualizacion' AS Resultado;
            
        ROLLBACK;
    END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_updatePaciente` (IN `pID` INT, IN `pNombres` VARCHAR(50), IN `pApellidos` VARCHAR(50), IN `pCalle` VARCHAR(50), IN `pNumero` VARCHAR(10), IN `pColonia` VARCHAR(50), IN `pCiudad` INT, IN `pCP` INT, IN `pFechaNac` DATE, IN `pSexo` CHAR(1), IN `pTelefono` VARCHAR(20), IN `pFoto` VARCHAR(200))  BEGIN
    	START TRANSACTION;
    	UPDATE Paciente set Nombres = pNombres, Apellidos = pApellidos ,Calle = pCalle, Numero = pNumero ,Colonia = pColonia ,Ciudad = pCiudad,CP = pCP,FechaNac = pFechaNac ,Sexo = pSexo ,Telefono = pTelefono ,Foto = pFoto
        WHERE NoAsig = pID;
        
        	SELECT 'Paciente_Actualizado' as Resultado;
        
        COMMIT;
        	SELECT 'Fallo_Actualizacions' as Resultado;
        ROLLBACK;
END$$

CREATE DEFINER=`id18883365_root`@`%` PROCEDURE `sp_updatePaciente2` (`pID` INTEGER, `pNombres` VARCHAR(50), `pApellidos` VARCHAR(50), `pCalle` VARCHAR(50), `pNumero` VARCHAR(10), `pColonia` VARCHAR(50), `pCiudad` INTEGER, `pCP` INTEGER, `pFechaNac` DATE, `pSexo` CHAR(1), `pTelefono` VARCHAR(20))  BEGIN
    	UPDATE Paciente set Nombres = pNombres, Apellidos = pApellidos ,Calle = pCalle, Numero = pNumero ,Colonia = pColonia ,Ciudad = pCiudad,CP = pCP,FechaNac = pFechaNac ,Sexo = pSexo ,Telefono = pTelefono 
        WHERE NoAsig = pID;
        
        	SELECT 'Paciente_Actualizado' as Resultado;
        
        
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Citas`
--

CREATE TABLE `Citas` (
  `idHorario` int(11) NOT NULL,
  `MedicoId` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Horario` time DEFAULT NULL,
  `IdPaciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Citas`
--

INSERT INTO `Citas` (`idHorario`, `MedicoId`, `Fecha`, `Horario`, `IdPaciente`) VALUES
(1, 3, '2022-05-13', '04:31:00', 5),
(3, 15, '2022-05-21', '17:55:00', 6),
(4, 15, '2022-05-20', '18:50:00', 6),
(5, 15, '2022-05-13', '15:53:00', 6),
(6, 16, '2022-05-18', '09:40:00', 3),
(8, 17, '2022-05-28', '18:02:00', 3),
(9, 19, '2022-05-12', '23:04:00', 7),
(10, 21, '2022-06-04', '22:59:00', 6),
(14, 23, '2022-05-11', '10:00:00', 11),
(15, 24, '2022-06-23', '10:25:00', 4),
(16, 25, '2022-05-11', '22:19:00', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudades`
--

CREATE TABLE `Ciudades` (
  `IdCiudad` int(11) NOT NULL,
  `Ciudad` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Estado` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Ciudades`
--

INSERT INTO `Ciudades` (`IdCiudad`, `Ciudad`, `Estado`) VALUES
(1, 'Altamira', 'Tamaulipas'),
(2, 'CD Madero', 'Tamaulipas'),
(3, 'Tampico', 'Tamaulipas'),
(4, 'Aldama', 'Tamaulipas'),
(5, 'Mante', 'Tamaulipas'),
(6, 'Victoria', 'Tamaulipas'),
(7, 'Gonzalez', 'Tamaulipas'),
(8, 'Pueblo Viejo', 'Veracruz'),
(9, 'Panuco', 'Veracruz'),
(10, 'Ebano', 'San Luis Potosi'),
(11, 'CD Valles', 'San Luis Potosi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Consulta`
--

CREATE TABLE `Consulta` (
  `IdConsulta` int(11) DEFAULT NULL,
  `idHorario` int(11) DEFAULT NULL,
  `Diagnostico` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Costo` float DEFAULT NULL,
  `Observaciones` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetConsulta`
--

CREATE TABLE `DetConsulta` (
  `IdConsulta` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `IdTratamiento` int(11) DEFAULT NULL,
  `Costo` float DEFAULT NULL,
  `Observaciones` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Disponibilidad`
--

CREATE TABLE `Disponibilidad` (
  `MedicoID` int(11) DEFAULT NULL,
  `Dia` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Horario1` int(11) DEFAULT NULL,
  `Horario2` int(11) DEFAULT NULL,
  `Horario3` int(11) DEFAULT NULL,
  `Horario4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Especialidades`
--

CREATE TABLE `Especialidades` (
  `IdEspecialidad` int(11) NOT NULL,
  `Descripcion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Especialidades`
--

INSERT INTO `Especialidades` (`IdEspecialidad`, `Descripcion`) VALUES
(1, 'Cirujano Dentista'),
(2, 'Ortodoncista'),
(3, 'OrtoPediatra'),
(4, 'Dentista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FECHAS`
--

CREATE TABLE `FECHAS` (
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `FECHAS`
--

INSERT INTO `FECHAS` (`fecha`) VALUES
('2022-05-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Medico`
--

CREATE TABLE `Medico` (
  `ID` int(11) NOT NULL,
  `Cedula` int(11) DEFAULT NULL,
  `Nombres` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Apellidos` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefono` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Especialidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Medico`
--

INSERT INTO `Medico` (`ID`, `Cedula`, `Nombres`, `Apellidos`, `Telefono`, `Especialidad`) VALUES
(15, 1234, 'Francisco Javier', 'Ortiz', '+527681081659', 3),
(16, 230622, 'Sebastian', 'Roman', '8334625537', 1),
(17, 234512, 'Juan', 'Arellano', '8333002058', 4),
(19, 778894, 'mario alberto', 'rodriguez bautista', '8335395978', 3),
(21, 889785, 'Chisco', 'Ortiz hernandez', '86194161651', 2),
(23, 2412, 'Jesus', 'Sainz Torres', '8336441374', 1),
(24, 234511, 'Ginger', 'Muro', '8333002057', 3),
(25, 1234, 'Luz', 'Hernandez Ortiz', '+527681081659', 1),
(26, 9852, 'Fernanda', 'Vega', '3234234', 2),
(28, 223334412, 'rubisel', 'reyes', '8461158769', 2),
(29, 877487344, 'andrea', 'vazquez dominguez', '8772912230', 3),
(30, 877729100, 'Mario Alberto', 'Guzman Anastasio', '9882012221', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Paciente`
--

CREATE TABLE `Paciente` (
  `NoAsig` int(11) NOT NULL,
  `Nombres` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Apellidos` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Calle` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Numero` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Colonia` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Ciudad` int(11) DEFAULT NULL,
  `CP` int(11) DEFAULT NULL,
  `FechaNac` date DEFAULT NULL,
  `Sexo` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefono` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Foto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Paciente`
--

INSERT INTO `Paciente` (`NoAsig`, `Nombres`, `Apellidos`, `Calle`, `Numero`, `Colonia`, `Ciudad`, `CP`, `FechaNac`, `Sexo`, `Telefono`, `Foto`) VALUES
(3, 'Francisco Javier', 'Ortiz', 'San Pedro', '123', 'Croc', 1, 89433, '2022-05-18', 'M', '+527681081659', '/img/background.jpeg'),
(4, 'Sebastian', 'Muro', 'Av. las torres', '519', 'Insurgentes', 3, 89349, '2000-06-23', 'M', '8333108911', '/img/Captura de pantalla 2022-05-08 184424.png'),
(6, 'Dudley ', 'Dursley', 'Private drive ', '4', 'lomas', 7, 89358, '2022-05-20', 'F', '833554841', '/img/download.jpg'),
(7, 'Barry ', 'Allen', 'Central city', '5', 'ee.uu', 9, 89655, '2022-05-13', 'M', '83356971', '/img/theFlashTarget.jpg'),
(11, 'Walter', 'White', 'Augusto Fornue', '312', 'Pedrera', 1, 83645, '1988-05-03', 'M', '8337153042', '/img/Walter_White_S5B.png'),
(12, 'Wanda', 'Maximoff', 'Sokovia ', '303', 'Oleg', 8, 89349, '1990-08-21', 'M', '8332098283', '/img/wanda.png'),
(13, 'Tony', 'Stark', 'Manhattan', '101', 'Las Americas', 5, 89349, '1968-01-11', 'M', '8331923948', '/img/tony.png'),
(14, 'Edith', 'Ortiz Morales', 'San Pedro', '12', 'Villas', 7, 24124, '2022-05-17', 'M', '527681081659', '/img/notfound.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tratamientos`
--

CREATE TABLE `Tratamientos` (
  `IdTratamiento` int(11) NOT NULL,
  `Tratamiento` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Costo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `Clave` int(11) NOT NULL,
  `Login` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`Clave`, `Login`, `Password`, `Nombre`, `foto`) VALUES
(1, 'Francisco17', '123', 'Francisco Javier', '/img/profile.jpeg'),
(2, 'sebas23', 'chisco123', 'Sebastian', '/img/Captura de pantalla 2022-05-08 184424.png'),
(3, 'mariorodzba', 'contraseña', 'Mario', '/img/Logo completo.jpg'),
(4, 'Chucho24', 'Chucho123', 'Jesus Alberto', '/img/095e47617144172606d5cd004ab2a752.jpg'),
(5, '', '', '', 'NULL'),
(6, 'Yo123', '123', 'Francisco Javier', 'NULL'),
(7, 'andres1', 'poiu', 'Andres', '/img/avatar-4e3cba453543989837c55ccd4336cf46.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Citas`
--
ALTER TABLE `Citas`
  ADD PRIMARY KEY (`idHorario`);

--
-- Indices de la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  ADD PRIMARY KEY (`IdCiudad`);

--
-- Indices de la tabla `Especialidades`
--
ALTER TABLE `Especialidades`
  ADD PRIMARY KEY (`IdEspecialidad`);

--
-- Indices de la tabla `Medico`
--
ALTER TABLE `Medico`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Paciente`
--
ALTER TABLE `Paciente`
  ADD PRIMARY KEY (`NoAsig`);

--
-- Indices de la tabla `Tratamientos`
--
ALTER TABLE `Tratamientos`
  ADD PRIMARY KEY (`IdTratamiento`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`Clave`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Citas`
--
ALTER TABLE `Citas`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  MODIFY `IdCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `Especialidades`
--
ALTER TABLE `Especialidades`
  MODIFY `IdEspecialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Medico`
--
ALTER TABLE `Medico`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `Paciente`
--
ALTER TABLE `Paciente`
  MODIFY `NoAsig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `Tratamientos`
--
ALTER TABLE `Tratamientos`
  MODIFY `IdTratamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `Clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
