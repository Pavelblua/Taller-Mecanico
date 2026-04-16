<?php

namespace transformers;

class response
{
    public function sendResponse(int $httpCode, array $data): void
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // ajusta según tu frontend
        http_response_code($httpCode);
        echo json_encode($data);
        exit;
    }
}
