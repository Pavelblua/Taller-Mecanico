<?php

namespace modal\modal_status;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use models\Entity\modalStatusEntity;

class modalStatus
{
    public function status(modalStatusEntity $statusEntity)
    {
        $html = '<div class="modal fade" id="modalStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header '.$statusEntity->getColor().'">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">'.$statusEntity->getTitle().'</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body '.$statusEntity->getText_color().' d-flex align-items-center justify-content-center">
                       <span class="text-center"> '.$statusEntity->getMessage().'</span>
                        <i class="'.$statusEntity->getIcon().' fs-1 ms-auto"></i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn '.$statusEntity->getType_button().'" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
                </div>
                <script>abrirModalStatus();</script>';
        return $html;
    }
}
