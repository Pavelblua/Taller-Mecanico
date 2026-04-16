DELIMITER $$

DROP PROCEDURE IF EXISTS search_login$$

CREATE PROCEDURE search_login(
    IN p_login VARCHAR(255),
    OUT p_id_usuario INT,
    OUT p_password_hash VARCHAR(255),
    OUT p_error_code INT,
    OUT p_error_message TEXT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
            p_error_code = MYSQL_ERRNO,
            p_error_message = MESSAGE_TEXT;
    END;

    DECLARE CONTINUE HANDLER FOR NOT FOUND
    BEGIN
        SET p_id_usuario = NULL;
        SET p_password_hash = NULL;
        SET p_error_code = 404;
        SET p_error_message = 'Usuario no encontrado';
    END;

    SET p_id_usuario = NULL;
    SET p_password_hash = NULL;
    SET p_error_code = 0;
    SET p_error_message = 'OK';

    SELECT id_usuario, password_hash
    INTO p_id_usuario, p_password_hash
    FROM tb_accesos_sistema
    WHERE usuario_login = p_login
    LIMIT 1;

    IF p_error_code = 0 AND p_password_hash IS NULL THEN
        SET p_error_code = 404;
        SET p_error_message = 'Usuario no encontrado';
    END IF;

    SELECT p_id_usuario AS id_usuario,
           p_password_hash AS password_hash,
           p_error_code AS error_code,
           p_error_message AS error_message;
END$$

DELIMITER ;
