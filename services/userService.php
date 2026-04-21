<?php

namespace services;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use repositories\security\loginRep;
use models\entity\UserEntity;
use models\dto\UserDTO;
use transformers\responses;
use models\Entity\ubigeoEntity;
use models\Entity\statusEntity;
use repositories\ubigeoRep;
use repositories\aditionalsRep;
use repositories\userRep;

class userService
{
    public function createUser(UserDto $userDTO)
    {
        try {
            $user = new UserEntity();
            $userVal = new UserEntity();
            $status = new statusEntity();

            $rep = new userRep();
            $resp = new responses();
            $getUbigeo = new ubigeoRep();
            $ad = new aditionalsRep();

            $user = $resp->mapDTOToEntity($userDTO, $user);
            $user->setId_tipo_doc($ad->getIdTypeDocument($user->getTipo_doc()));
            $user->setId_estado(1);
            $user->setEstado('ACTIVO');

             $userVal = $rep->detailUser($user);
            if ($userVal->getId_usuario() !== null) {
                $userDTO = $resp->mapEntityToDTO($userVal, $userDTO);
                $status->setStatus(0)
                    ->setMessage('El usuario ya existe')
                    ->setMessage_code(409);

                $resp->sendEntity($status, $userDTO);
            }

            $ubi = new ubigeoEntity();
            $ubi = $resp->mapEntityToEntity($user, $ubi);
            $ubi = $getUbigeo->getTotalIdUbigeo($ubi);
            $user = $resp->mapEntityToEntity($ubi, $user);

            $user = $rep->createUser($user);
            $userDTO = $resp->mapEntityToDTO($user, $userDTO);
            $status->setStatus(1)
                ->setMessage('El usuario fue creado')
                ->setMessage_code(201);

            $resp->sendEntity($status, $userDTO);

        } catch (\Exception $e) {
            $status = new statusEntity();
            $status->setStatus(0)
                ->setMessage('Error al crear el usuario')
                ->setMessage_code(500)
                ->setError_message($e->getMessage())
                ->setError_code($e->getCode());

            $resp = new responses();
            $resp->sendEntity($status);
        }
    }

}
