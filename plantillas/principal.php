<?php

namespace plantillas;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use plantillas\sections\head;
use plantillas\sections\body;
use plantillas\sections\footer;

class principal
{
    private function js_generic(){
        $js = '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>';
        $js .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>';
        $js .= '<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>';
        return $js;
    }
    public function login_body()
    {
        $html = '<div class="login-card">
                <!-- LOGO -->
                <div class="logo">
                    <i class="bi bi-gear-wide-connected"></i>
                </div>

                <h4 class="login-title">Sistema Taller Pro</h4>

                <form>

                    <!-- USUARIO -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <input type="text" id="usuario" class="form-control" placeholder="Usuario" required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input type="password" id="password" class="form-control" placeholder="Contraseña" required>
                    </div>

                    <!-- BOTON -->
                    <div class="d-grid">
                        <button class="btn btn-login text-white" onclick="login()" type="button">
                            <i class="bi bi-box-arrow-in-right"></i> Ingresar
                        </button>
                    </div>

                </form>

                <div class="footer-text">
                    © PREB 2026
                </div>

            </div>';
        return $html;
    }

    public function login_css()
    {
        $css = '<link rel="stylesheet" href="./css/login.css">';
        return $css;
    }

    public function login_js()
    {
        $js = $this->js_generic();
        $js .= '<script src="js/tools.js"></script>';
        $js .= '<script src="js/modal/status.js"></script>';
        $js .= '<script src="js/login/login.js"></script>';
        $js .= '<script src="js/login/getLogin.js"></script>';

        return $js;
    }

    public function index_body($usuario)
    {
        $version = "1.2";

        $head = new head();
        $body = new body();
        $footer = new footer();

        $html = $head->headConstructor();
        $html .= $body->bodyConstructor();
        $html .= $footer->footerConstructor($version, $usuario);
        
        return $html;
    }

    public function index_css()
    {
        $css = '<link rel="stylesheet" href="./css/main.css">';
        return $css;
    }

    public function index_js()
    {
        $js = $this->js_generic();
        $js .= '<script src="js/submenu.js"></script>';
        $js .= '<script src="js/tools.js"></script>';
        $js .= '<script src="js/optionsMenu.js"></script>';
        $js .= '<script src="js/modal/status.js"></script>';
        return $js;
    }

    public function add_div()
    {
        $html = "<div id='result'></div>";
        $html .= "<div id='modalstatus'></div>";
        return $html;
    }
  


}
