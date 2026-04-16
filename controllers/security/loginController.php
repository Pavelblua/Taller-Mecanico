<?php

namespace controllers\security;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use services\security\loginService;
use transformers\response;
use models\Entity\loginEntity;
class loginController
{

    private loginService $loginService;

    public function __construct()
    {
        $this->loginService = new loginService();
    }
    public function login(): void
    {

        $res = new response();
        $log = new loginEntity();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $res->sendResponse(405, ['status' => false, 'message' => 'Método no permitido']);
            return;
        }
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $res->sendResponse(400, ['status' => false, 'message' => 'JSON inválido']);
            return;
        }
        if (empty($data['user']) || empty($data['password'])) {
            $res->sendResponse(400, [
                'status' => false,
                'message' => 'Los campos user y password son requeridos'
            ]);
            return;
        // } else{
        //     $log->setUsuario_login($data['user']);
        //     $log->setPassword_hash($data['password']);
        // }

        // $log = $this->loginService->login($log);
        // if ($log->getMessage_code() === 200) {
        //     $res->sendResponse(200, [
        //         'status' => true,
        //         'message' => 'Login exitoso',
        //         'id_usuario' => $log->getId_usuario()
        //     ]);
        // } else {
        //     $res->sendResponse(401, [
        //         'status' => false,
        //         'message' => 'Credenciales incorrectas'
        //     ]);
        // }
    }
}
$controller = new loginController();
$controller->login();
