Update tb_modulos set url='', nombre='Gestionar Roles' where id_modulo=9;
INSERT INTO tb_modulos (nombre,icono,url,id_modulo_padre,id_modulo_hijo,orden,id_estado) VALUES ('Administrar Roles',NULL,'',2,9,1,1);
INSERT INTO tb_modulos (nombre,icono,url,id_modulo_padre,id_modulo_hijo,orden,id_estado) VALUES ('Asignar Roles',NULL,'listUserRols()',2,9,2,1);



INSERT INTO tb_permisos (id_acceso,id_modulo,puede_ver,puede_crear,puede_editar,puede_eliminar) VALUES (1,15,1,1,1,1);
INSERT INTO tb_permisos (id_acceso,id_modulo,puede_ver,puede_crear,puede_editar,puede_eliminar) VALUES (1,16,1,1,1,1);