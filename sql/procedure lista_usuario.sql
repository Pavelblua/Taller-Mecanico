DELIMITER $$

CREATE PROCEDURE lista_usuario(IN p_busqueda VARCHAR(100))
BEGIN
    SELECT 
        ttd.abreviatura AS tipo_doc,
        us.nro_doc,
        us.nombres,
        us.apellidos,
        us.celular,
        us.direccion,
        es.descripcion AS estado
    FROM tb_usuarios us
    INNER JOIN tb_tipo_documento ttd ON us.id_tipo_doc = ttd.id_tipo_doc
    INNER JOIN tb_estados es ON us.id_estado = es.id_estado
    WHERE us.apellidos LIKE CONCAT('%', p_busqueda, '%')
       OR us.nombres LIKE CONCAT('%', p_busqueda, '%');
END $$

DELIMITER ;