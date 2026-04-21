DELIMITER $$

CREATE PROCEDURE crea_usuario(
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
    INSERT INTO tb_usuarios (
        id_tipo_doc,
        nro_doc,
        nombres,
        apellidos,
        correo,
        celular,
        direccion,
        referencia,
        id_dep,
        id_prov,
        id_dist,
        id_estado
    ) VALUES (
        p_id_tipo_doc,
        p_nro_doc,
        p_nombres,
        p_apellidos,
        p_correo,
        p_celular,
        p_direccion,
        p_referencia,
        p_id_dep,
        p_id_prov,
        p_id_dist,
        p_id_estado
    );
    
    SELECT LAST_INSERT_ID() as id_usuario;
END$$

DELIMITER ;
