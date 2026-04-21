DELIMITER $$

CREATE PROCEDURE tipo_doc(IN p_abreviatura VARCHAR(20))
BEGIN
    SELECT id_tipo_doc 
    FROM tb_tipo_documento 
    WHERE abreviatura = p_abreviatura;
END$$

DELIMITER ;