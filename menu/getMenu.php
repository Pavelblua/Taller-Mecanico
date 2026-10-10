<?php

namespace menu;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use repositories\menuRep;
class getMenu
{
    private function Menu($idUsuario)
    {
        $menuRep = new menuRep();
        $menuPadre = $menuRep->getMenuPrincipal($idUsuario);
        $menuPrincipal = null;
        foreach ($menuPadre as $menu) {
            $submenu = $this->SubMenu($idUsuario, $menu->getIdModulo());

            if (count($submenu) == 0) {
                $menuPrincipal .= '<li class="nav-item">';
                $menuPrincipal .= '<a class="nav-link" href="#" onclick="' . $menu->getUrl() . '"><i class="bi ' . $menu->getIcono() . '"></i> ' . $menu->getNombre() . '</a>';
                $menuPrincipal .= '</li>';
            } else {
                $menuPrincipal .= '<li class="nav-item dropdown">';
                $menuPrincipal .= '<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#" onclick="' . $menu->getUrl() . '"><i class="bi ' . $menu->getIcono() . '"></i> ' . $menu->getNombre() . '</a>';
                $menuPrincipal .='<ul class="dropdown-menu">';
                
                foreach ($submenu as $sub) {
                    $submenuFinal = $this->SubMenuFinal($idUsuario, $sub->getIdPadre(), $sub->getIdModulo());
                    if (count($submenuFinal) == 0) {
                        $menuPrincipal .= '<li><a class="dropdown-item" href="#" onclick="' . $sub->getUrl() . '">' . $sub->getNombre(). '</a></li>';
                    } else {
                        $menuPrincipal .= '<li class="dropdown-submenu">';
                        $menuPrincipal .= '<a class="dropdown-item dropdown-toggle" href="#" onclick="' . $sub->getUrl() . ';">' . $sub->getNombre() . '</a>';
                        $menuPrincipal .= '<ul class="dropdown-menu">';
                        foreach ($submenuFinal as $final) {
                            $menuPrincipal .= '<li><a class="dropdown-item" href="#" onclick="' . $final->getUrl() . ';">' . $final->getNombre() . '</a></li>';
                        }
                        $menuPrincipal .= '</ul>';
                        $menuPrincipal .= '</li>';
                    }
                }


                $menuPrincipal .='</ul>';
                $menuPrincipal .= '</li>';
            }

        }
        return $menuPrincipal;

    }

    private function SubMenu($idUsuario, $idMenu)
    {
        $menuRep = new menuRep();
        return $menuRep->getSubMenu($idUsuario, $idMenu);
    }

    private function SubMenuFinal($idUsuario, $idMenu, $idsubmenu)
    {
        $menuRep = new menuRep();
        return $menuRep->getSubMenuFinal($idUsuario, $idMenu, $idsubmenu);
    }

    public function generateMenu($idUsuario)
    {
        $htmlIni = '<ul class="navbar-nav ms-auto">';
        $htmlFin = '</ul>';
        $htmlmenu = $this->Menu($idUsuario);

        return $htmlIni . $htmlmenu . $htmlFin;

    }


}
