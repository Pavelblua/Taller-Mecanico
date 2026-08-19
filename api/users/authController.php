<?php

namespace api\users;

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use transformers\responses;
use models\dto\UserDTO;
use models\entity\UserEntity;
use models\Entity\statusEntity;
use security\TokenValidator;
use services\userService;
use transformers\tools;


class authController
{

    private response $res;
    private responses $resps;

    private statusEntity $status;
    private tools $tools;

    public function __construct()
    {
        $this->resps = new responses();
        $this->status = new statusEntity();
        $this->tools = new tools();
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
    }

    public function updateUser($tipo_doc, $num_doc)
    {
        $payload = TokenValidator::validate();
        $idUsuario = $payload['id_usuario'];

        $serv = new userService();
        $usdto = new UserDTO();
        $data = $this->getBody();
        $usdto = $this->resps->mapToEntity($data, new UserDTO());
        $usdto->tipo_doc = $tipo_doc;
        $usdto->nro_doc = $num_doc;       
        $serv->updateUser($usdto);

    }

    public function listUser($search=null){
        $payload = TokenValidator::validate();
        $idUsuario = $payload['id_usuario'];
        $serv = new userService();

        $users = $serv->listUser($search);

        $this->status->setStatus(1)
            ->setMessage('Lista de usuarios obtenida')
            ->setMessage_code(200);

        $this->resps->sendEntity($this->status, $users);
    }

    public function uploadImage()
{
    $payload = TokenValidator::validate();
    $idUsuario = $payload['id_usuario'];

    if (
        !isset($_POST['tipo_doc']) ||
        !isset($_POST['nro_doc'])
    ) {

        echo json_encode([
            'status' => false,
            'message' => 'tipo_doc y nro_doc son obligatorios'
        ]);

        exit;
    }

    if (!isset($_FILES['archivo'])) {
        echo json_encode([
            'status' => false,
            'message' => 'Debe enviar un archivo'
        ]);
        exit;
    }
    $tipoDoc = trim($_POST['tipo_doc']);
    $nroDoc  = trim($_POST['nro_doc']);
    $archivo = $_FILES['archivo'];

    $extension = strtolower(pathinfo($archivo['name'],PATHINFO_EXTENSION));
    $fileName = $tipoDoc.'_'.$nroDoc.'.'.$extension;

    $result = $this->tools->uploadFile($fileName,$archivo,'documentos');

    echo json_encode($result);

    exit;
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
