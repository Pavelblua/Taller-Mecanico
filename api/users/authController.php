<?php

namespace api\users;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use transformers\responses;
use models\dto\UserDTO;
use models\entity\UserEntity;
use models\Entity\statusEntity;
use security\TokenValidator;
use services\userService;


class authController
{

    private response $res;
    private responses $resps;

private statusEntity $status;

    public function __construct()
    {
        $this->resps = new responses();
        $this->status = new statusEntity();
    }


    public function createUser()
    {
        
        $payload = TokenValidator::validate();
        $idUsuario = $payload['id_usuario'];
        $serv = new userService();

        $usdto = new UserDTO();
        $data = $this->getBody();
        $usdto = $this->resps->mapToEntity($data, new UserDTO());

        $serv->createUser($usdto);



        // header('Content-Type: application/json');
        // $this->status->setStatus(1);
        // $this->status->setMessage('Usuario creado exitosamente');
        // $this->status->setMessage_code(200);
        // $this->status->setData($usdto);

        // $this->resps->sendEntity($this->status,$usdto);
        // exit;
    }
    

    private function getBody(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
        $this->status->setStatus(0);
        $this->status->setMessage('JSON inválido');
        $this->status->setMessage_code(400);
        $this->resps->sendEntity($this->status);
            exit;
        }
        return $data;
    }
}
