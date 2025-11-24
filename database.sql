CREATE DATABASE IF NOT EXISTS reciclaje_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE reciclaje_db;

CREATE TABLE IF NOT EXISTS roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(20) NOT NULL
);

INSERT INTO roles (nombre) VALUES ('Administrador'), ('Operador') 
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  correo VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role_id INT,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

INSERT INTO usuarios (nombre, correo, password, role_id) VALUES
('Administrador', 'marco@ube.com', 'admin1234', 1),
('Operador', 'marco@gmail.com', 'oper1234', 2)
ON DUPLICATE KEY UPDATE correo = correo;

CREATE TABLE IF NOT EXISTS clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  correo VARCHAR(100) UNIQUE NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  direccion VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS materiales (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS rutas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  origen VARCHAR(255) NOT NULL,
  destino VARCHAR(255) NOT NULL,
  distancia INT NOT NULL
);

CREATE TABLE IF NOT EXISTS residuos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente_id INT NOT NULL,
  material_id INT NOT NULL,
  cantidad INT NOT NULL,
  fecha DATE NOT NULL,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id),
  FOREIGN KEY (material_id) REFERENCES materiales(id)
);

INSERT INTO clientes (nombre, correo, telefono, direccion) VALUES
('Marco','mark666dark@gmail.com','0961997444','Quito'),
('Sylvia','tatianaallauca25@gmail.com','0996212230','Quito');
('Angie','angie10@gmail.com','0962344351','Salcedo');

INSERT INTO materiales (nombre, descripcion) VALUES
('Plástico', 'Botellas y envases plásticos'),
('Cartón', 'Cajas y empaques');
('Cobre', 'Cables y tuberías de cobre');

INSERT INTO rutas (origen, destino, distancia) VALUES
('Quito','Ambato','217'),
('Quito','Guayaquil','498');

INSERT INTO residuos (cliente_id, material_id, cantidad, fecha) VALUES
(1,1,50,'2025-11-01'),
(2,2,30,'2025-11-05');
(3,3,20,'	2025-11-22');