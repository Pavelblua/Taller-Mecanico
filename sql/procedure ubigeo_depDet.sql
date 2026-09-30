DELIMITER $$

CREATE  PROCEDURE ubigeo_depDet(IN id_dep_in int)
BEGIN
    SELECT nombre 
    FROM tb_departamento 
    WHERE id_dep = id_dep_in;
END$$

DELIMITER ;