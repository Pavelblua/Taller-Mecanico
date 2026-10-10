DELIMITER //

CREATE PROCEDURE menuPrincipal(IN id_in INT)
BEGIN
    SELECT
        pe.id_modulo,
        tm.nombre,
        tm.icono,
        tm.url,
        tm.id_modulo_padre,
        tm.id_modulo_hijo
    FROM tb_permisos AS pe
    INNER JOIN tb_modulos AS tm
        ON pe.id_modulo = tm.id_modulo
    WHERE pe.id_acceso = id_in
      AND tm.id_modulo_padre IS NULL
      AND tm.id_estado = 1;
END //

DELIMITER ;