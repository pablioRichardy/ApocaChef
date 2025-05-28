<?
namespace api\middlewares;

use framework\services\IMiddleware;

class ResponseMiddleware implements IMiddleware
{
    public function process(array|string $response): string
    {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}