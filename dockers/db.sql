CREATE DATABASE IF NOT EXISTS mrancel_escrito2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE mrancel_escrito2;

-- Tabla personas
CREATE TABLE personas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    telefono VARCHAR(100) NOT NULL
);
