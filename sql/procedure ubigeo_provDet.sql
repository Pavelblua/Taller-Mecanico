DELIMITER $$

CREATE PROCEDURE ubigeo_provDet(IN p_id_dep VARCHAR(10), IN p_id_prov VARCHAR(100))
BEGIN
    SELECT nombre 
    FROM tb_provincia 
    WHERE id_dep = p_id_dep
      AND id_prov = p_id_prov;
END$$

DELIMITER ;