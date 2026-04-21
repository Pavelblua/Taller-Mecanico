DELIMITER $$

CREATE PROCEDURE ubigeo_prov(IN p_id_dep VARCHAR(10), IN p_nombre VARCHAR(100))
BEGIN
    SELECT id_prov 
    FROM tb_provincia 
    WHERE id_dep = p_id_dep
      AND nombre = p_nombre;
END$$

DELIMITER ;