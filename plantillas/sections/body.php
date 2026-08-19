<?php

namespace plantillas\sections;

class body
{
    public function bodyConstructor(){
        $html ='<div class="container-fluid mt-4 flex-grow-1">
                    <div id="contenido-dinamico" class="content-area">
                        <!-- Aquí se cargarán formularios dinámicamente -->
                    </div>
                </div>';
        return $html;
    }
}
