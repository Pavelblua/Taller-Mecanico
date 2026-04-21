SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE tb_usuarios
DROP FOREIGN KEY fk_usuario_distrito;

ALTER TABLE tb_clientes
DROP FOREIGN KEY fk_cliente_distrito;
ALTER TABLE tb_usuarios
ADD COLUMN id_dep CHAR(2);

ALTER TABLE tb_clientes
ADD COLUMN id_dep CHAR(2);

ALTER TABLE tb_distrito
DROP PRIMARY KEY,
ADD PRIMARY KEY (id_dist,id_prov,id_dep);

ALTER TABLE tb_usuarios
ADD CONSTRAINT fk_usuario_distrito
FOREIGN KEY (id_dist,id_prov,id_dep)
REFERENCES tb_distrito(id_dist,id_prov,id_dep);

ALTER TABLE tb_clientes
ADD CONSTRAINT fk_cliente_distrito
FOREIGN KEY (id_dist,id_prov,id_dep)
REFERENCES tb_distrito(id_dist,id_prov,id_dep);

SET FOREIGN_KEY_CHECKS=1;