DELIMITER $$

CREATE PROCEDURE ubigeo_dep(IN p_nombre VARCHAR(100))
BEGIN
    SELECT id_dep 
    FROM tb_departamento 
    WHERE nombre = p_nombre;
END$$

DELIMITER ;