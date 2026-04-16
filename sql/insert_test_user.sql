-- Insertar usuario de prueba con password 'admin123'
INSERT INTO tb_accesos_sistema (id_usuario, usuario_login, password_hash) 
VALUES (1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi') 
ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash);