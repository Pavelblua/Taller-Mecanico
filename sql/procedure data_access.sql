_DELIMITER $$

CREATE PROCEDURE data_acces(
    IN p_id_usuario INT
)
BEGIN

    SELECT
        usu.nombres,
        usu.correo,
        usu.celular,
        tr.nombre AS rol
    FROM tb_usuarios usu
    INNER JOIN tb_accesos_sistema acc
        ON usu.id_usuario = acc.id_usuario
    INNER JOIN tb_roles tr
        ON acc.id_rol = tr.id_rol
    WHERE acc.id_usuario = p_id_usuario;

END $$

DELIMITER ;