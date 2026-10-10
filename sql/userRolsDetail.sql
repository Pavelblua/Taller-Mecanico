DELIMITER $$

CREATE PROCEDURE userRolsDetail(
    IN tipo_doc_in INT,
    IN nro_in VARCHAR(20)
)
BEGIN
    SELECT
        tu.id_tipo_doc,
        tu.nro_doc,
        tu.id_usuario,
        tu.usuario_login,
        tu.nombres,
        tu.apellidos,
        tu.celular,
        tu.correo,
        tas.id_rol
    FROM tb_usuarios tu
    LEFT JOIN tb_accesos_sistema tas
           ON tu.id_usuario = tas.id_usuario
    WHERE tu.id_tipo_doc = tipo_doc_in
      AND tu.nro_doc = nro_in;
END$$

DELIMITER ;