<?php

namespace transformers;

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use models\entity\sessionUser;
use repositories\userRep;
use security\configuration\config;
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
        $_SESSION['idusuario'] = $su->getId_usuario();
        $_SESSION['usuario'] = $su->getUsuario();
        $_SESSION['token'] = $su->getHash();
        $_SESSION['nombres'] = $su->getNombres();
        $_SESSION['correo'] = $su->getCorreo();
        $_SESSION['celular'] = $su->getCelular();
        $_SESSION['idrol'] = $su->getId_rol();

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

            $nombre = trim((string) $nombre);
            if ($nombre === '') {
                return [false, "Error: el parámetro 'nombre' está vacío o no es válido."];
            }
            if ($nombre !== basename($nombre) || strpos($nombre, '..') !== false) {
                return [false, "Error: el parámetro 'nombre' contiene caracteres de ruta no permitidos."];
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

            $rutaCompleta = $ruta . DIRECTORY_SEPARATOR . $nombre . '.' . $extension;

            $todasLasExtensiones = array_unique(array_merge(...array_values($extensionesPorTipo)));

            $anteriores = [];
            $items = scandir($ruta);
            if ($items === false) {
                return [false, "Error: no se pudo leer el contenido del directorio '$ruta'."];
            }
            foreach ($items as $item) {
                if ($item === '.' || $item === '..') {
                    continue;
                }
                $rutaItem = $ruta . DIRECTORY_SEPARATOR . $item;
                if (!is_file($rutaItem)) {
                    continue;
                }
                $info = pathinfo($item);
                if (!isset($info['extension'])) {
                    continue;
                }
                if ($info['filename'] === $nombre && in_array(strtolower($info['extension']), $todasLasExtensiones, true)) {
                    $anteriores[] = $rutaItem;
                }
            }

            foreach ($anteriores as $anterior) {
                if (!is_writable($anterior)) {
                    return [false, "Error: el archivo existente '$anterior' no se puede reemplazar (permisos)."];
                }
            }

            $rutaTemporal = $ruta . DIRECTORY_SEPARATOR . '.upload_' . uniqid('', true) . '.tmp';

            if (!move_uploaded_file($archivo['tmp_name'], $rutaTemporal)) {
                $errorInfo = error_get_last();
                $detalleError = $errorInfo['message'] ?? 'motivo desconocido';
                return [false, "Error al mover el archivo hacia '$ruta'. Detalle: $detalleError"];
            }

            if (!rename($rutaTemporal, $rutaCompleta)) {
                $errorInfo = error_get_last();
                $detalleError = $errorInfo['message'] ?? 'motivo desconocido';
                @unlink($rutaTemporal); // el archivo anterior queda intacto
                return [false, "Error al guardar el archivo en '$rutaCompleta'. Detalle: $detalleError"];
            }

            $reemplazado = false;
            $noEliminados = [];
            foreach ($anteriores as $anterior) {
                $reemplazado = true;
                if ($anterior === $rutaCompleta) {
                    continue;
                }
                if (!@unlink($anterior)) {
                    $noEliminados[] = basename($anterior);
                }
            }

            if (!empty($noEliminados)) {
                return [true, "Archivo guardado, pero no se pudieron eliminar las versiones anteriores: " . implode(', ', $noEliminados)];
            }

            return [true, $reemplazado ? "Archivo reemplazado con éxito" : "Archivo guardado con éxito"];

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

        if ($existe == "") {
            $existe = "userDefault.png";
        }
        return $existe;
    }

    private function validateUserName($userName)
    {
        $rep = new userRep();
        $user = $rep->searchUserName($userName);
        $state = false;
        if (!empty($user)) {
            $state = true;
        }
        return $state;
    }

    public function userName(string $nombres, string $apellidos): ?string {
        $nombres = strtolower($nombres);
        $apellidos = strtolower($apellidos);
        
        $config = new config();
        $particulas = array_map('strtolower', $config->getParticulas());

        $separar = static function (string $texto): array {
            return preg_split('/\s+/', trim($texto), -1, PREG_SPLIT_NO_EMPTY) ?: [];
        };

        $unirCompuestos = static function (array $partes) use ($particulas): array {
            $resultado = [];

            for ($i = 0, $total = count($partes); $i < $total; $i++) {
                $compuesto = $partes[$i];

                while (
                    in_array(strtolower($partes[$i]), $particulas, true)
                    && isset($partes[$i + 1])
                ) {
                    $compuesto .= $partes[++$i];
                }

                $resultado[] = $compuesto;
            }

            return $resultado;
        };

        $nombresPartes = $unirCompuestos($separar($nombres));
        $apellidosPartes = $unirCompuestos($separar($apellidos));

        // Primero prueba nombre + apellido.
        foreach ($nombresPartes as $nombre) {
            foreach ($apellidosPartes as $apellido) {
                $usuario = $nombre . $apellido;

                if (!$this->validateUserName($usuario)) {
                    return $usuario;
                }
            }
        }

        // Primero prueba nombre +'.'+ apellido.
        foreach ($nombresPartes as $nombre) {
            foreach ($apellidosPartes as $apellido) {
                $usuario = $nombre .'.'. $apellido;

                if (!$this->validateUserName($usuario)) {
                    return $usuario;
                }
            }
        }

        // Si todas están ocupadas, prueba apellido + nombre.
        foreach ($apellidosPartes as $apellido) {
            foreach ($nombresPartes as $nombre) {
                $usuario = $apellido . $nombre;

                if (!$this->validateUserName($usuario)) {
                    return $usuario;
                }
            }
        }

        // Si todas están ocupadas, prueba apellido + '.' + nombre.
        foreach ($apellidosPartes as $apellido) {
            foreach ($nombresPartes as $nombre) {
                $usuario = $apellido .'.'. $nombre;

                if (!$this->validateUserName($usuario)) {
                    return $usuario;
                }
            }
        }

        // No hay combinaciones disponibles.
        return null;
    }
}
