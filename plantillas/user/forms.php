<?php

namespace plantillas\user;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use controllers\comboCont;
class forms
{
    public function newUser(){
        $combo = new comboCont();

        $html ='<div class="card p-4 ">

            <div class="mb-4 text-success fw-bold">
                <h2 class="mb-1">
                    <i class="bi bi-person-fill-add"></i>
                    Registro de Usuario
                </h2>
            </div>

            <form id="frmUsuario" method="POST" action="#">

                <div class="row g-4 text-success fw-bold">
                    <div class="col-md-9">

                        <div class="row g-3">

                            <div class="col-md-4">
                                <label for="id_tipo_doc" class="form-label">
                                    <i class="bi bi-postcard"></i>
                                     Tipo de documento
                                </label>

                                <select class="form-select"
                                        id="id_tipo_doc"
                                        name="id_tipo_doc"
                                        required>

                                    '.$combo->cbotipoDocumento('').'

                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="nro_doc" class="form-label">
                                    <i class="bi bi-postcard"></i>
                                    Nro. documento
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="nro_doc"
                                       name="nro_doc"
                                       maxlength="20"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label for="nombres" class="form-label">
                                    <i class="bi bi-person-vcard-fill"></i>
                                    Nombres
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="nombres"
                                       name="nombres"
                                       maxlength="100"
                                       required>
                            </div>


                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">
                                    <i class="bi bi-person-vcard-fill"></i>
                                    Apellidos
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="apellidos"
                                       name="apellidos"
                                       maxlength="100"
                                       required>
                            </div>


                            <div class="col-md-6">
                                <label for="correo" class="form-label">
                                    <i class="bi bi-envelope-at-fill"></i>
                                    Correo
                                </label>

                                <input type="email"
                                       class="form-control"
                                       id="correo"
                                       name="correo"
                                       maxlength="100"
                                       required>
                            </div>


                            <div class="col-md-6">
                                <label for="celular" class="form-label">
                                    <i class="bi bi-phone-vibrate-fill"></i>
                                    Celular
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="celular"
                                       name="celular"
                                       maxlength="20"
                                       required>
                            </div>


                            <div class="col-md-12">
                                <label for="direccion" class="form-label">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    Dirección
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="direccion"
                                       name="direccion"
                                       maxlength="200"
                                       required>
                            </div>


                            <div class="col-md-12">
                                <label for="referencia" class="form-label">
                                    <i class="bi bi-compass-fill"></i>
                                    Referencia
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="referencia"
                                       name="referencia"
                                       maxlength="200">
                            </div>


                            <div class="col-md-4">
                                <label for="id_dep" class="form-label">
                                    <i class="bi bi-geo-fill"></i>
                                    Departamento
                                </label>

                                <select class="form-select"
                                        id="id_dep"
                                        name="id_dep"
                                        required onchange="cargaProvincia(this.value)">

                                    '.$combo->cboDepartamento('').'

                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="id_prov" class="form-label">
                                    <i class="bi bi-geo-fill"></i>
                                    Provincia
                                </label>

                                <select class="form-select"
                                        id="id_prov"
                                        name="id_prov"
                                        required onchange="cargaDistrito(this.value)">

                                    <option value="">
                                        Seleccione provincia
                                    </option>

                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="id_dist" class="form-label">
                                    <i class="bi bi-geo-fill"></i>
                                    Distrito
                                </label>

                                <select class="form-select"
                                        id="id_dist"
                                        name="id_dist"
                                        required>

                                    <option value="">
                                        Seleccione distrito
                                    </option>

                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="d-flex flex-column h-100">
                            <label for="imagen_usuario"
                                   id="previewImagen"
                                   class="border rounded d-flex align-items-center justify-content-center flex-grow-1 overflow-hidden"
                                   >

                                <div id="mensajeImagen"
                                     class="text-center text-muted">

                                    <i class="bi bi-person-circle fs-1 d-block mb-2"></i>

                                    <span>
                                        Seleccione una imagen
                                    </span>

                                </div>

                                <img id="imagenPreview"
                                     src=""
                                     alt="Vista previa"
                                     class="img-fluid d-none"
                                     style="width: 100%; height: 100%; object-fit: contain;">

                            </label>

                            <input type="file"
                                   id="imagen_usuario"
                                   name="imagen_usuario"
                                   accept="image/jpeg,image/png,image/webp"
                                   class="d-none">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">

                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="bi bi-trash3-fill"></i>
                        Limpiar
                    </button>

                    <button type="button" class="btn btn-primary" onclick="insertNewUser()">
                        <i class="bi bi-floppy2-fill"></i>
                        Guardar usuario
                    </button>
                </div>
            </form>
        </div>';
        return $html;
    }
}
