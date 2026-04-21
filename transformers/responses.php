<?php

namespace transformers;

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use models\entity\statusEntity;

class responses
{
    public function sendResponse(int $httpCode, array $data): void
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        http_response_code($httpCode);
        echo json_encode($data);
        exit;
    }

    public function mapToEntity($dto, $entity, $map = [])
    {
        if (is_string($dto)) {
            $dto = json_decode($dto, true);
        }
        foreach ($dto as $key => $value) {
            $property = $map[$key] ?? $key;

            if (property_exists($entity, $property)) {
                $entity->$property = $value;
            }
        }
        return $entity;
    }

    public function mapDTOToEntity(object $dto, object $entity): object
    {
        foreach (get_object_vars($dto) as $campo => $valor) {
            $setter = 'set' . ucfirst($campo);

            if (method_exists($entity, $setter)) {
                $entity->$setter($valor);
            }
        }
        return $entity;
        //ejemplo: $entity = EntityMapper::mapDTOToEntity($dto, new UserEntity());
    }

    public function mapEntityToDTO(object $entity, object $dto): object
    {
        foreach (get_object_vars($dto) as $campo => $valor) {
            $getter = 'get' . ucfirst($campo);

            if (method_exists($entity, $getter)) {
                $dto->$campo = $entity->$getter();
            }
        }
        return $dto;
        //ejemplo: $dto = EntityMapper::mapEntityToDTO($entity, new UserDTO());
    }

    public static function mapEntityToEntity(object $source, object $target): object
    {
        $methods = get_class_methods($source);
        foreach ($methods as $method) {
            if (strpos($method, 'get') === 0) {
                $setter = 'set' . substr($method, 3);
                if (method_exists($target, $setter)) {
                    $value = $source->$method();
                    $target->$setter($value);
                }
            }
        }

        return $target;
    }

    public function sendEntity(statusEntity $status, mixed $data = null): void
    {
        http_response_code($status->getMessage_code());
        header('Content-Type: application/json');

        $response = [
            'status' => $status->getStatus(),
            'message' => $status->getMessage(),
            'message_code' => $status->getMessage_code(),
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        if ($status->getError_message() !== '') {
            $response['error_message'] = $status->getError_message();
            $response['error_code'] = $status->getError_code();
        }

        echo json_encode($response);
        exit;
    }
}

