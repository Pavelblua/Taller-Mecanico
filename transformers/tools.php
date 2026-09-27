<?php

namespace transformers;

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use models\entity\sessionUser;
class tools
{
    public function uploadFile(string $fileName, array $file, string $folder): array
    {

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
            $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/uploads/' . trim($folder, '/') . '/';

        // crear carpeta
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // ruta completa
        $fullPath = $directory . $fileName;

        // mover archivo
        if (
            !move_uploaded_file(
                $file['tmp_name'],
                $fullPath
            )
        ) {

            return [
                'status' => false,
                'message' => 'No se pudo guardar el archivo'
            ];
        }

        return [
            'status' => true,
            'message' => 'Archivo guardado correctamente',
            'file_name' => $fileName,
            'path' => trim($folder, '/') . '/' . $fileName
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
        $_SESSION['token'] = $su->getHash();
        $_SESSION['nombres'] = $su->getNombres();
        $_SESSION['correo'] = $su->getCorreo();
        $_SESSION['celular'] = $su->getCelular();

        // Opcional: identificar que el usuario está autenticado
        $_SESSION['autenticado'] = $su->getAutenticado();

        return true;
    }

    function changeFile($archivo, $ruta, $nombre, $tipo)
    {
        try {
            if (!is_array($archivo) || !isset($archivo['tmp_name']) || !isset($archivo['name'])) {
                return [false, "Error: el parámetro 'archivo' no tiene la estructura esperada de \$_FILES (faltan índices 'tmp_name' o 'name')."];
            }
            $tipo = strtolower(trim((string) $tipo));

            $extensionesPorTipo = [
                'imagen' => ['png', 'jpg', 'jpeg'],
                'documento' => ['xml', 'xls', 'xlsx', 'doc', 'docx', 'pdf'],
            ];

            if (!array_key_exists($tipo, $extensionesPorTipo)) {
                return [false, "Error: el tipo '$tipo' no es válido. Los tipos permitidos son: " . implode(', ', array_keys($extensionesPorTipo)) . "."];
            }

            if (isset($archivo['error']) && $archivo['error'] !== UPLOAD_ERR_OK) {
                $erroresUpload = [
                    UPLOAD_ERR_INI_SIZE => "El archivo excede el tamaño máximo permitido por el servidor (upload_max_filesize).",
                    UPLOAD_ERR_FORM_SIZE => "El archivo excede el tamaño máximo permitido por el formulario (MAX_FILE_SIZE).",
                    UPLOAD_ERR_PARTIAL => "El archivo se subió solo parcialmente.",
                    UPLOAD_ERR_NO_FILE => "No se seleccionó ningún archivo para subir.",
                    UPLOAD_ERR_NO_TMP_DIR => "Falta la carpeta temporal en el servidor.",
                    UPLOAD_ERR_CANT_WRITE => "No se pudo escribir el archivo en disco (posible problema de permisos).",
                    UPLOAD_ERR_EXTENSION => "Una extensión de PHP detuvo la subida del archivo.",
                ];
                $codigo = $archivo['error'];
                $detalle = $erroresUpload[$codigo] ?? "Código de error de subida desconocido ($codigo).";
                return [false, "Error al subir el archivo: $detalle"];
            }

            if (!is_uploaded_file($archivo['tmp_name'])) {
                return [false, "Error: el archivo temporal '{$archivo['tmp_name']}' no corresponde a una subida válida vía HTTP POST."];
            }

            $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

            if (empty($extension)) {
                return [false, "Error: no se pudo determinar la extensión del archivo original '{$archivo['name']}'."];
            }

            $extensionesPermitidas = $extensionesPorTipo[$tipo];
            if (!in_array($extension, $extensionesPermitidas, true)) {
                return [false, "Error: la extensión '.$extension' no es válida para el tipo '$tipo'. Extensiones válidas para '$tipo': " . implode(', ', $extensionesPermitidas) . "."];
            }

            $ruta = rtrim($ruta, '/\\');
            if (!is_dir($ruta)) {
                if (!mkdir($ruta, 0755, true)) {
                    return [false, "Error: no se pudo crear el directorio destino '$ruta'. Verifique permisos del servidor."];
                }
            }

            if (!is_writable($ruta)) {
                return [false, "Error: el directorio '$ruta' no tiene permisos de escritura para el proceso PHP."];
            }

            if (empty(trim($nombre))) {
                return [false, "Error: el parámetro 'nombre' está vacío o no es válido."];
            }

            $rutaCompleta = $ruta . DIRECTORY_SEPARATOR . $nombre . '.' . $extension;

            if (file_exists($rutaCompleta)) {
                return [false, "Error: ya existe un archivo en '$rutaCompleta'. Elija otro nombre o elimine el archivo existente."];
            }

            if (!move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
                $errorInfo = error_get_last();
                $detalleError = $errorInfo['message'] ?? 'motivo desconocido';
                return [false, "Error al mover el archivo hacia '$rutaCompleta'. Detalle: $detalleError"];
            }

            return [true, "Archivo guardado con éxito"];

        } catch (\Throwable $e) {

            return [false, "Error inesperado: " . $e->getMessage() . " (archivo: " . $e->getFile() . ", línea: " . $e->getLine() . ")"];
        }
    }

    function searchImage(string $folder, string $fileName)
    {
        $existe = "";
        $folder = rtrim($folder, '/') . '/';

        if (!is_dir($folder)) {
            return $existe;
        }

        $archivos = scandir($folder);

        foreach ($archivos as $archivo) {
            if ($archivo === '.' || $archivo === '..') {
                continue;
            }
       $nombreSinExtension = pathinfo($archivo, PATHINFO_FILENAME);
            
            if (strcasecmp($nombreSinExtension, $fileName) === 0) {
                
                $existe = $archivo;
            } 

        }

        if ($existe==""){
            $existe="userDefault.png";
        }
        return $existe;
    }
}
