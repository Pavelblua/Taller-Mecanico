<?php

namespace controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use repositories\combosRep;

class comboCont
{
    public function cboDepartamento($departamento){
        $comboRep = new combosRep();
        $departamentos = $comboRep->listaDepartamentos();
        $options= '<option value="">Seleccione departamento</option>';

        for ($i = 0; $i < count($departamentos); $i++) {
            $id = $departamentos[$i]->getId();
            $nombre = htmlspecialchars((string) $departamentos[$i]->getNombre(), ENT_QUOTES, 'UTF-8');
            if($departamento == $nombre){
                $options .= '<option value="' . $id . '" selected>' . $nombre . '</option>';
            } else {
                $options .= '<option value="' . $id . '">' . $nombre . '</option>';
            }
        }

        return $options;
    }

    public function cboProvincia($id_dep, $provincia){
        $comboRep = new combosRep();
        $provincias = $comboRep->listaProvincia($id_dep);
        $options = '<option value="">Seleccione provincia</option>';

        for ($i = 0; $i < count($provincias); $i++) {
            $id = $provincias[$i]->getId();
            $nombre = htmlspecialchars((string) $provincias[$i]->getNombre(), ENT_QUOTES, 'UTF-8');
            if($provincia == $nombre){
                $options .= '<option value="' . $id . '" selected>' . $nombre . '</option>';
            } else {
                $options .= '<option value="' . $id . '">' . $nombre . '</option>';
            }
        }

        return $options;
    }

    public function cboDistrito($id_dep, $id_prov, $distrito){
        $comboRep = new combosRep();
        $distritos = $comboRep->listaDistrito($id_dep, $id_prov);
        $options = '<option value="">Seleccione distrito</option>';

        for ($i = 0; $i < count($distritos); $i++) {
            $id = $distritos[$i]->getId();
            $nombre = htmlspecialchars((string) $distritos[$i]->getNombre(), ENT_QUOTES, 'UTF-8');
            if($distrito == $nombre){
                $options .= '<option value="' . $id . '" selected>' . $nombre . '</option>';
            } else {
                $options .= '<option value="' . $id . '">' . $nombre . '</option>';
            }
        }

        return $options;
    }

    public function cbotipoDocumento($tipoDocumento){
        $comboRep = new combosRep();
        $tipoDocumentos = $comboRep->listaTipoDocumento();
        $options= '<option value="">Seleccione tipo de documento</option>';

        for ($i = 0; $i < count($tipoDocumentos); $i++) {
            $id = $tipoDocumentos[$i]->getId();
            $nombre = htmlspecialchars((string) $tipoDocumentos[$i]->getNombre(), ENT_QUOTES, 'UTF-8');
            if($tipoDocumento == $nombre){
                $options .= '<option value="' . $id . '" selected>' . $nombre . '</option>';
            } else {
                $options .= '<option value="' . $id . '">' . $nombre . '</option>';
            }
        }

        return $options;
    }
}
