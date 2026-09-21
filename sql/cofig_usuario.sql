-- ==========================================================
-- SCRIPT DE CONFIGURACIÓN Y CREACIÓN DE TABLAS
-- Módulo: tb_usuarios y Tablas con Dependencia Relacional
-- Base de Datos: taller_pro
-- ==========================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ==========================================================
-- SECCIÓN 1: TABLAS MAESTRAS (Requeridas por tb_usuarios)
-- Deben crearse antes de tb_usuarios para satisfacer las FKs
-- ==========================================================

-- 1.1. Tabla de Estados (Estado del usuario, documentos, roles)
DROP TABLE IF EXISTS `tb_estados`;
CREATE TABLE `tb_estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 1.2. Tabla de Departamentos (Ubigeo)
DROP TABLE IF EXISTS `tb_departamento`;
CREATE TABLE `tb_departamento` (
  `id_dep` char(2) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_dep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 1.3. Tabla de Provincias (Ubigeo - depende de tb_departamento)
DROP TABLE IF EXISTS `tb_provincia`;
CREATE TABLE `tb_provincia` (
  `id_prov` char(4) NOT NULL,
  `id_dep` char(2) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_prov`,`id_dep`),
  KEY `idx_prov_dep` (`id_dep`),
  CONSTRAINT `fk_provincia_departamento` FOREIGN KEY (`id_dep`) REFERENCES `tb_departamento` (`id_dep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 1.4. Tabla de Distritos (Ubigeo - depende de tb_provincia)
DROP TABLE IF EXISTS `tb_distrito`;
CREATE TABLE `tb_distrito` (
  `id_dist` char(6) NOT NULL,
  `id_prov` char(4) NOT NULL,
  `id_dep` char(2) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_dist`,`id_prov`,`id_dep`),
  KEY `idx_dist_prov` (`id_prov`),
  KEY `fk_distrito_provincia` (`id_prov`,`id_dep`),
  CONSTRAINT `fk_distrito_provincia` FOREIGN KEY (`id_prov`, `id_dep`) REFERENCES `tb_provincia` (`id_prov`, `id_dep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 1.5. Tabla de Tipos de Documento (DNI, RUC, CE, etc. - depende de tb_estados)
DROP TABLE IF EXISTS `tb_tipo_documento`;
CREATE TABLE `tb_tipo_documento` (
  `id_tipo_doc` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `abreviatura` varchar(10) NOT NULL,
  `id_estado` int(11) DEFAULT 1,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_tipo_doc`),
  KEY `idx_tipodoc_estado` (`id_estado`),
  CONSTRAINT `fk_tipodoc_estado` FOREIGN KEY (`id_estado`) REFERENCES `tb_estados` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ==========================================================
-- SECCIÓN 2: TABLA PRINCIPAL (tb_usuarios)
-- Depende de: tb_tipo_documento, tb_distrito y tb_estados
-- ==========================================================

DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_doc` int(11) DEFAULT NULL,
  `nro_doc` varchar(20) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  `id_dist` char(6) DEFAULT NULL,
  `id_prov` char(4) DEFAULT NULL,
  `id_dep` char(2) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `idx_user_dist` (`id_dist`),
  KEY `idx_user_estado` (`id_estado`),
  KEY `fk_usuario_tipo_doc` (`id_tipo_doc`),
  KEY `fk_usuario_distrito` (`id_dist`,`id_prov`,`id_dep`),
  CONSTRAINT `fk_user_estado` FOREIGN KEY (`id_estado`) REFERENCES `tb_estados` (`id_estado`),
  CONSTRAINT `fk_usuario_distrito` FOREIGN KEY (`id_dist`, `id_prov`, `id_dep`) REFERENCES `tb_distrito` (`id_dist`, `id_prov`, `id_dep`),
  CONSTRAINT `fk_usuario_tipo_doc` FOREIGN KEY (`id_tipo_doc`) REFERENCES `tb_tipo_documento` (`id_tipo_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ==========================================================
