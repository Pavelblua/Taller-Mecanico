ALTER TABLE tb_usuarios 
ADD COLUMN celular VARCHAR(20) AFTER correo,
ADD COLUMN direccion VARCHAR(200) AFTER celular,
ADD COLUMN referencia VARCHAR(200) AFTER direccion;
ADD COLUMN id_tipo_doc INT AFTER id_usuario,
ADD COLUMN nro_doc VARCHAR(20) AFTER id_tipo_doc,
ADD CONSTRAINT fk_usuario_tipo_doc 
FOREIGN KEY (id_tipo_doc) 
REFERENCES tb_tipo_documento(id_tipo_doc);