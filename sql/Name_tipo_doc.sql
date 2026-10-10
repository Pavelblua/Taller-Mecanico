DELIMITER //
CREATE PROCEDURE Name_tipo_doc(IN p_id VARCHAR(20))
BEGIN
    SELECT abreviatura 
    FROM tb_tipo_documento 
    WHERE id_tipo_doc = p_id;
end //

DELIMITER ;