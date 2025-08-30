<?
namespace framework\services;

use Exception;
use framework\services\Action;
use framework\services\IMiddleware;

use framework\config\AuthKeys;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Router class to handle HTTP routing.
 *
 * This class is responsible for defining and dispatching routes
 * for incoming HTTP requests. It supports dynamic route parameters
 * and allows for easy integration with controllers and actions.
 *
 * @package framework\services
 */
class Router
{
    private array $routes = [];
    private string $basePath;
    private ?IMiddleware $middleware;

    public function __construct(string $basePath, ?IMiddleware $middleware = null)
    {
        $this->basePath = $basePath;
        $this->middleware = $middleware;
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function addRoute(string $httpMethod, string $route, Action $action, bool $authorization = false): void
    {
        $this->routes[] = [
            'httpMethod' => strtoupper($httpMethod),
            'route' => "{$this->getBasePath()}$route",
            'action' => $action,
            'authorization' => $authorization
        ];
    }

    public function execute(string $method, string $path): void
    {
        try
        {
            foreach ($this->routes as $route) {
                $matched = $this->matchRoute($route['route'], $path == "/" ? "/" : "/" . $path);
                if (
                    $route['httpMethod'] === strtoupper($method) && $matched
                ) {
                    $route['authorization'] ? $this->validateAuthorization() : "";
                    $class = $route['action'] ?? null;
                    echo $this->middleware ? $this->middleware->process($class->run($matched["params"])) : $class->run($matched["params"]);
                    return;
                }
            }

            throw new Exception("Route not found for method $method and route $path");
        }
        catch(Exception $error)
        {
            if ($this->middleware) {
                echo $this->middleware->process($error);
            } else {
                throw $error;
            }
        }
    }

    public function validateAuthorization()
    {
        $authHeader = null;
        $token = null;
        
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        }
        
        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) 
        {
            $token = $matches[1];
        }
        
        try
        {
            return JWT::decode($token, new Key("batman_alerquina", 'HS256'));
        }
        catch(Exception $e)
        {
            return throw new Exception("Access not authorized!");
        }
    }

    function matchRoute(string $route, string $url): ?array
    {
        // Captura nomes dos parâmetros
        preg_match_all('/\{([a-zA-Z0-9_]+)\}/', $route, $paramMatches);
        $paramNames = $paramMatches[1]; // ['id']

        // Substitui {param} por regex de captura (ex: ([^/]+))
        $regexPattern = preg_replace_callback('/\{[a-zA-Z0-9_]+\}/', function () {
            return '([^\/]+)'; // captura qualquer coisa que não seja barra
        }, $route);

        // Gera regex final
        $regex = "#^" . str_replace('/', '\/', $regexPattern) . "$#";

        // Tenta casar
        if (preg_match($regex, $url, $valueMatches)) {
            array_shift($valueMatches);
            return [
                'matched' => true,
                'params' => array_combine($paramNames, $valueMatches),
            ];
        }

        // Nenhum match
        return null;
    }
}
