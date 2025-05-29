<?

namespace api\middlewares;

use Exception;
use framework\services\IMiddleware;

class ResponseMiddleware implements IMiddleware
{
    public function process(array|string $response): string
    {
        header('Content-Type: application/json');
        try {
            http_response_code(201);
            return json_encode([
                "response" => [
                    $response
                ],
                "error" => [
                    "message" => false
                ]
            ]);
        } catch (Exception $e) {
            http_response_code(401);
            return json_encode([
                "response" => false,
                "error" => [
                    "message" => $e->getMessage()
                ]
            ]);
        }
    }
}
