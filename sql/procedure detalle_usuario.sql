DELIMITER $$

CREATE PROCEDURE detalle_usuario(IN p_id_tipo_doc VARCHAR(10), IN p_nro_doc VARCHAR(20))
BEGIN
    SELECT 
        us.id_usuario,
        us.id_tipo_doc,
        us.nro_doc,
        us.nombres,
        us.apellidos,
        us.correo,
        us.celular,
        us.direccion,
        us.referencia,
        us.id_dep,
        tde.nombre  AS departamento,
        us.id_prov,
        tp.nombre   AS provincia,
        us.id_dist,
        tdi.nombre  AS distrito,
        us.id_estado,
        te.nombre   AS estado
    FROM tb_usuarios us
    INNER JOIN tb_tipo_documento td  ON us.id_tipo_doc = td.id_tipo_doc
    INNER JOIN tb_departamento tde   ON us.id_dep      = tde.id_dep
    INNER JOIN tb_provincia tp       ON us.id_dep      = tp.id_dep
                                    AND us.id_prov     = tp.id_prov
    INNER JOIN tb_distrito tdi       ON us.id_dep      = tdi.id_dep
                                    AND us.id_prov     = tdi.id_prov
                                    AND us.id_dist     = tdi.id_dist
    INNER JOIN tb_estados te         ON us.id_estado   = te.id_estado
    WHERE us.id_tipo_doc = p_id_tipo_doc
      AND us.nro_doc     = p_nro_doc;
END$$

DELIMITER ;