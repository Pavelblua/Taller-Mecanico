DELIMITER $$

CREATE PROCEDURE actualiza_usuario(
    IN p_id_tipo_doc INT,
    IN p_nro_doc VARCHAR(20),
    IN p_nombres VARCHAR(100),
    IN p_apellidos VARCHAR(100),
    IN p_correo VARCHAR(100),
    IN p_celular VARCHAR(20),
    IN p_direccion VARCHAR(200),
    IN p_referencia VARCHAR(200),
    IN p_id_dep VARCHAR(10),
    IN p_id_prov VARCHAR(10),
    IN p_id_dist VARCHAR(10),
    IN p_id_estado INT
)
BEGIN

    DECLARE v_rows INT DEFAULT 0;

    UPDATE tb_usuarios
    SET
        nombres = IF(p_nombres IS NOT NULL, p_nombres, nombres),
        apellidos = IF(p_apellidos IS NOT NULL, p_apellidos, apellidos),
        correo = IF(p_correo IS NOT NULL, p_correo, correo),
        celular = IF(p_celular IS NOT NULL, p_celular, celular),
        direccion = IF(p_direccion IS NOT NULL, p_direccion, direccion),
        referencia = IF(p_referencia IS NOT NULL, p_referencia, referencia),
        id_dep = IF(p_id_dep IS NOT NULL, p_id_dep, id_dep),
        id_prov = IF(p_id_prov IS NOT NULL, p_id_prov, id_prov),
        id_dist = IF(p_id_dist IS NOT NULL, p_id_dist, id_dist),
        id_estado = IF(p_id_estado IS NOT NULL, p_id_estado, id_estado)
    WHERE id_tipo_doc = p_id_tipo_doc
      AND nro_doc = p_nro_doc;

    SET v_rows = ROW_COUNT();

    IF v_rows = 0 THEN

        IF EXISTS (
            SELECT 1
            FROM tb_usuarios
            WHERE id_tipo_doc = p_id_tipo_doc
              AND nro_doc = p_nro_doc
        ) THEN

            SELECT 1 exito,
                   'Usuario encontrado, pero no hubo cambios' mensaje;

        ELSE

            SELECT 0 exito,
                   'Usuario no encontrado' mensaje;

        END IF;

    ELSE

        SELECT 1 exito,
               CONCAT('Usuario actualizado. Registros modificados: ', v_rows) mensaje;

    END IF;

END$$

DELIMITER ;
