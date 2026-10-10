
DELIMITER //

CREATE PROCEDURE InsertUpdateUserRol(
    IN id_usuario_in INT,
    IN usuario_login_in VARCHAR(255),
    IN password_hash_in VARCHAR(255),
    IN id_rol_in INT
)
BEGIN
    IF EXISTS (
        SELECT 1
        FROM tb_accesos_sistema
        WHERE id_usuario = id_usuario_in
    ) THEN
        IF password_hash_in IS NULL OR password_hash_in = '' THEN
            UPDATE tb_accesos_sistema
            SET id_rol = id_rol_in
            WHERE id_usuario = id_usuario_in;
        ELSE
            UPDATE tb_accesos_sistema
            SET password_hash = password_hash_in,
                id_rol = id_rol_in
            WHERE id_usuario = id_usuario_in;
        END IF;
    ELSE
        INSERT INTO tb_accesos_sistema (
            id_usuario,
            usuario_login,
            password_hash,
            id_rol
        )
        VALUES (
            id_usuario_in,
            usuario_login_in,
            password_hash_in,
            id_rol_in
        );
    END IF;
END //

DELIMITER ;