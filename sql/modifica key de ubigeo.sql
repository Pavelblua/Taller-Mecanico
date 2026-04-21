SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE tb_usuarios
DROP FOREIGN KEY fk_user_dist;

ALTER TABLE tb_distrito
DROP FOREIGN KEY fk_dist_prov;

ALTER TABLE tb_provincia
DROP FOREIGN KEY fk_prov_dep;

ALTER TABLE tb_usuarios
ADD COLUMN id_prov CHAR(4) AFTER id_dist;

ALTER TABLE tb_clientes
ADD COLUMN id_dist CHAR(6),
ADD COLUMN id_prov CHAR(4);

UPDATE tb_usuarios u
JOIN tb_distrito d
ON u.id_dist = d.id_dist
SET u.id_prov = d.id_prov;

UPDATE tb_clientes c
JOIN tb_distrito d
ON c.id_dist = d.id_dist
SET c.id_prov = d.id_prov;

ALTER TABLE tb_provincia
DROP PRIMARY KEY,
ADD PRIMARY KEY (id_prov,id_dep);

ALTER TABLE tb_distrito
DROP PRIMARY KEY,
ADD PRIMARY KEY (id_dist,id_prov);

ALTER TABLE tb_provincia
ADD CONSTRAINT fk_provincia_departamento
FOREIGN KEY (id_dep)
REFERENCES tb_departamento(id_dep);

ALTER TABLE tb_distrito
ADD COLUMN id_dep CHAR(2) AFTER id_prov;

ALTER TABLE tb_distrito
ADD CONSTRAINT fk_distrito_provincia
FOREIGN KEY (id_prov,id_dep)
REFERENCES tb_provincia(id_prov,id_dep);


ALTER TABLE tb_clientes
ADD CONSTRAINT fk_cliente_distrito
FOREIGN KEY (id_dist,id_prov)
REFERENCES tb_distrito(id_dist,id_prov);


ALTER TABLE tb_usuarios
ADD CONSTRAINT fk_usuario_distrito
FOREIGN KEY (id_dist,id_prov)
REFERENCES tb_distrito(id_dist,id_prov);

SET FOREIGN_KEY_CHECKS=1;