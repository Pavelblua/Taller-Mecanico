DELIMITER $$

CREATE PROCEDURE ubigeo_dist(IN p_id_dep VARCHAR(10), IN p_id_prov VARCHAR(10), IN p_nombre VARCHAR(100))
BEGIN
    SELECT id_dist 
    FROM tb_distrito 
    WHERE id_dep  = p_id_dep
      AND id_prov = p_id_prov
      AND nombre  = p_nombre;
END$$

DELIMITER ;