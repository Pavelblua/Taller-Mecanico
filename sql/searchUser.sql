DELIMITER //

CREATE PROCEDURE searchUser(IN usuario_login_in VARCHAR(255))
BEGIN
    SELECT id_usuario, usuario_login
    FROM tb_accesos_sistema
    WHERE tb_accesos_sistema.usuario_login = usuario_login_in;
END //

DELIMITER ;