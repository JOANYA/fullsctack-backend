-- =====================================================
-- SCRIPT SQL: GESTIÓN DE PRODUCTOS Y CATEGORÍAS (API REST)
-- =====================================================

-- 1. Crear y seleccionar la base de datos
DROP DATABASE IF EXISTS db_gestion_productos;
CREATE DATABASE db_gestion_productos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_gestion_productos;

-- 2. Tabla de Categorías
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Tabla de Productos (con relación a Categorías)
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_product_category 
    FOREIGN KEY (category_id) 
    REFERENCES categories(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- 4. DATOS DE PRUEBA (SEEDERS INICIALES)
-- =====================================================

-- Insertar categorías de ejemplo
INSERT INTO categories (name, description) VALUES 
('Tecnología', 'Dispositivos, componentes y accesorios electrónicos'),
('Ropa y Moda', 'Prendas de vestir y accesorios de temporada');

-- Insertar productos de ejemplo
INSERT INTO products (category_id, name, description, price, stock) VALUES 
(1, 'Laptop HP Pavilion', 'Laptop de 15.6 pulgadas con 8GB RAM y SSD de 512GB', 2500.00, 4),
(1, 'Mouse Inalámbrico Logitech', 'Mouse óptico ergonómico con receptor USB', 45.50, 25),
(2, 'Camiseta Overskull', 'Camiseta negra edición limitada de algodón', 89.90, 50);