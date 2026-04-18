<?php
namespace security;

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/jwt/JWTExceptionWithPayloadInterface.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/jwt/BeforeValidException.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/jwt/CachedKeySet.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/jwt/ExpiredException.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/jwt/JWK.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/jwt/JWT.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/jwt/Key.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/jwt/SignatureInvalidException.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class JwtHelper
{
    private static string $secret='c4f9a83d7e21b5c0f18e92d4bb73aa6e';
    private static string $algo   = 'HS256';

    public static function generate(int $id_usuario): string
    {
        $payload = [
            'iat'         => time(),
            'exp'         => time() + (60 * 60 * 8), // 8 horas
            'id_usuario'  => $id_usuario
        ];
        return JWT::encode($payload, self::$secret, self::$algo);
    }

    public static function validate(string $token): ?object
    {
        try {
            return JWT::decode($token, new Key(self::$secret, self::$algo));
        } catch (\Exception $e) {
            return null;
        }
    }
}