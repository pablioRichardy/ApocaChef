<?
namespace framework\services;

use framework\services\Action;
use framework\services\IMiddleware;

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

    public function addRoute(string $httpMethod, string $route, Action $action): void
    {
        $this->routes[] = [
            'httpMethod' => strtoupper($httpMethod),
            'route' => "{$this->getBasePath()}$route",
            'action' => $action
        ];
    }

    public function execute(string $method, string $path): void
    {
        foreach ($this->routes as $route) {
            $params = $this->extractRouteParams($route['route'], "/" . ($path == "/" ? "/" : $path));
            if (
                $route['httpMethod'] === strtoupper($method) && $params
            ) {
                $class = $route['action'] ?? null;
                echo $this->middleware ? $this->middleware->process($class->run($params)) : $class->run($params);
                return;
            }
        }
        
        echo "Route not found for method $method and route $path";
        return;
    }

    function extractRouteParams(string $route, string $url): ?array
    {
        // Captura os nomes dos parâmetros
        preg_match_all('/\{([a-zA-Z0-9_]+)\}/', $route, $paramMatches);
        $paramNames = $paramMatches[1]; // Ex: ['id']

        // Constrói regex substituindo os {param} por grupos capturadores
        $regexPattern = preg_replace_callback('/\{[a-zA-Z0-9_]+\}/', function () {
            return '([a-zA-Z0-9_]+)';
        }, $route);

        // Escapa os demais caracteres especiais (exceto os parâmetros já substituídos)
        $regexPattern = str_replace('/', '\/', $regexPattern);
        $regex = "#^{$regexPattern}$#";

        // Faz o match
        if (preg_match($regex, $url, $valueMatches)) {
            array_shift($valueMatches); // Remove o match completo
            return array_combine($paramNames, $valueMatches); // Ex: ['id' => '1']
        }

        return null;
    }
}
