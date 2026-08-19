<?php

namespace plantillas\sections;

class head
{
    private function headLogo()
    {
        $html = '<a class="navbar-brand text-white fw-bold" href="#">
        <i class="bi bi-gear"></i> TallerPro
        </a>';

        return $html;
    }

   private function headMenuButton(){
        $html ='<button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
        <i class="bi bi-list"></i>
    </button>';

    return $html;
    }

    private function headMenu(){
        $html = '<!-- MENU -->
    <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav ms-auto">

            <!-- DASHBOARD -->
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-speedometer2"></i> Dashboard</a>
            </li>

            <!-- USUARIOS -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-people"></i> Usuarios
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Gestión de Usuarios</a></li>
                    <li><a class="dropdown-item" href="#">Roles</a></li>
                    <li><a class="dropdown-item" href="#">Permisos</a></li>
                </ul>
            </li>

            <!-- CLIENTES -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-person-badge"></i> Clientes
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Lista de Clientes</a></li>
                    <li><a class="dropdown-item" href="#">Registrar Cliente</a></li>
                </ul>
            </li>

            <!-- AUTOMOVILES -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-car-front"></i> Automóviles
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Lista de Autos</a></li>
                    <li><a class="dropdown-item" href="#">Registrar Auto</a></li>
                </ul>
            </li>

            <!-- DIAGNOSTICO -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-tools"></i> Diagnóstico
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Nuevo Diagnóstico</a></li>
                    <li><a class="dropdown-item" href="#">Historial</a></li>
                </ul>
            </li>

            <!-- COTIZACION -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-cash-stack"></i> Cotización
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Nueva Cotización</a></li>
                    <li><a class="dropdown-item" href="#">Historial</a></li>
                </ul>
            </li>

            <!-- PAGOS -->
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-credit-card"></i> Pagos</a>
            </li>

        </ul>
    </div>';

    return $html;
    }

    public function headConstructor(){
        $html = '<nav class="navbar navbar-expand-lg custom-navbar px-3">';
        $html .= $this->headLogo();
        $html .= $this->headMenuButton();
        $html .= $this->headMenu();
        $html .= '</nav>';

        return $html;
    }
}
