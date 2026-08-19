<?php

namespace transformers;

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use models\entity\sessionUser;
class tools
{
     public function uploadFile(string $fileName, array $file, string $folder): array {

        if (!isset($file['tmp_name'])) {

            return [
                'status' => false,
                'message' => 'Archivo inválido'
            ];
        }

        if ($file['error'] !== 0) {

            return [
                'status' => false,
                'message' => 'Error al subir archivo'
            ];
        }

        $directory =
            $_SERVER['DOCUMENT_ROOT'].'/tallerWeb/uploads/'.trim($folder, '/').'/';

        // crear carpeta
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // ruta completa
        $fullPath = $directory.$fileName;

        // mover archivo
        if (!move_uploaded_file(
            $file['tmp_name'],
            $fullPath
        )) {

            return [
                'status' => false,
                'message' => 'No se pudo guardar el archivo'
            ];
        }

        return [
            'status' => true,
            'message' => 'Archivo guardado correctamente',
            'file_name' => $fileName,
            'path' => trim($folder, '/').'/'.$fileName
        ];
    }

    function createSession(sessionUser $su)
{
    // Iniciar sesión si todavía no está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Crear variables de sesión
    $_SESSION['usuario'] = $su->getUsuario();
    $_SESSION['token']  = $su->getHash();
    $_SESSION['nombres']     = $su->getNombres();
    $_SESSION['correo']     = $su->getCorreo();
    $_SESSION['celular']     = $su->getCelular();

    // Opcional: identificar que el usuario está autenticado
    $_SESSION['autenticado'] = $su->getAutenticado();

    return true;
}
}
