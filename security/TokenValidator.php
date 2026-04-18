<?php
namespace security;

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use security\JwtHelper;

class TokenValidator
{
    public static function validate(): array
    {
        $headers = getallheaders();
        $cookie  = $headers['Cookie'] ?? '';
        $token   = '';

        if (preg_match('/token=([^\s;]+)/', $cookie, $matches)) {
            $token = $matches[1];
        }

        if (empty($token)) {
            self::abort('Token no proporcionado', 401);
        }

        $payload = JwtHelper::validate($token);

        if ($payload === null) {
            self::abort('Token inválido o expirado', 401);
        }

        return (array) $payload;
    }

    private static function abort(string $message, int $httpCode = 401): void
    {
        http_response_code($httpCode);
        header('Content-Type: application/json');
        echo json_encode([
            'status'  => false,
            'message' => $message
        ]);
        exit;
    }
}