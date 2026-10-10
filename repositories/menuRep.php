<?php

namespace repositories;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use security\conn\conection;
use models\Entity\menuEntity;
class menuRep
{
    public function getMenuPrincipal($idUsuario)
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();

        $query = "CALL menuPrincipal(?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();

        $result = $stmt->get_result();
        $menus = [];
        
        while ($row = $result->fetch_assoc()) {
            $menu = new menuEntity();
            $menu->setIdModulo($row['id_modulo'])
                ->setNombre($row['nombre'])
                ->setIcono($row['icono'])
                ->setUrl($row['url'])
                ->setIdPadre($row['id_modulo_padre'])
                ->setIdHijo($row['id_modulo_hijo']);
            $menus[] = $menu;
        }
        $stmt->close();
        $conect->close();

        return $menus;
    }

    public function getSubMenu($idUsuario, $idMenu)
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();

        $query = "CALL Submenu(?,?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("ii", $idUsuario,$idMenu);
        $stmt->execute();

        $result = $stmt->get_result();
        $menus = [];
        while ($row = $result->fetch_assoc()) {
            $menu = new menuEntity();
            $menu->setIdModulo($row['id_modulo'])
                ->setNombre($row['nombre'])
                ->setIcono($row['icono'])
                ->setUrl($row['url'])
                ->setIdPadre($row['id_modulo_padre'])
                ->setIdHijo($row['id_modulo_hijo']);
            $menus[] = $menu;
        }
        $stmt->close();
        $conect->close();

        return $menus;
    }

    public function getSubMenuFinal($idUsuario, $idMenu, $idSubMenu)
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();

        $query = "CALL Submenufinal(?,?,?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("iii", $idUsuario,$idMenu, $idSubMenu);
        $stmt->execute();

        $result = $stmt->get_result();
        $menus = [];
        while ($row = $result->fetch_assoc()) {
            $menu = new menuEntity();
            $menu->setIdModulo($row['id_modulo'])
                ->setNombre($row['nombre'])
                ->setIcono($row['icono'])
                ->setUrl($row['url'])
                ->setIdPadre($row['id_modulo_padre'])
                ->setIdHijo($row['id_modulo_hijo']);
            $menus[] = $menu;
        }
        $stmt->close();
        $conect->close();

        return $menus;
    }
}
