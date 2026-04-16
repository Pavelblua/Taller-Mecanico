<?php
/**
 * Autoloader para cargar clases automáticamente
 * Coloca este archivo en la raíz de tu proyecto
 */

spl_autoload_register(function ($clase) {
    
    // Directorio base donde están tus clases
    // __DIR__ es la ubicación de este archivo autoload.php
    $directorioBase = __DIR__;
    
    // Array de posibles ubicaciones de tus clases
    // Ajusta estas rutas según tu estructura de carpetas
    $directorios = [
        $directorioBase
    ];
    
    // Convertir el namespace a ruta de archivo
    // Ejemplo: MiSistema\Clases\Usuario -> MiSistema/Clases/Usuario.php
    $archivoClase = str_replace('\\', DIRECTORY_SEPARATOR, $clase) . '.php';
    
    // Buscar en cada directorio configurado
    foreach ($directorios as $directorio) {
        $rutaCompleta = $directorio . DIRECTORY_SEPARATOR . $archivoClase;
        
        if (file_exists($rutaCompleta)) {
            require_once $rutaCompleta;
            return; // Clase encontrada y cargada
        }
    }
    
    // Opcional: Buscar sin el namespace (clases sin namespace)
    $nombreClase = basename(str_replace('\\', '/', $clase)) . '.php';
    foreach ($directorios as $directorio) {
        $rutaCompleta = $directorio . DIRECTORY_SEPARATOR . $nombreClase;
        
        if (file_exists($rutaCompleta)) {
            require_once $rutaCompleta;
            return;
        }
    }
    
    // Opcional: Log de error si no se encuentra la clase
    // error_log("Autoloader: No se pudo cargar la clase: {$clase}");
});

/**
 * EJEMPLO DE ESTRUCTURA DE CARPETAS:
 * 
 * proyecto/
 * ├── autoload.php (este archivo)
 * ├── pagina/
 * │   └── sistema.php
 * ├── clases/
 * │   ├── MiSistema/
 * │   │   └── Clases/
 * │   │       ├── Usuario.php
 * │   │       └── Producto.php
 * │   └── Conexion.php
 * ├── modelos/
 * │   └── UsuarioModel.php
 * └── controladores/
 *     └── UsuarioController.php
 * 
 * 
 * CÓMO USAR:
 * 
 * 1. En tu archivo sistema.php o cualquier archivo PHP:
 * 
 *    <?php
 *    require_once __DIR__ . '/../autoload.php';
 *    
 *    use MiSistema\Clases\Usuario;
 *    use MiSistema\Clases\Producto;
 *    
 *    $usuario = new Usuario();
 *    $producto = new Producto();
 * 
 * 
 * 2. Ejemplo de clase con namespace (clases/MiSistema/Clases/Usuario.php):
 * 
 *    <?php
 *    namespace MiSistema\Clases;
 *    
 *    class Usuario {
 *        public function __construct() {
 *            echo "Usuario creado";
 *        }
 *    }
 * 
 * 
 * 3. Ejemplo de clase sin namespace (clases/Conexion.php):
 * 
 *    <?php
 *    class Conexion {
 *        public function __construct() {
 *            echo "Conexión establecida";
 *        }
 *    }
 */
?>