-- SECCIÓN 3: TABLAS DEPENDIENTES DIRECTAS DE tb_usuarios
-- (Tablas que requieren que tb_usuarios exista para su FK)
-- ==========================================================

-- 3.1. Tabla de Roles del Sistema
DROP TABLE IF EXISTS `tb_roles`;
CREATE TABLE `tb_roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rol`),
  KEY `idx_rol_estado` (`id_estado`),
  CONSTRAINT `fk_rol_estado` FOREIGN KEY (`id_estado`) REFERENCES `tb_estados` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3.2. Tabla de Accesos / Credenciales (Login, contraseña, rol del usuario)
DROP TABLE IF EXISTS `tb_accesos_sistema`;
CREATE TABLE `tb_accesos_sistema` (
  `id_acceso` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `usuario_login` varchar(80) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_acceso`),
  UNIQUE KEY `uidx_acc_login` (`usuario_login`),
  KEY `idx_acc_user` (`id_usuario`),
  KEY `idx_acc_rol` (`id_rol`),
  CONSTRAINT `fk_acc_rol` FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`),
  CONSTRAINT `fk_acc_user` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3.3. Tabla de Empleados vinculados a Usuarios
DROP TABLE IF EXISTS `tb_empleados`;
CREATE TABLE `tb_empleados` (
  `id_empleado` char(38) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`),
  KEY `idx_emp_user` (`id_usuario`),
  CONSTRAINT `fk_emp_user` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3.4. Tabla de Puestos Laborales
DROP TABLE IF EXISTS `tb_puestos`;
CREATE TABLE `tb_puestos` (
  `id_puesto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `id_estado` int(11) DEFAULT 1,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_puesto`),
  KEY `idx_puesto_estado` (`id_estado`),
  CONSTRAINT `fk_puesto_estado` FOREIGN KEY (`id_estado`) REFERENCES `tb_estados` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3.5. Tabla de Historial de Puestos de Usuarios
DROP TABLE IF EXISTS `tb_historial_puestos`;
CREATE TABLE `tb_historial_puestos` (
  `id_hist` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_puesto` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `id_estado` int(11) DEFAULT 1,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_hist`),
  KEY `idx_hist_usuario` (`id_usuario`),
  KEY `idx_hist_puesto` (`id_puesto`),
  KEY `idx_hist_estado` (`id_estado`),
  CONSTRAINT `fk_hist_estado` FOREIGN KEY (`id_estado`) REFERENCES `tb_estados` (`id_estado`),
  CONSTRAINT `fk_hist_puesto` FOREIGN KEY (`id_puesto`) REFERENCES `tb_puestos` (`id_puesto`),
  CONSTRAINT `fk_hist_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ==========================================================
-- SECCIÓN 4: DATOS INICIALES RECOMENDADOS (SEMILLA)
-- Permite insertar usuarios sin violar restricciones de FK
-- ==========================================================

INSERT INTO `tb_estados` (`id_estado`, `nombre`, `descripcion`, `color`) VALUES
(1, 'ACTIVO', 'Registro activo', 'success'),
(2, 'INACTIVO', 'Registro inactivo', 'secondary'),
(3, 'ELIMINADO', 'Registro eliminado lógico', 'danger'),
(4, 'PENDIENTE', 'Pendiente de aprobación', 'warning'),
(5, 'ANULADO', 'Proceso anulado', 'dark')
ON DUPLICATE KEY UPDATE `nombre` = VALUES(`nombre`);

INSERT INTO `tb_tipo_documento` (`id_tipo_doc`, `descripcion`, `abreviatura`, `id_estado`) VALUES
(1, 'DOCUMENTO NACIONAL DE IDENTIDAD', 'DNI', 1),
(2, 'REGISTRO UNICO DE CONTRIBUYENTES', 'RUC', 1),
(3, 'CARNET DE EXTRANJERIA', 'CE', 1),
(4, 'PASAPORTE', 'PASS', 1)
ON DUPLICATE KEY UPDATE `descripcion` = VALUES(`descripcion`);

SET FOREIGN_KEY_CHECKS = 1;
