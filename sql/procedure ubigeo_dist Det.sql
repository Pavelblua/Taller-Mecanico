DELIMITER $$

CREATE PROCEDURE ubigeo_distDet(IN p_id_dep int, IN p_id_prov int, IN p_id_dist int)
BEGIN
    SELECT  nombre
    FROM tb_distrito 
    WHERE id_dep  = p_id_dep
      AND id_prov = p_id_prov
      AND id_dist  = p_id_dist;
END$$

DELIMITER ;