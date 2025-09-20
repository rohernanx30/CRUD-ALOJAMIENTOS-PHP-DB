-- Crear base de datos
CREATE DATABASE alojamientos_db;
USE alojamientos_db;

-- Tabla usuarios
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla alojamientos
CREATE TABLE accommodations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) DEFAULT 0.00,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla relación usuario - alojamientos (favoritos)
CREATE TABLE user_accommodations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    accommodation_id INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_user_accom (user_id, accommodation_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (accommodation_id) REFERENCES accommodations(id) ON DELETE CASCADE
);

-- Agregar alojamientos 
INSERT INTO accommodations (title, description, price, image_url) VALUES
('Apartamento en el centro', 'Cómodo apartamento de 2 habitaciones en el centro de la ciudad.', 75.00, 'assets/images/apartamento1.jpg'),
('Casa de playa', 'Hermosa casa frente al mar con vistas impresionantes.', 150.00, 'assets/images/casa_playa.jpg'),
('Cabaña en la montaña', 'Acogedora cabaña rodeada de naturaleza y tranquilidad.', 90.00, 'assets/images/cabana_montana.jpg'),
('Loft moderno', 'Loft con diseño contemporáneo y todas las comodidades.', 120.00, 'assets/images/loft_moderno.jpg'),
('Habitación privada', 'Habitación privada en un apartamento compartido.', 40.00, 'assets/images/habitacion_privada.jpg');
-- Las imagenes se agregaron desde la base de datos por eso tienen ruta pero al verificar las ultimas 4
-- en la base de datos tienen url porque se ingresaron desde el sitio web