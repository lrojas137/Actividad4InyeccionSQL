USE lab_sqli;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL,
  nombre VARCHAR(100) NOT NULL
);

INSERT INTO usuarios (usuario, password, nombre) VALUES
('lcrojas', '1234', 'Luis Carlos Rojas'),
('ana', 'abcd', 'Ana Gómez'),
('admin', 'admin', 'Administrador');