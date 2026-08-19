<?php

namespace plantillas\sections;

class footer
{
    public function footerConstructor($version, $user){
        $anio = date("Y");

        $html ='<footer class="custom-footer">
                    <span>Versión '.$version.'</span>
                    <span> <b> EN USO POR '.$user.' </b> </span>
                    <span>© PREB '.$anio.'</span>
                </footer>';
        return $html;
    }
}
